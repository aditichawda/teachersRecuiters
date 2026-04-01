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
        $stateId = $this->state_id ?? ($this->state ? $this->state->id : null);
        $countryName = $this->country ? $this->country->name : '';
        $countryId = $this->country_id ?? ($this->country ? $this->country->id : null);
        $label = $stateName ? $this->name . ', ' . $stateName : $this->name;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'state_id' => $stateId,
            'state_name' => $stateName,
            'country_id' => $countryId,
            'country_name' => $countryName,
            'label' => $label,
        ];
    }
}
