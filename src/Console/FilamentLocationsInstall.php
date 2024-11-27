<?php

namespace TomatoPHP\FilamentLocations\Console;

use Illuminate\Console\Command;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;

class FilamentLocationsInstall extends Command
{
    use RunCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'filament-locations:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install package and publish assets';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Publish Vendor Assets');
        $this->artisanCommand(['migrate']);
        $this->artisanCommand(['optimize']);
        if (config('filament-locations.driver') === 'database') {
            $this->artisanCommand(['filament-locations:seed']);
        }
        $this->info('Filament Locations installed successfully.');
    }
}
