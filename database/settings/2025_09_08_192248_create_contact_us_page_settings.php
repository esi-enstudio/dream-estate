<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('contact_page.toll_free_number', '');
        $this->migrator->add('contact_page.email1', '');
        $this->migrator->add('contact_page.email2', '');
        $this->migrator->add('contact_page.phone_number1', '');
        $this->migrator->add('contact_page.phone_number2', '');
        $this->migrator->add('contact_page.address', '');
    }

    public function down(): void
    {
        $this->migrator->delete('contact_page.hero_title');
        $this->migrator->delete('contact_page.hero_description');
    }
};
