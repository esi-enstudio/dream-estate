<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('homepage.hero_title', 'Add Title Here...');
        $this->migrator->add('homepage.hero_description', 'Add description here...');
    }

    public function down(): void
    {
        $this->migrator->delete('homepage.hero_title');
        $this->migrator->delete('homepage.hero_description');
    }
};
