<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class HomePage extends Component
{
    public function render(): Factory|View|Application
    {
        return view('livewire.home-page');
    }
}
