<?php

use TomatoPHP\FilamentLocations\Models\Country;
use TomatoPHP\FilamentLocations\Models\Currency;
use TomatoPHP\FilamentLocations\Models\Language;
use TomatoPHP\FilamentLocations\Pages\LocationSettings;
use TomatoPHP\FilamentLocations\Settings\LocationsSettings;
use TomatoPHP\FilamentLocations\Tests\Models\User;
use TomatoPHP\FilamentSettingsHub\Models\Setting;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

beforeEach(function () {
    actingAs(User::factory()->create());
});

it('can render location settings page', function () {
    get(LocationSettings::getUrl())->assertSuccessful();
});

it('has every location setting seeded by the settings migration', function (string $name) {
    $settings = app(LocationsSettings::class);

    assertDatabaseHas(Setting::class, [
        'name' => $name,
        'group' => 'locations',
        'payload' => json_encode($settings->{$name}),
    ]);
})->with(['site_address', 'site_phone_code', 'site_location', 'site_currency', 'site_language']);

it('fills the form with the stored settings', function () {
    livewire(LocationSettings::class)
        ->assertSuccessful()
        ->assertSchemaStateSet([
            'site_address' => 'Cairo, Egypt',
            'site_currency' => 'EGP',
            'site_language' => 'ar',
        ]);
});

it('validates location settings before save', function () {
    livewire(LocationSettings::class)
        ->fillForm(['site_currency' => null])
        ->call('save')
        ->assertHasFormErrors(['site_currency' => 'required']);
});

it('can save location settings', function () {
    // Select fields only accept values from their option lists.
    Country::query()->create(['name' => 'United States', 'code' => 'US', 'phone' => '1', 'currency' => 'USD']);
    Currency::query()->create(['name' => 'US Dollar', 'iso' => 'USD']);
    Language::query()->create(['name' => 'English', 'iso' => 'en']);

    livewire(LocationSettings::class)
        ->fillForm([
            'site_address' => 'New York',
            'site_location' => 'US',
            'site_phone_code' => '1',
            'site_currency' => 'USD',
            'site_language' => 'en',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    assertDatabaseHas(Setting::class, [
        'name' => 'site_currency',
        'group' => 'locations',
        'payload' => json_encode('USD'),
    ]);

    $settings = app(LocationsSettings::class);
    $settings->refresh();

    expect($settings->site_address)->toBe('New York')
        ->and($settings->site_language)->toBe('en');
});

it('fills phone code and currency when the country changes', function () {
    Country::query()->create([
        'name' => 'France',
        'code' => 'FR',
        'phone' => '33',
        'currency' => 'EUR',
    ]);

    livewire(LocationSettings::class)
        ->fillForm(['site_location' => 'FR'])
        ->assertSchemaStateSet([
            'site_phone_code' => '33',
            'site_currency' => 'EUR',
        ]);
});
