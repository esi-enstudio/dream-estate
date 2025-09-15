<?php

namespace App\Filament\Pages;

use App\Settings\ContactPageSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageContactUs extends SettingsPage
{
    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Contact Us';

    protected static ?int $navigationSort = 3;

    protected static string $settings = ContactPageSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('toll_free_number')->string(),
                        Forms\Components\TextInput::make('phone_number1')->string(),
                        Forms\Components\TextInput::make('phone_number2')->string(),
                        Forms\Components\TextInput::make('email1')->email(),
                        Forms\Components\TextInput::make('email2')->email(),
                        Forms\Components\TextInput::make('address'),
                    ]),
            ]);
    }
}
