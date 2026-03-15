<?php

namespace Botble\JobBoard\Casts;

use Botble\Base\Enums\BaseStatusEnum;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

/**
 * Safely cast jb_packages.status to BaseStatusEnum.
 * DB may have "Featured" or other values; map invalid ones to PUBLISHED so the list doesn't crash.
 */
class PackageStatusCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        if ($value === null || $value === '') {
            return BaseStatusEnum::PUBLISHED();
        }

        $str = (string) $value;
        if (BaseStatusEnum::isValid($str)) {
            return (new BaseStatusEnum())->make($str);
        }

        return BaseStatusEnum::PUBLISHED();
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if ($value instanceof BaseStatusEnum) {
            return $value->getValue();
        }

        $str = (string) $value;
        if (BaseStatusEnum::isValid($str)) {
            return $str;
        }

        return BaseStatusEnum::PUBLISHED()->getValue();
    }
}
