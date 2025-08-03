<?php

namespace App\Livewire\Properties\Rent;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class RentPropertiesPage extends Component
{
    public function render(): Factory|View|Application
    {
        return view('livewire.properties.rent.rent-properties-page');
    }
}
