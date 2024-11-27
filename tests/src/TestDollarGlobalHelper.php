<?php

use function PHPUnit\Framework\assertEquals;

it('can get money format from dollar() helper', function () {
    $currency = new \TomatoPHP\FilamentLocations\Models\Country;
    $currency->name = 'United States';
    $currency->code = 'EG';
    $currency->iso3 = 'EGY';
    $currency->phone = '02';
    $currency->currency = 'EGP';
    $currency->currency_symbol = 'ج.م';
    $currency->save();
    $setting = dollar(2500);

    assertEquals('<b>' . number_format(2500, 2) . '</b><small>' . $currency->currency_symbol . '</small>', $setting);
});
