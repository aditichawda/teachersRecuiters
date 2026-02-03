<?php

use Botble\Blog\Models\Category;
use Botble\Widget\AbstractWidget;
use Illuminate\Support\Collection;

class BlogCategoriesWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Blog Categories'),
            'description' => __('Widget display blog categories'),
            'number_display' => 10,
        ]);
    }

    public function data(): array|Collection
    {
        return [
            'categories' => Category::query()
                ->wherePublished()
                ->with('slugable')
                ->oldest('order')->latest()
                ->limit((int) $this->getConfig()['number_display'] ?: 10)
                ->get(),
        ];
    }
}
