<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $countires = \Illuminate\Support\Facades\File::get(base_path('vendor/tomatophp/filament-locations/database/data/countries.sql'));
        DB::connection()->getPdo()->exec($countires);

        $citites = \Illuminate\Support\Facades\File::get(base_path('vendor/tomatophp/filament-locations/database/data/cities.sql'));
        DB::connection()->getPdo()->exec($citites);

        $areas = \Illuminate\Support\Facades\File::get(base_path('vendor/tomatophp/filament-locations/database/data/areas.sql'));
        DB::connection()->getPdo()->exec($areas);

        $currencies = \Illuminate\Support\Facades\File::get(base_path('vendor/tomatophp/filament-locations/database/data/currencies.sql'));
        DB::connection()->getPdo()->exec($currencies);

        $languages = \Illuminate\Support\Facades\File::get(base_path('vendor/tomatophp/filament-locations/database/data/languages.sql'));
        DB::connection()->getPdo()->exec($languages);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
