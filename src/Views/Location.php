<?php

namespace TomatoPHP\FilamentLocations\Views;

use Illuminate\View\Component;

class Location extends Component
{
    public function __construct()
    {
    }

    public function render()
    {
        return view('filament-locations::components.location');
    }

}
