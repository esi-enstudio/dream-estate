<?php

namespace App\Livewire;

use App\Models\Plan;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class PricingPage extends Component
{
    public $monthlyPlans;
    public $weeklyPlans;

    public function mount(): void
    {
        $this->monthlyPlans = Plan::where('billing_cycle', 'monthly')
            ->orderBy('price')
            ->get();

        $this->weeklyPlans = Plan::where('billing_cycle', 'weekly')
            ->orderBy('price')
            ->get();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.pricing-page');
    }
}
