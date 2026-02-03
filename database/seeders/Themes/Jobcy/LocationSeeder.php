<?php

namespace Database\Seeders\Themes\Jobcy;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Supports\BaseSeeder;
use Botble\Location\Models\City;
use Botble\Location\Models\Country;
use Botble\Location\Models\State;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LocationSeeder extends BaseSeeder
{
    public function run(): void
    {
        City::query()->truncate();
        State::query()->truncate();
        Country::query()->truncate();

        $now = Carbon::now();

        $countries = [
            [
                'id' => 1,
                'name' => 'France',
                'nationality' => 'French',
                'code' => 'FRA',
            ],
            [
                'id' => 2,
                'name' => 'England',
                'nationality' => 'English',
                'code' => 'UK',
            ],
            [
                'id' => 3,
                'name' => 'USA',
                'nationality' => 'Americans',
                'code' => 'US',
            ],
            [
                'id' => 4,
                'name' => 'Holland',
                'nationality' => 'Dutch',
                'code' => 'HL',
            ],
            [
                'id' => 5,
                'name' => 'Denmark',
                'nationality' => 'Danish',
                'code' => 'DN',
            ],
            [
                'id' => 6,
                'name' => 'Germany',
                'nationality' => 'Danish',
                'code' => 'DN',
            ],
        ];

        $states = [
            [
                'id' => 1,
                'name' => 'France',
                'abbreviation' => 'FR',
                'country_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'England',
                'abbreviation' => 'EN',
                'country_id' => 2,
            ],
            [
                'id' => 3,
                'name' => 'New York',
                'abbreviation' => 'NY',
                'country_id' => 1,
            ],
            [
                'id' => 4,
                'name' => 'Holland',
                'abbreviation' => 'HL',
                'country_id' => 4,
            ],
            [
                'id' => 5,
                'name' => 'Denmark',
                'abbreviation' => 'DN',
                'country_id' => 5,
            ],
            [
                'id' => 6,
                'name' => 'Germany',
                'abbreviation' => 'GER',
                'country_id' => 1,
            ],
        ];

        $cities = [
            [
                'id' => 1,
                'name' => 'Paris',
                'state_id' => 1,
                'country_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'London',
                'state_id' => 2,
                'country_id' => 2,
            ],
            [
                'id' => 3,
                'name' => 'New York',
                'state_id' => 3,
                'country_id' => 3,
            ],
            [
                'id' => 4,
                'name' => 'New York',
                'state_id' => 4,
                'country_id' => 4,
            ],
            [
                'id' => 5,
                'name' => 'Copenhagen',
                'state_id' => 5,
                'country_id' => 5,
            ],
            [
                'id' => 6,
                'name' => 'Berlin',
                'state_id' => 6,
                'country_id' => 6,
            ],
        ];

        foreach ($countries as $country) {
            $country['order'] = 0;
            $country['is_default'] = 0;
            $country['status'] = BaseStatusEnum::PUBLISHED;
            $country['created_at'] = $now;
            $country['updated_at'] = $now;

            DB::table('countries')->insert($country);
        }

        foreach ($states as $state) {
            $state['order'] = 0;
            $state['is_default'] = 0;
            $state['status'] = BaseStatusEnum::PUBLISHED;
            $state['created_at'] = $now;
            $state['updated_at'] = $now;
            $state['slug'] = Str::slug($state['name']);

            DB::table('states')->insert($state);
        }

        foreach ($cities as $city) {
            $city['status'] = BaseStatusEnum::PUBLISHED;
            $city['record_id'] = null;
            $city['order'] = 0;
            $city['is_default'] = 0;
            $city['created_at'] = $now;
            $city['updated_at'] = $now;
            $city['slug'] = Str::slug($city['name']);

            City::query()->create($city);
        }
    }
}
