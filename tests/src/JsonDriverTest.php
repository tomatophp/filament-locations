<?php

use Illuminate\Database\Eloquent\Model;
use TomatoPHP\FilamentLocations\Models\Area;
use TomatoPHP\FilamentLocations\Models\City;
use TomatoPHP\FilamentLocations\Models\Country;
use TomatoPHP\FilamentLocations\Models\Currency;
use TomatoPHP\FilamentLocations\Models\Language;
use TomatoPHP\FilamentLocations\Resources\CountryResource;
use TomatoPHP\FilamentLocations\Tests\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

// The json driver is the default: rows come from database/data/*.json through Sushi.
beforeEach(function () {
    config()->set('filament-locations.driver', 'json');
    Model::clearBootedModels();
});

afterEach(function () {
    config()->set('filament-locations.driver', 'database');
    Model::clearBootedModels();
});

it('reads every model from the bundled json files', function (string $model) {
    // Laravel 12.8+ throws when a model is instantiated while it is still booting.
    expect($model::query()->first())->not->toBeNull()
        ->and($model::query()->count())->toBeGreaterThan(0);
})->with([
    Country::class,
    City::class,
    Area::class,
    Currency::class,
    Language::class,
]);

it('resolves relations between json models', function () {
    $country = Country::query()->where('code', 'EG')->firstOrFail();

    expect($country->cities()->count())->toBeGreaterThan(0)
        ->and($country->cities()->first()->country->is($country))->toBeTrue();
});

it('renders the countries page on the json driver', function () {
    actingAs(User::factory()->create());

    get(CountryResource::getUrl('index'))->assertSuccessful();
});
