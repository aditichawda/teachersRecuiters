<?php

namespace Botble\JobBoard\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class JobDescriptionAiService
{
    public function isEnabled(): bool
    {
        $config = config('plugins.job-board.general.ai_job_description', []);

        if (empty($config['enabled'])) {
            return false;
        }

        $provider = $config['provider'] ?? 'openai';

        return ! empty($this->getApiKey($provider));
    }

    protected function getApiKey(string $provider): string
    {
        $config = config('plugins.job-board.general.ai_job_description', []);
        if ($provider === 'gemini') {
            $gemini = $config['gemini'] ?? [];

            return trim((string) ($gemini['api_key'] ?? ''));
        }
        $openai = $config['openai'] ?? [];

        return trim((string) ($openai['api_key'] ?? ''));
    }

    /**
     * Generate job description from title, optional short description, and optional institution title.
     * Returns ['description' => string|null, 'error' => string|null, 'fallback' => bool].
     */
    public function generateFromTitle(string $title, string $shortDescription = '', string $institutionTitle = ''): array
    {
        $title = trim($title);
        if ($title === '') {
            return ['description' => null, 'error' => 'Title is required.'];
        }

        $config = config('plugins.job-board.general.ai_job_description', []);
        $provider = $config['provider'] ?? 'openai';

        $shortDescription = trim($shortDescription);
        $institutionTitle = trim($institutionTitle);

        if ($provider === 'gemini') {
            return $this->generateWithGemini($title, $shortDescription, $institutionTitle);
        }
        if ($provider === 'openai') {
            return $this->generateWithOpenAi($title, $shortDescription, $institutionTitle);
        }

        Log::warning('JobBoard AI: Unknown provider.', ['provider' => $provider]);

        return ['description' => null, 'error' => 'Unknown AI provider.'];
    }

