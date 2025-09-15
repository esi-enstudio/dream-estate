<?php
namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ContactPageSettings extends Settings
{
    public ?string $toll_free_number;
    public ?string $email1;
    public ?string $email2;
    public ?string $phone_number1;
    public ?string $phone_number2;
    public ?string $address;

    public static function group(): string
    {
        return 'contact_page';
    }
}
