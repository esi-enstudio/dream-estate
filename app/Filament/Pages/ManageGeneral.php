<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageGeneral extends SettingsPage
{
    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Settings';

    protected static ?int $navigationSort = 1;

    protected static string $settings = GeneralSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('site_name')->required(),
                        Forms\Components\FileUpload::make('favicon')->required()->image()->directory('logos/favicon'),
                        Forms\Components\FileUpload::make('logo')->required()->image()->directory('logos'),
                        Forms\Components\Toggle::make('is_site_active')
                            ->columnSpanFull()
                            ->label('Site Active'),
                    ]),
            ]);
    }
}
