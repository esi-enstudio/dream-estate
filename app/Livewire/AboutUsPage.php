<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class AboutUsPage extends Component
{
    // এই পেজের জন্য আমাদের কোনো বিশেষ PHP লজিকের প্রয়োজন নেই,
    // কারণ আমরা অন্য Livewire কম্পোনেন্টগুলোকে কল করব।

    public function render(): Factory|View|Application
    {
        return view('livewire.about-us-page');
    }
}
