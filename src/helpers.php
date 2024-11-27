<?php

try {
    if (! function_exists('dollar')) {
        function dollar(float | int $total): false | string
        {
            $getDollar = \TomatoPHP\FilamentLocations\Models\Country::query()->where('currency', setting('site_currency'))->first();
            if ($getDollar) {
                return '<b>' . number_format($total, 2) . "</b><small>$getDollar->currency_symbol</small>";
            } else {
                return false;
            }
        }
    }
} catch (\Exception $e) {
    if (! function_exists('dollar')) {
        function dollar(float | int $total): false | string
        {
            return number_format($total, 2);
        }
    }
}
