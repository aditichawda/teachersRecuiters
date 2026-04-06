<?php

namespace Botble\JobBoard\Supports;

use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\Company;
use Botble\JobBoard\Models\Job;
use Botble\Slug\Facades\SlugHelper;
use Botble\Slug\Models\Slug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SlugUniqueSuffixHelper
{
    public static function supportedModelClasses(): array
    {
        return [Job::class, Company::class, Account::class];
    }

    public static function isSupportedModelClass(?string $modelClass): bool
    {
        return $modelClass && in_array($modelClass, self::supportedModelClasses(), true);
    }

    /**
     * Append unique_id (or id) to admin/permalink AJAX slug so it matches slugSourceWithUniqueId().
     */
    public static function applySlugSuffixFromRequest(string $slug, string $modelClass): string
    {
        $suffix = self::resolveSuffixString($modelClass);
        if ($suffix === null || $suffix === '') {
            return $slug;
        }

        $suffixSlug = self::slugifySuffix($suffix);
        if ($suffixSlug === '') {
            return $slug;
        }

        $slug = trim($slug);
        if ($slug === '') {
            return $suffixSlug;
        }

        if (Str::endsWith($slug, '-' . $suffixSlug)) {
            return $slug;
        }

        return $slug . '-' . $suffixSlug;
    }

    protected static function slugifySuffix(string $suffix): string
    {
        if (SlugHelper::turnOffAutomaticUrlTranslationIntoLatin()) {
            return Str::slug($suffix, '-', false);
        }

        return Str::slug($suffix, '-', 'en');
    }

    protected static function resolveSuffixString(string $modelClass): ?string
    {
        $slugId = request()->input('slug_id');
        if ($slugId && (int) $slugId > 0) {
            $row = Slug::query()->find($slugId);
            if ($row && $row->reference_type === $modelClass && $row->reference_id) {
                $model = $modelClass::query()->select(['id', 'unique_id'])->find($row->reference_id);
                if ($model) {
                    return self::suffixFromModel($model);
                }
            }
        }

        $refId = request()->input('reference_id');
        if ($refId === null || $refId === '') {
            $refId = request()->input('id');
        }

        if ($refId !== null && $refId !== '' && is_numeric($refId)) {
            $model = $modelClass::query()->select(['id', 'unique_id'])->find($refId);
            if ($model) {
                return self::suffixFromModel($model);
            }
        }

        $uid = request()->input('unique_id');
        if (is_string($uid) && trim($uid) !== '') {
            return trim($uid);
        }

        return null;
    }

    protected static function suffixFromModel(object $model): string
    {
        return self::rawUniqueSuffixFromModel($model);
    }

    /**
     * Same source as slugSourceWithUniqueId() suffix part (unique_id, else id).
     */
    public static function rawUniqueSuffixFromModel(object $model): string
    {
        $uniqueId = trim((string) ($model->unique_id ?? ''));
        if ($uniqueId !== '') {
            return $uniqueId;
        }

        if (! empty($model->id)) {
            return (string) $model->id;
        }

        return '';
    }

    /**
     * True if stored slug key ends with "-{suffix}" or "-{suffix}-N" (uniqueness disambiguation).
     */
    public static function slugKeyHasUniqueSuffix(?string $key, string $suffixSlug): bool
    {
        if ($suffixSlug === '' || $key === null || trim($key) === '') {
            return false;
        }

        return (bool) preg_match(
            '#-' . preg_quote($suffixSlug, '#') . '(-\d+)?$#',
            $key
        );
    }

    /**
     * On create/update: if permalink exists but omits unique_id/id segment, regenerate from slugSourceWithUniqueId().
     */
    public static function ensureSlugIncludesUniqueCode(Model $model): void
    {
        if (! $model instanceof Job && ! $model instanceof Company && ! $model instanceof Account) {
            return;
        }

        if (! SlugHelper::isSupportedModel($model::class) || ! $model->getKey()) {
            return;
        }

        if ($model instanceof Account) {
            if ($model->email_verified_at === null || $model->confirmed_at === null) {
                return;
            }
            $forJobSeeker = $model->isJobSeeker() && $model->is_public_profile && ! JobBoardHelper::isDisabledPublicProfile();
            $forEmployer = $model->isEmployer();
            if (! $forJobSeeker && ! $forEmployer) {
                return;
            }
        }

        $suffixRaw = self::rawUniqueSuffixFromModel($model);
        if ($suffixRaw === '') {
            return;
        }

        $suffixSlug = self::slugifySuffix($suffixRaw);
        if ($suffixSlug === '') {
            return;
        }

        $key = (string) ($model->slugable?->key ?? '');
        if (self::slugKeyHasUniqueSuffix($key, $suffixSlug)) {
            return;
        }

        try {
            SlugHelper::createSlug($model, $model->slugSourceWithUniqueId());
        } catch (\Throwable) {
            // ignore
        }
    }
}
