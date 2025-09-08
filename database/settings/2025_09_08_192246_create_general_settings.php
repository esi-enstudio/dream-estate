<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'My Home Estate');
        $this->migrator->add('general.logo', '');
        $this->migrator->add('general.favicon', '');
        $this->migrator->add('general.is_site_active', true);
    }

    public function down(): void
    {
        $this->migrator->delete('general.site_name');
        $this->migrator->delete('general.logo');
        $this->migrator->delete('general.favicon');
        $this->migrator->delete('general.is_site_active');
    }
};
