<?php

namespace Botble\JobBoard\Support;

use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\ScreeningQuestion;
use Illuminate\Support\Arr;

class ScreeningQuestionPlaceholder
{
    /**
     * Resolve placeholders in question/options text from job data.
     *
     * Placeholders: {degree_level}, {job_title}, {experience_years}, {certification},
     * {language}, {job_location}, {application_locations}, {company_name}, {institution_type}
     */
    public static function resolve(string $text, Job|array $jobOrData): string
    {
        $data = is_array($jobOrData) ? $jobOrData : self::jobToReplacements($jobOrData);

        foreach ($data as $key => $value) {
            $text = str_replace('{' . $key . '}', (string) $value, $text);
        }

        // Replace any remaining placeholders with empty
        return preg_replace('/\{[a-z_]+\}/', '', $text);
    }

    public static function jobToReplacements(Job $job): array
    {
        $job->loadMissing(['degreeLevel', 'jobExperience', 'company']);

        $degreeLevel = $job->degreeLevel?->name ?? '';
        $jobTitle = $job->name ?? '';
        $experienceYears = $job->jobExperience?->name ?? '';
        $certs = self::parseList($job->required_certifications);
        $certification = $certs[0] ?? '';
        $langs = self::parseList($job->language_proficiency);
        $language = $langs[0] ?? '';

        $cityName = $job->getAttribute('city_name') ?? (method_exists($job, 'city') ? $job->city?->name : null) ?? '';
        $stateName = $job->getAttribute('state_name') ?? (method_exists($job, 'state') ? $job->state?->name : null) ?? '';
        $countryName = $job->getAttribute('country_name') ?? (method_exists($job, 'country') ? $job->country?->name : null) ?? '';
        $jobLocation = trim(($job->address ?? '') . ' ' . $cityName . ' ' . $stateName . ' ' . $countryName);
        if (empty(trim($jobLocation)) && $job->company) {
            $jobLocation = trim(($job->company->address ?? '') . ' ' . ($job->company->getAttribute('city_name') ?? ''));
        }
        if (empty(trim($jobLocation))) {
            $jobLocation = $cityName ?: ($job->company?->getAttribute('city_name') ?? '');
        }

        $appLocs = self::parseList($job->application_locations);
        $applicationLocations = is_array($appLocs) ? implode(', ', $appLocs) : (is_string($appLocs) ? $appLocs : '');

        $companyName = $job->company?->name ?? '';
        $institutionType = $job->company?->institution_type ?? '';

        return [
            'degree_level' => $degreeLevel,
            'job_title' => $jobTitle,
            'experience_years' => $experienceYears,
            'certification' => $certification,
            'language' => $language,
            'job_location' => $jobLocation,
            'application_locations' => $applicationLocations,
            'company_name' => $companyName,
            'institution_type' => $institutionType,
        ];
    }

    /**
     * Build replacements from form data (create mode - job not yet saved).
     */
    public static function formDataToReplacements(array $formData, array $degreeLevels, array $jobExperiences): array
    {
        $degreeId = $formData['degree_level_id'] ?? null;
        $expId = $formData['job_experience_id'] ?? null;

        return [
            'degree_level' => $degreeLevels[$degreeId] ?? '',
            'job_title' => $formData['name'] ?? '',
            'experience_years' => $jobExperiences[$expId] ?? '',
            'certification' => self::firstFromList($formData['required_certifications'] ?? ''),
            'language' => self::firstFromList($formData['language_proficiency'] ?? ''),
            'job_location' => trim(($formData['address'] ?? '') . ' ' . ($formData['city_name'] ?? '')),
            'application_locations' => self::formatLocations($formData['application_locations'] ?? []),
            'company_name' => $formData['company_name'] ?? '',
            'institution_type' => $formData['institution_type'] ?? '',
        ];
    }

    protected static function parseList(mixed $value): array
    {
        if (is_array($value)) {
            return $value;
        }
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                return $decoded;
            }
            return array_filter(array_map('trim', preg_split('/[\r\n,;]+/', $value)));
        }

        return [];
    }

    protected static function firstFromList(mixed $value): string
    {
        $arr = self::parseList($value);

        return $arr[0] ?? '';
    }

    protected static function formatLocations(mixed $value): string
    {
        $arr = self::parseList($value);

        return implode(', ', $arr);
    }
}
