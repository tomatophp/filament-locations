<?php

use Illuminate\Support\Facades\DB;

use function Pest\Laravel\artisan;

it('seeds the locations tables from the bundled json files', function () {
    artisan('filament-locations:seed')
        ->expectsOutputToContain('Seeding the database with locations data is completed.')
        ->assertSuccessful();

    expect(DB::table('countries')->count())->toBeGreaterThan(200)
        ->and(DB::table('currencies')->count())->toBeGreaterThan(100)
        ->and(DB::table('languages')->count())->toBeGreaterThan(100)
        ->and(DB::table('countries')->where('code', 'EG')->exists())->toBeTrue();
});

it('registers the install command', function () {
    expect(array_keys(Artisan::all()))
        ->toContain('filament-locations:install')
        ->toContain('filament-locations:seed');
});