    protected function generateWithGemini(string $title, string $shortDescription, string $institutionTitle): array
    {
        $gemini = config('plugins.job-board.general.ai_job_description.gemini', []);
        $apiKey = $this->getApiKey('gemini');
        $configuredModel = trim((string) ($gemini['model'] ?? ''));
        $maxTokens = (int) ($gemini['max_tokens'] ?? 1500);

        if ($apiKey === '') {
            Log::warning('JobBoard AI: Gemini API key not set.');

            return ['description' => null, 'error' => 'Gemini API key is not set in .env (GEMINI_API_KEY or GOOGLE_AI_API_KEY).'];
        }

        $prompt = $this->buildPrompt($title, $shortDescription, $institutionTitle);

        // Model/version compatibility varies by account/region. Try multiple (model, version) pairs.
        $modelsToTry = array_filter([
            $configuredModel ?: null,
            'gemini-2.0-flash',
            'gemini-1.5-flash',
            'gemini-1.5-pro',
            'gemini-pro',
        ]);
        $modelsToTry = array_values(array_unique($modelsToTry));
        $versionsToTry = ['v1beta', 'v1'];

        $lastError = null;
        $sawModelNotFound = false;

        try {
            foreach ($versionsToTry as $version) {
                foreach ($modelsToTry as $model) {
                    if ($model === '') {
                        continue;
                    }
                    $result = $this->callGeminiGenerateContent($apiKey, $model, $version, $prompt, $maxTokens);
                    if ($result['success']) {
                        return ['description' => trim($result['text']), 'error' => null, 'fallback' => false];
                    }
                    $lastError = $result['message'] ?? $lastError;
                    if (isset($result['model_not_found']) && $result['model_not_found']) {
                        $sawModelNotFound = true;
                    }
                    if (isset($result['auth_error']) && $result['auth_error']) {
                        return [
                            'description' => null,
                            'error' => $lastError,
                        ];
                    }
                }
            }

            // Auto-discover: ListModels and retry with first generateContent-capable model
            if ($sawModelNotFound) {
                $discovered = $this->listGeminiModelsAndGenerate($apiKey, $prompt, $maxTokens);
                if ($discovered !== null) {
                    return ['description' => trim($discovered), 'error' => null, 'fallback' => false];
                }
            }

            return [
                'description' => $this->buildFallbackDescription($title),
                'error' => null,
                'fallback' => true,
                'api_error' => $lastError ?? 'Gemini request failed. Check API key and model access.',
            ];
        } catch (\Throwable $e) {
            Log::error('JobBoard AI: Exception calling Gemini.', ['message' => $e->getMessage()]);

            return [
                'description' => $this->buildFallbackDescription($title),
                'error' => null,
                'fallback' => true,
                'api_error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Single Gemini generateContent request. Returns [success, text?, message?, model_not_found?, auth_error?].
     */
    protected function callGeminiGenerateContent(string $apiKey, string $model, string $version, string $prompt, int $maxTokens): array
    {
        $url = 'https://generativelanguage.googleapis.com/' . $version . '/models/' . $model . ':generateContent?key=' . $apiKey;

        Log::info('JobBoard AI: Calling Gemini.', ['model' => $model, 'version' => $version]);

        $response = Http::timeout(60)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt],
                        ],
                    ],
                ],
                'generationConfig' => [
                    'maxOutputTokens' => $maxTokens,
                    'temperature' => 0.7,
                ],
            ]);

        if (! $response->successful()) {
            $body = $response->json();
            $msg = $this->parseGeminiErrorMessage($response->status(), $body);
            $modelNotFound = $response->status() === 404
                || (is_string($msg) && stripos($msg, 'not found') !== false && stripos($msg, 'api version') !== false);
            $authError = in_array($response->status(), [401, 403], true);

            return [
                'success' => false,
                'message' => $msg,
                'model_not_found' => $modelNotFound,
                'auth_error' => $authError,
            ];
        }

        $data = $response->json();
        $text = $this->extractGeminiText($data);

        if ($text === null || trim($text) === '') {
            return [
                'success' => false,
                'message' => 'Gemini returned empty content.',
            ];
        }

        return ['success' => true, 'text' => $text];
    }

    /**
     * Call ListModels and retry generateContent with first model that supports generateContent.
     */
    protected function listGeminiModelsAndGenerate(string $apiKey, string $prompt, int $maxTokens): ?string
    {
        foreach (['v1beta', 'v1'] as $version) {
            $listUrl = 'https://generativelanguage.googleapis.com/' . $version . '/models?key=' . $apiKey;
            $listResp = Http::timeout(15)->get($listUrl);
            if (! $listResp->successful()) {
                continue;
            }
            $listData = $listResp->json();
            $models = $listData['models'] ?? [];
            foreach ($models as $m) {
                $name = $m['name'] ?? '';
                $methods = $m['supportedGenerationMethods'] ?? [];
                if ($name === '' || ! in_array('generateContent', $methods, true)) {
                    continue;
                }
                $modelId = str_starts_with($name, 'models/') ? substr($name, 7) : $name;
                $result = $this->callGeminiGenerateContent($apiKey, $modelId, $version, $prompt, $maxTokens);
                if ($result['success']) {
                    Log::info('JobBoard AI: Used discovered model.', ['model' => $modelId, 'version' => $version]);

                    return $result['text'];
                }
            }
        }

        return null;
    }

    protected function parseGeminiErrorMessage(int $status, ?array $body): string
    {
        $msg = 'Gemini API error (HTTP ' . $status . '). ';
        if (is_array($body) && isset($body['error']['message'])) {
            $msg .= $body['error']['message'];
        } elseif (is_array($body) && isset($body['error']['status'])) {
            $msg .= $body['error']['status'];
        } else {
            $msg .= 'Check GEMINI_API_KEY in .env and run: php artisan config:clear';
        }

        return $msg;
    }

    protected function generateWithOpenAi(string $title, string $shortDescription, string $institutionTitle): array
    {
        $openai = config('plugins.job-board.general.ai_job_description.openai', []);
        $apiKey = $this->getApiKey('openai');
        $model = $openai['model'] ?? 'gpt-4o-mini';
        $maxTokens = (int) ($openai['max_tokens'] ?? 1500);

        if ($apiKey === '') {
            Log::warning('JobBoard AI: OpenAI API key not set.');

            return ['description' => null, 'error' => 'OpenAI API key is not set in .env (OPENAI_API_KEY or JOB_BOARD_OPENAI_API_KEY).'];
        }

        $prompt = $this->buildPrompt($title, $shortDescription, $institutionTitle);

        try {
            Log::info('JobBoard AI: Calling OpenAI.', [
                'model' => $model,
                'status' => 'request_started',
            ]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(60)->post('https://api.openai.com/v1/chat/completions', [
                'model' => $model,
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a professional HR writer for educational institutes. Create job descriptions with: short summary (2–3 lines), 2-3 key responsibilities, 2-3 required skills, and basic job details (timing/location). Use plain text and • for bullet points. No markdown or HTML. Keep language simple and professional.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'max_tokens' => $maxTokens,
                'temperature' => 0.7,
            ]);

            if (! $response->successful()) {
                $status = $response->status();
                Log::warning('JobBoard AI: OpenAI API error.', [
                    'http_status' => $status,
                    'body' => $response->body(),
                ]);
                // Fallback: give user a template draft so button still helps when quota/error
                return [
                    'description' => $this->buildFallbackDescription($title),
                    'error' => null,
                    'fallback' => true,
                ];
            }

            $data = $response->json();
            $content = $data['choices'][0]['message']['content'] ?? null;

            if ($content === null || $content === '') {
                return [
                    'description' => $this->buildFallbackDescription($title),
                    'error' => null,
                    'fallback' => true,
                ];
            }

            return ['description' => trim($content), 'error' => null, 'fallback' => false];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('JobBoard AI: Connection failed.', ['message' => $e->getMessage()]);

            return [
                'description' => $this->buildFallbackDescription($title),
                'error' => null,
                'fallback' => true,
            ];
        } catch (\Throwable $e) {
            Log::error('JobBoard AI: Exception calling OpenAI.', ['message' => $e->getMessage()]);

            return [
                'description' => $this->buildFallbackDescription($title),
                'error' => null,
                'fallback' => true,
            ];
        }
    }

    protected function extractGeminiText(array $data): ?string
    {
        $candidates = $data['candidates'] ?? [];
        if (empty($candidates)) {
            return null;
        }
        $content = $candidates[0]['content'] ?? [];
        $parts = $content['parts'] ?? [];
        if (empty($parts)) {
            return null;
        }
        foreach ($parts as $part) {
            if (! empty($part['text'])) {
                return $part['text'];
            }
        }

        return null;
    }

    protected function buildPrompt(string $title, string $shortDescription = '', string $institutionTitle = ''): string
    {
        $out = "Create a professional job description for an institute. "
            . "Include: (1) A short job summary in 2–3 lines, (2) exactly 3 key responsibilities as bullet points, "
            . "(3) exactly 3 required skills as bullet points, (4) basic job details (timing/location if needed). "
-3            . "Keep the language simple, clear, and professional. Use plain text only; no markdown or HTML. Use • for bullet points.\n\n";

        $out .= "Job title: " . $title . "\n";

        if ($institutionTitle !== '') {
            $out .= "Institution name / institution type: " . $institutionTitle . "\n";
        }

        $out .= "\nGenerate the full job description based on the above job title and institution name/type.";

        return $out;
    }

    /**
     * Fallback draft when API fails (quota, network, etc.). Professional institute job description structure.
     */
    protected function buildFallbackDescription(string $title): string
    {
        return "We are looking for a " . $title . " to join our institution. "
            . "You will contribute to our team and support our goals in a professional environment.\n\n"
            . "Key Responsibilities:\n"
            . "• Fulfil role requirements as per institution standards\n"
            . "• Collaborate with colleagues and maintain records\n"
            . "• Support students and participate in activities as required\n\n"
            . "Required Skills:\n"
            . "• Relevant qualification and experience\n"
            . "• Good communication and organisational skills\n"
            . "• Ability to work in a team\n\n"
            . "Job details: Full-time position. Location and timing as per institution policy. Apply if interested.";
    }
}
