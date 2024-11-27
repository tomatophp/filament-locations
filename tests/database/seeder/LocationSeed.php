<?php

namespace TomatoPHP\FilamentLocations\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeed extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $countryJson = config('filament-locations.json.countries') ?: __DIR__ . '/../../../database/data/countries.json';
        $cityJson = config('filament-locations.json.cities') ?: __DIR__ . '/../../../database/data/cities.json';
        $areaJson = config('filament-locations.json.areas') ?: __DIR__ . '/../../../database/data/areas.json';
        $currencyJson = config('filament-locations.json.currencies') ?: __DIR__ . '/../../../database/data/currencies.json';
        $languageJson = config('filament-locations.json.languages') ?: __DIR__ . '/../../../database/data/languages.json';

        $countryFileExists = file_exists($countryJson);
        $cityFileExists = file_exists($cityJson);
        $areaFileExists = file_exists($areaJson);
        $currencyFileExists = file_exists($currencyJson);
        $languageFileExists = file_exists($languageJson);

        if ($countryFileExists) {
            $countries = json_decode(file_get_contents($countryJson), true);
            foreach ($countries as $country) {
                DB::table('countries')->insert($country);
            }
        }

        if ($cityFileExists) {
            $cities = json_decode(file_get_contents($cityJson), true);
            foreach ($cities as $city) {
                DB::table('cities')->insert($city);
            }
        }

        if ($areaFileExists) {
            $areas = json_decode(file_get_contents($areaJson), true);
            foreach ($areas as $area) {
                DB::table('areas')->insert($area);
            }
        }

        if ($currencyFileExists) {
            $currencies = json_decode(file_get_contents($currencyJson), true);
            foreach ($currencies as $currency) {
                DB::table('currencies')->insert($currency);
            }
        }

        if ($languageFileExists) {
            $languages = json_decode(file_get_contents($languageJson), true);
            foreach ($languages as $language) {
                DB::table('languages')->insert($language);
            }
        }
    }
}
