<?php

namespace Theme\Jobzilla\Http\Resources;

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
            'label' => $this->name . ', ' . $this->state->name,
        ];
    }
}
