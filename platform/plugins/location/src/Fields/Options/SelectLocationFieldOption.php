<?php

namespace Botble\Location\Fields\Options;

use Botble\Base\Forms\FormFieldOptions;

class SelectLocationFieldOption extends FormFieldOptions
{
    protected bool $cityFirst = false;

    public function cityFirst(bool $cityFirst = true): static
    {
        $this->cityFirst = $cityFirst;

        return $this;
    }

    public function toArray(): array
    {
        $data = parent::toArray();

        $data['wrapperClassName'] = 'mb-3 row';

        $colspan = $this->getColspan() ?: 3;

        if ($colspan > 0) {
            $data['wrapper']['class'] = 'col-md-' . (12 / $colspan);
        }

        $data['cityFirst'] = $this->cityFirst;

        return $data;
    }
}
