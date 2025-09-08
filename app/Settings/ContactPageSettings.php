<?php
namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ContactPageSettings extends Settings
{
    public ?string $banner_title;
    public ?string $form_title;
    public ?array $contact_cards; // Repeater থেকে আসা ডেটা

    public static function group(): string
    {
        return 'contact_page';
    }
}
