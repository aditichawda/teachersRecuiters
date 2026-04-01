<?php

namespace Botble\Ads\Supports;

use Botble\Ads\Events\AdsLoading;
use Botble\Ads\Models\Ads;
use Botble\Base\Enums\BaseStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class AdsManager
{
    protected Collection $data;

    protected bool $loaded = false;

    protected array $locations = [];

    public function __construct()
    {
        $this->locations = [
            'not_set' => trans('plugins/ads::ads.not_set'),
        ];
    }

    public function display(string $location, array $attributes = [], bool $single = true): string
    {
        $this->load();

        $data = $this
            ->filterExpired($this->data)
            ->where('location', $location)
            ->sortBy('order');

        if ($data->isNotEmpty() && $single) {
            $data = $data->random(1);
        }

        return view('plugins/ads::partials.ad-display', compact('data', 'attributes'))->render();
    }

    public function displayByPageAndPosition(string $pageType, string $position, array $attributes = []): string
    {
        $this->load();

        // Check if new columns exist by checking first ad
        $hasNewColumns = false;
        if ($this->data->isNotEmpty()) {
            $firstAd = $this->data->first();
            $hasNewColumns = isset($firstAd->page_type) || property_exists($firstAd, 'page_type');
        }

        if (!$hasNewColumns) {
            // Fallback to location-based system
            $locationKey = $pageType . '-' . $position;
            return $this->display($locationKey, $attributes, false);
        }

        $data = $this
            ->filterExpired($this->data)
            ->filter(function ($item) use ($pageType) {
                if (!isset($item->page_type)) {
                    return false;
                }
                return $item->page_type === 'all' || $item->page_type === $pageType;
            })
            ->filter(function ($item) use ($position) {
                if (!isset($item->position)) {
                    return false;
                }
                return $item->position === $position;
            })
            ->sortBy('order');

        if ($data->isEmpty()) {
            return '';
        }

        // Group by banner type
        $bannerType = $data->first()->banner_type ?? 'single';
        
        if ($bannerType === 'single') {
            $data = $data->random(1);
            return view('plugins/ads::partials.ad-display', compact('data', 'attributes'))->render();
        } else {
            // For double/multiple, take appropriate number
            $count = $bannerType === 'double' ? 2 : 3;
            $data = $data->take($count);
            return view('plugins/ads::partials.ad-display-multiple', compact('data', 'attributes'))->render();
        }
    }

    public function load(bool $force = false, array $with = []): self
    {
        if (! $this->loaded || $force) {
            $this->data = $this->read($with);
            $this->loaded = true;

            AdsLoading::dispatch($this->data);
        }

        return $this;
    }

    protected function read(array $with): Collection
    {
        $defaultWith = ['metadata'];

        if (! empty($with)) {
            $with = array_merge($defaultWith, $with);
        } else {
            $with = $defaultWith;
        }

        return Ads::query()->with($with)->get();
    }

    public function locationHasAds(string $location): bool
    {
        $this->load();

        return $this
            ->filterExpired($this->data)
            ->where('location', $location)
            ->sortBy('order')
            ->isNotEmpty();
    }

    public function displayAds(?string $key, array $attributes = []): ?string
    {
        if (! $key) {
            return null;
        }

        $this->load();

        $ads = $this
            ->filterExpired($this->data)
            ->where('key', $key)
            ->first();

        if (! $ads) {
            return null;
        }

        $data = [$ads];

        if (! isset($attributes['style'])) {
            $attributes['style'] = 'text-align: center;';
        }

        return view('plugins/ads::partials.ad-display', compact('data', 'attributes'))->render();
    }

    public function getData(bool $isLoad = false, bool $isNotExpired = false): Collection
    {
        if ($isLoad || ! isset($this->data)) {
            $this->load();
        }

        if ($isNotExpired) {
            return $this->filterExpired($this->data);
        }

        return $this->data;
    }

    public function registerLocation(string $key, string $name): self
    {
        $this->locations[$key] = $name;

        return $this;
    }

    public function getLocations(): array
    {
        return apply_filters('ads_locations', $this->locations);
    }

    public function getAds(string $key): ?Ads
    {
        if (! $key) {
            return null;
        }

        $ads = $this->getData(true)->firstWhere('key', $key);

        if (! $ads || ! $ads->image) {
            return null;
        }

        return $ads;
    }

    protected function filterExpired(Collection $data): Collection
    {
        return $data
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->filter(fn (Ads $item) => $item->ads_type === 'google_adsense' || $item->expired_at->gte(Carbon::now()));
    }
}
