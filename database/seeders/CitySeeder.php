<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function getListsOfCities(): array
    {
        return
            [
                [
                    "name" => "Ḩeşār-e Sefīd",
                    "api_city_id" => 833
                ],
                [
                    "name" => "Taglag",
                    "api_city_id" => 3245
                ],
                [
                    "name" => "Gollar",
                    "api_city_id" => 18007
                ],
                [
                    "name" => "Kalāteh-ye Dowlat",
                    "api_city_id" => 7264
                ],
                [
                    "name" => "Behjatābād",
                    "api_city_id" => 8084
                ],
                [
                    "name" => "Ţālesh Maḩalleh",
                    "api_city_id" => 9874
                ],
                [
                    "name" => "Shahrīār Kandeh",
                    "api_city_id" => 11263
                ],
                [
                    "name" => "Dīgāleh",
                    "api_city_id" => 18093
                ],
                [
                    "name" => "Mountain View",
                    "api_city_id" => 420006353
                ],
                [
                    "name" => "Cairns",
                    "api_city_id" => 2172797
                ]
            ];
    }

    public function isEmpty()
    {
        return DB::table('cities')->get()->count() === 0;
    }

    public function run()
    {
        if ($this->isEmpty())
            DB::table('cities')->insert($this->getListsOfCities());
    }
}
