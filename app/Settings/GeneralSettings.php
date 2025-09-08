<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;
    public string $logo;
    public ?string $favicon;
    public bool $is_site_active;

    public static function group(): string
    {
        return 'general';
    }
}
