<?php

namespace Botble\Ads\Forms;

use Botble\Ads\Facades\AdsManager;
use Botble\Ads\Http\Requests\AdsRequest;
use Botble\Ads\Models\Ads;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Forms\FieldOptions\DatePickerFieldOption;
use Botble\Base\Forms\FieldOptions\HiddenFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\SortOrderFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\DatePickerField;
use Botble\Base\Forms\Fields\HiddenField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\OnOffField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class AdsForm extends FormAbstract
{
    protected function hasNewColumns(): bool
    {
        try {
            return Schema::hasColumn('ads', 'banner_type');
        } catch (\Exception $e) {
            return false;
        }
    }

    public function setup(): void
    {
        $model = $this->getModel();
        
        // Safely get current values
        $currentBannerType = 'single';
        $currentAdsType = 'custom_ad';
        $hasNewColumns = $this->hasNewColumns();
        
        if ($model && $model->exists && $hasNewColumns) {
            try {
                $currentAdsType = $model->getAttribute('ads_type') ?: 'custom_ad';
                $currentBannerType = $model->getAttribute('banner_type') ?: 'single';
            } catch (\Exception $e) {
                // Use defaults if any error
                $currentBannerType = 'single';
                $currentAdsType = 'custom_ad';
            }
        }
        
        $this
            ->model(Ads::class)
            ->setValidatorClass(AdsRequest::class)
            ->add('name', TextField::class, TextFieldOption::make()
                ->label(trans('plugins/ads::ads.name'))
                ->required()
                ->placeholder('Enter ad name')
            )
            ->add('key', HiddenField::class, HiddenFieldOption::make()
                ->value($this->getModel() && $this->getModel()->exists ? $this->getModel()->key : $this->generateAdsKey())
            )
            ->add('order', NumberField::class, SortOrderFieldOption::make()
                ->helperText('Sort order determines the display sequence of ads. Lower numbers appear first. Default: 0')
            );
        
        // Only add new fields if columns exist
        if ($hasNewColumns) {
            $this->add(
                'banner_type',
                SelectField::class,
                SelectFieldOption::make()
                    ->label('Banner Type')
                    ->choices([
                        'single' => 'Single Banner',
                        'double' => 'Double Banner',
                        'multiple' => 'Multiple Banner (3+)',
                    ])
                    ->defaultValue('single')
                    ->helperText('Select how many banners to display together')
            )
            ->add(
                'page_type',
                SelectField::class,
                SelectFieldOption::make()
                    ->label('Page Type')
                    ->choices([
                        'all' => 'All Pages',
                        'home' => 'Home Page',
                        'jobs' => 'Jobs Listing Page',
                        'job-detail' => 'Job Detail Page',
                        'candidates' => 'Candidates Page',
                        'candidate-detail' => 'Candidate Detail Page',
                        'company' => 'Company Page',
                        'company-detail' => 'Company Detail Page',
                        'for-schools' => 'For Schools Page',
                        'for-teachers' => 'For Teachers Page',
                        'dashboard' => 'Dashboard Pages',
                        'settings' => 'Settings Pages',
                    ])
                    ->searchable()
                    ->helperText('Select which page(s) this ad should appear on')
            )
            ->add(
                'position',
                SelectField::class,
                SelectFieldOption::make()
                    ->label('Position')
                    ->choices([
                        'top' => 'Top (Header Area)',
                        'sidebar-left' => 'Sidebar Left',
                        'sidebar-right' => 'Sidebar Right',
                        'sidebar-top' => 'Sidebar Top',
                        'sidebar-middle' => 'Sidebar Middle',
                        'sidebar-bottom' => 'Sidebar Bottom',
                        'between-content' => 'Between Content',
                        'bottom' => 'Bottom (Footer Area)',
                        'after-hero' => 'After Hero Section',
                        'before-footer' => 'Before Footer',
                    ])
                    ->searchable()
                    ->helperText('Select where on the page this ad should appear')
            );
        }
        
        $this->add(
            'ads_type',
            SelectField::class,
            SelectFieldOption::make()
                ->label(trans('plugins/ads::ads.ads_type'))
                ->choices([
                    'custom_ad' => trans('plugins/ads::ads.custom_ad'),
                    'google_adsense' => 'Google AdSense',
                ])
        )
        ->addOpenCollapsible('ads_type', 'google_adsense', $currentAdsType)
            ->add(
                'google_adsense_slot_id',
                TextField::class,
                TextFieldOption::make()
                    ->label(trans('plugins/ads::ads.google_adsense_slot_id'))
                    ->placeholder('E.g: 1234567890')
            )
            ->addCloseCollapsible('ads_type', 'google_adsense')
        ->addOpenCollapsible('ads_type', 'custom_ad', $currentAdsType)
            ->add('url', TextField::class, [
                'label' => trans('plugins/ads::ads.url'),
                'attr' => [
                    'placeholder' => trans('plugins/ads::ads.url'),
                    'data-counter' => 255,
                ],
            ])
            ->add('open_in_new_tab', OnOffField::class, [
                'label' => trans('plugins/ads::ads.open_in_new_tab'),
                'default_value' => true,
            ])
        ->add('image', MediaImageField::class, MediaImageFieldOption::make()->label('Banner Image 1'))
            ->add('tablet_image', MediaImageField::class, [
                'label' => trans('plugins/ads::ads.tablet_image'),
                'help_block' => [
                    'text' => trans('plugins/ads::ads.tablet_image_helper'),
                ],
            ])
            ->add('mobile_image', MediaImageField::class, [
                'label' => trans('plugins/ads::ads.mobile_image'),
                'help_block' => [
                    'text' => trans('plugins/ads::ads.mobile_image_helper'),
            ],
        ]);
        
        // Only add multiple banner fields if columns exist
        if ($hasNewColumns) {
            $this->addOpenCollapsible('banner_type', 'double', $currentBannerType)
            ->add('image_2', MediaImageField::class, [
                'label' => 'Banner Image 2',
                'help_block' => [
                    'text' => 'Second banner image (for double/multiple banners)',
                ],
            ])
            ->add('url_2', TextField::class, [
                'label' => 'Banner 2 URL',
                'attr' => [
                    'placeholder' => 'URL for second banner',
                    'data-counter' => 255,
                ],
            ])
            ->addCloseCollapsible('banner_type', 'double')
            ->addOpenCollapsible('banner_type', 'multiple', $currentBannerType)
            ->add('image_3', MediaImageField::class, [
                'label' => 'Banner Image 3',
                'help_block' => [
                    'text' => 'Third banner image (for multiple banners)',
                ],
            ])
            ->add('url_3', TextField::class, [
                'label' => 'Banner 3 URL',
                'attr' => [
                    'placeholder' => 'URL for third banner',
                    'data-counter' => 255,
                ],
            ])
            ->addCloseCollapsible('banner_type', 'multiple');
        }
        
        $this->addCloseCollapsible('ads_type', 'custom_ad')
            ->add('status', SelectField::class, StatusFieldOption::make())
            ->when(($adLocations = AdsManager::getLocations()) && count($adLocations) > 1, function () use ($adLocations): void {
                $this->add(
                    'location',
                    SelectField::class,
                    SelectFieldOption::make()
                        ->label(trans('plugins/ads::ads.location'))
                        ->helperText(trans('plugins/ads::ads.location_helper'))
                        ->choices($adLocations)
                        ->searchable()
                        ->required()
                );
            })
            ->add(
                'expired_at',
                DatePickerField::class,
                DatePickerFieldOption::make()
                    ->label(trans('plugins/ads::ads.expired_at'))
                    ->defaultValue(BaseHelper::formatDate(Carbon::now()->addMonth()))
                    ->helperText(trans('plugins/ads::ads.expired_at_helper'))
            )
            ->setBreakFieldPoint('status');
    }

    protected function generateAdsKey(): string
    {
        do {
            $key = strtoupper(Str::random(12));
        } while (Ads::query()->where('key', $key)->exists());

        return $key;
    }
}
