<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('locations.site_address', 'Cairo, Egypt');
        $this->migrator->add('locations.site_phone_code', '02');
        $this->migrator->add('locations.site_location', 'EG');
        $this->migrator->add('locations.site_currency', 'EGP');
        $this->migrator->add('locations.site_language', 'ar');
    }
};
