<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Illuminate\Support\HtmlString;
use Joaopaulolndev\FilamentEditProfile\Livewire\EditProfileForm;

class CustomUserProfile extends EditProfileForm
{
    protected static int $sort = 1;
    public function mount(): void
    {
        $this->user = $this->getUser();

        $this->userClass = get_class($this->user);

        $fields = ['name', 'phone', 'email'];

        if (filament('filament-edit-profile')->getShouldShowAvatarForm()) {
            $fields[] = config('filament-edit-profile.avatar_column', 'avatar_url');
        }

        $this->form->fill($this->user->only($fields));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('filament-edit-profile::default.profile_information'))
                    ->icon('heroicon-o-user-circle')
                    ->aside()
                    ->description('আপনার অ্যাকাউন্টের প্রোফাইল তথ্য ও ইমেইল ঠিকানা আপডেট করুন।')
                    ->schema([
                        FileUpload::make(config('filament-edit-profile.avatar_column', 'avatar_url'))
                            ->label(__('filament-edit-profile::default.avatar'))
                            ->avatar()
                            ->imageEditor()
                            ->disk(config('filament-edit-profile.disk', 'public'))
                            ->visibility(config('filament-edit-profile.visibility', 'public'))
                            ->directory(filament('filament-edit-profile')->getAvatarDirectory())
                            ->rules(filament('filament-edit-profile')->getAvatarRules())
                            ->hidden(! filament('filament-edit-profile')->getShouldShowAvatarForm()),
                        TextInput::make('name')
                            ->label(__('filament-edit-profile::default.name'))
                            ->required(),

                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->required()
                            ->numeric()
                            ->minLength(11)
                            ->maxLength(11)
                            ->rule('digits:11')
                            ->hint(function (Get $get) {
                                // শুধু create পেজে hint দেখানোর জন্য
                                if (!str(request()->route()->getName())->contains('.create')) {
                                    return null;
                                }

                                $value = $get('phone_number');

                                if (!$value || strlen($value) !== 11) {
                                    return new HtmlString('<span class="text-gray-500">Enter a valid 11-digit number</span>');
                                }

                                $exists = User::where('phone_number', $value)->exists();

                                return new HtmlString(
                                    $exists
                                        ? '<span class="text-red-600 font-medium">Not available</span>'
                                        : '<span class="text-green-600 font-medium">Available</span>'
                                );
                            })
                            ->hintIcon('heroicon-o-phone')
                            ->live(onBlur: true)
                            ->reactive(),

                        TextInput::make('email')
                            ->label(__('filament-edit-profile::default.email'))
                            ->email()
                            ->required()
                            ->hidden(! filament('filament-edit-profile')->getShouldShowEmailForm())
                            ->unique($this->userClass, ignorable: $this->user),
                    ]),
            ])
            ->statePath('data');
    }
}
