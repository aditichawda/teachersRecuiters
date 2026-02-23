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
        $stateName = $this->state ? $this->state->name : '';
        $label = $stateName ? $this->name . ', ' . $stateName : $this->name;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'state_name' => $stateName,
            'label' => $label,
        ];
    }
}
