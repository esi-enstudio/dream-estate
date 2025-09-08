<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class FooterSettings extends Settings
{
    public string $about_section_paragraph;
    public string $address;
    public string $contact_number;
    public string $email;

    // Repeater থেকে আসা ডেটা সংরক্ষণের জন্য
    public ?array $social_links;
    public string $copyright;

    public static function group(): string
    {
        return 'footer';
    }
}
