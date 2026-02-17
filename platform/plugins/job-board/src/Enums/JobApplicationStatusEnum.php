<?php

namespace Botble\JobBoard\Enums;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Supports\Enum;
use Illuminate\Support\HtmlString;

/**
 * @method static JobApplicationStatusEnum PENDING()
 * @method static JobApplicationStatusEnum HIRED()
 * @method static JobApplicationStatusEnum REJECTED()
 * @method static JobApplicationStatusEnum SHORT_LIST()
 */
class JobApplicationStatusEnum extends Enum
{
    public const PENDING = 'pending';
    public const HIRED = 'hired';
    public const REJECTED = 'rejected';
    public const SHORT_LIST = 'short_list';

    public static $langPath = 'plugins/job-board::job-application.statuses';

    public function toHtml(): HtmlString|string
    {
        $color = match ($this->value) {
            self::PENDING => 'warning',
            self::HIRED => 'success',
            self::REJECTED => 'danger',
            self::SHORT_LIST => 'info',
            default => 'primary',
        };

        return BaseHelper::renderBadge($this->label(), $color);
    }
}
