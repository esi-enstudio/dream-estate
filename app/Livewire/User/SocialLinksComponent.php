<?php

namespace App\Livewire\User;

use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Joaopaulolndev\FilamentEditProfile\Concerns\HasSort;

class SocialLinksComponent extends Component implements HasForms
{
    use InteractsWithForms;
    use HasSort;

    public ?array $data = [];

    protected static int $sort = 2;

    public function mount(): void
    {
        // Fill form with existing user's social_links data
        $this->form->fill([
            'social_links' => auth()->user()->social_links ?? [],
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Social Links')
                    ->icon('heroicon-o-link')
                    ->aside()
                    ->description('আপনার ফেসবুক, ইনস্টাগ্রাম, লিংকডইনসহ অন্যান্য সোশ্যাল মিডিয়া প্রোফাইলের লিংক যুক্ত করুন, যাতে মানুষ আপনাকে সহজে খুঁজে পায় ও অনুসরণ করতে পারে।')
                    ->schema([
                        Forms\Components\Repeater::make('social_links')
                            ->label('Add Social Profiles')
                            ->defaultItems(1)
                            ->minItems(1)
                            ->addActionLabel('Add Social Link')
                            ->schema([
                                Forms\Components\Select::make('platform')
                                    ->label('Platform')
                                    ->options([
                                        'facebook' => 'Facebook',
                                        'x-twitter' => 'X Twitter',
                                        'instagram' => 'Instagram',
                                        'linkedin' => 'LinkedIn',
                                        'youtube' => 'YouTube',
                                        'tiktok' => 'TikTok',
                                        'website' => 'Personal Website',
                                    ])
                                    ->required()
                                    ->searchable()
                                    ->native(false),

                                Forms\Components\TextInput::make('profile_url')
                                    ->label('Profile URL')
                                    ->placeholder('https://...')
                                    ->url()
                                    ->required()
                                    ->prefixIcon('heroicon-o-globe-alt'),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }


    public function save(): void
    {
        $data = $this->form->getState();

        // Save to the currently authenticated user
        auth()->user()->update([
            'social_links' => $data['social_links'] ?? [],
        ]);

        Notification::make()
            ->title('Social links updated successfully!')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.user.social-links-component');
    }
}
