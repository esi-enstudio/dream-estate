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

class BioComponent extends Component implements HasForms
{
    use InteractsWithForms;
    use HasSort;

    public ?array $data = [];

    protected static int $sort = 3;

    public function mount(): void
    {
        // Fill form with existing user's bio data
        $this->form->fill([
            'bio' => auth()->user()->bio ?? [],
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Bio')
                    ->icon('heroicon-o-identification')
                    ->aside()
                    ->description('আপনার সম্পর্কে সংক্ষেপে জানার উপায়। আপনি কে, কী করেন, বা কী নিয়ে আগ্রহী—এই তথ্যগুলো ছোট পরিসরে তুলে ধরুন এখানে।')
                    ->schema([
                        Forms\Components\Textarea::make('bio')
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Save to the currently authenticated user
        auth()->user()->update([
            'bio' => $data['bio'] ?? [],
        ]);

        Notification::make()
            ->title('Bio updated successfully!')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.user.bio-component');
    }
}
