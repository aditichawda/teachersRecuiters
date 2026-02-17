<?php

namespace Botble\JobBoard\Enums;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Supports\Enum;
use Illuminate\Support\HtmlString;

/**
 * @method static JobApplicationStatusEnum PENDING()
 * @method static JobApplicationStatusEnum CHECKED()
 * @method static JobApplicationStatusEnum SHORTLISTED()
 * @method static JobApplicationStatusEnum REJECTED()
 */
class JobApplicationStatusEnum extends Enum
{
    public const PENDING = 'pending';
    public const CHECKED = 'checked';
    public const SHORTLISTED = 'shortlisted';
    public const REJECTED = 'rejected';

    public static $langPath = 'plugins/job-board::job-application.statuses';

    public function toHtml(): HtmlString|string
    {
        $color = match ($this->value) {
            self::PENDING => 'warning',
            self::CHECKED => 'success',
            self::SHORTLISTED => 'info',
            self::REJECTED => 'danger',
            default => 'primary',
        };

        return BaseHelper::renderBadge($this->label(), $color);
    }
}
