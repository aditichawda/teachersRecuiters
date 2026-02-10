<?php

namespace Theme\Jobcy\Http\Resources;

use Botble\Location\Models\City;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin City
 */
class CityResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'state_name' => $this->state->name,
            'label' => implode(', ', array_filter([$this->name, $this->state->name])),
        ];
    }
}
