<?php

use TomatoPHP\FilamentLocations\Models\Area;
use TomatoPHP\FilamentLocations\Models\City;
use TomatoPHP\FilamentLocations\Models\Country;
use TomatoPHP\FilamentLocations\Models\Currency;
use TomatoPHP\FilamentLocations\Models\Language;
use TomatoPHP\FilamentLocations\Models\Location;
use TomatoPHP\FilamentLocations\Resources\CityResource;
use TomatoPHP\FilamentLocations\Resources\CountryResource;
use TomatoPHP\FilamentLocations\Resources\CountryResource\Pages\CreateCountry;
use TomatoPHP\FilamentLocations\Resources\CountryResource\Pages\EditCountry;
use TomatoPHP\FilamentLocations\Resources\CountryResource\Pages\ListCountries;
use TomatoPHP\FilamentLocations\Resources\CountryResource\Pages\ViewCountry;
use TomatoPHP\FilamentLocations\Resources\CurrencyResource;
use TomatoPHP\FilamentLocations\Resources\CurrencyResource\Pages\ListCurrencies;
use TomatoPHP\FilamentLocations\Resources\LanguageResource;
use TomatoPHP\FilamentLocations\Resources\LanguageResource\Pages\ListLanguages;
use TomatoPHP\FilamentLocations\Resources\LocationResource;
use TomatoPHP\FilamentLocations\Resources\LocationResource\Pages\ListLocations;
use TomatoPHP\FilamentLocations\Tests\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

beforeEach(function () {
    actingAs(User::factory()->create());

    $this->country = Country::query()->create([
        'name' => 'Egypt',
        'code' => 'EG',
        'phone' => '20',
        'currency' => 'EGP',
        'currency_symbol' => 'EGP',
        'iso3' => 'EGY',
    ]);

    $this->city = City::query()->create([
        'name' => 'Cairo',
        'country_id' => $this->country->id,
    ]);

    $this->area = Area::query()->create([
        'name' => 'Maadi',
        'city_id' => $this->city->id,
    ]);
});

it('renders every resource index page', function (string $resource) {
    get($resource::getUrl('index'))->assertSuccessful();
})->with([
    CountryResource::class,
    CurrencyResource::class,
    LanguageResource::class,
    LocationResource::class,
]);

it('renders the country create, edit and view pages', function () {
    get(CountryResource::getUrl('create'))->assertSuccessful();
    get(CountryResource::getUrl('edit', ['record' => $this->country]))->assertSuccessful();
    get(CountryResource::getUrl('view', ['record' => $this->country]))->assertSuccessful();
});

it('renders the city edit and view pages', function () {
    get(CityResource::getUrl('edit', ['record' => $this->city]))->assertSuccessful();
    get(CityResource::getUrl('view', ['record' => $this->city]))->assertSuccessful();
});

it('lists countries in the table', function () {
    livewire(ListCountries::class)
        ->assertSuccessful()
        ->assertCanSeeTableRecords([$this->country]);
});

it('creates a country', function () {
    livewire(CreateCountry::class)
        ->fillForm([
            'name' => 'France',
            'code' => 'FR',
            'phone' => '33',
            'currency' => 'EUR',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas('countries', ['name' => 'France', 'code' => 'FR', 'phone' => '33']);
});

it('validates the country form', function () {
    livewire(CreateCountry::class)
        ->fillForm(['name' => null, 'code' => null, 'phone' => null])
        ->call('create')
        ->assertHasFormErrors(['name' => 'required', 'code' => 'required', 'phone' => 'required']);
});

it('edits a country', function () {
    livewire(EditCountry::class, ['record' => $this->country->getRouteKey()])
        ->assertSchemaStateSet(['name' => 'Egypt', 'code' => 'EG'])
        ->fillForm(['name' => 'Arab Republic of Egypt'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($this->country->refresh()->name)->toBe('Arab Republic of Egypt');
});

it('views a country with its cities relation manager', function () {
    livewire(ViewCountry::class, ['record' => $this->country->getRouteKey()])
        ->assertSuccessful();

    livewire(CountryResource\RelationManagers\CitiesRelationManager::class, [
        'ownerRecord' => $this->country,
        'pageClass' => ViewCountry::class,
    ])
        ->assertSuccessful()
        ->assertCanSeeTableRecords([$this->city]);
});

it('shows the areas of a city', function () {
    livewire(CityResource\RelationManagers\AreasRelationManager::class, [
        'ownerRecord' => $this->city,
        'pageClass' => CityResource\Pages\ViewCity::class,
    ])
        ->assertSuccessful()
        ->assertCanSeeTableRecords([$this->area]);
});

it('creates a currency and a language from the manage pages', function () {
    livewire(ListCurrencies::class)
        ->callAction('create', data: ['name' => 'Euro', 'iso' => 'EUR', 'symbol' => 'E'])
        ->assertHasNoActionErrors();

    livewire(ListLanguages::class)
        ->callAction('create', data: ['name' => 'French', 'iso' => 'fr'])
        ->assertHasNoActionErrors();

    assertDatabaseHas('currencies', ['iso' => 'EUR', 'name' => 'Euro']);
    assertDatabaseHas('languages', ['iso' => 'fr', 'name' => 'French']);
    expect(Currency::query()->where('iso', 'EUR')->exists())->toBeTrue()
        ->and(Language::query()->where('iso', 'fr')->exists())->toBeTrue();
});

it('creates and edits a location', function () {
    livewire(ListLocations::class)
        ->callAction('create', data: [
            'country_id' => $this->country->id,
            'city_id' => $this->city->id,
            'area_id' => $this->area->id,
            'street' => '9 Road',
            'zip' => '11728',
        ])
        ->assertHasNoActionErrors();

    $location = Location::query()->where('street', '9 Road')->firstOrFail();

    expect($location->country->name)->toBe('Egypt')
        ->and($location->city->name)->toBe('Cairo')
        ->and($location->area->name)->toBe('Maadi');

    livewire(ListLocations::class)
        ->callTableAction('edit', $location, data: ['street' => '10 Road'])
        ->assertHasNoTableActionErrors();

    expect($location->refresh()->street)->toBe('10 Road');
});

it('requires a street for a location', function () {
    livewire(ListLocations::class)
        ->callAction('create', data: ['street' => null])
        ->assertHasActionErrors(['street' => 'required']);
});

it('stores the owner of a location in the model morph columns', function () {
    $user = User::query()->first();

    $location = Location::query()->create([
        'model_type' => $user::class,
        'model_id' => $user->id,
        'street' => 'Owner street',
    ]);

    expect($location->refresh()->model_type)->toBe($user::class)
        ->and($location->model->is($user))->toBeTrue();
});
