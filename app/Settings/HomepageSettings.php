<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class HomepageSettings extends Settings
{
    public string $hero_title;
    public string $hero_description;

    public static function group(): string
    {
        return 'homepage';
    }
}
