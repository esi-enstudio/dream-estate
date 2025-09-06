<?php

namespace App\Livewire;

use App\Models\Property;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class WishlistButton extends Component
{
    public Property $property;
    public bool $isInWishlist;

    public string $class = '';

    public function mount(Property $property): void
    {
        $this->property = $property;
        $this->updateWishlistStatus();
    }

    public function toggleWishlist()
    {
        if (!auth()->check()) {
            return $this->redirect(route('filament.superadmin.auth.login')); // Livewire v3 তে navigate ব্যবহার করুন
        }

        // toggle() মেথডটি স্বয়ংক্রিয়ভাবে পিভট টেবিল থেকে আইডি যোগ বা মুছে ফেলে
        auth()->user()->wishlist()->toggle($this->property->id);

        // স্টেট আপডেট করুন এবং একটি ইভেন্ট পাঠান (ঐচ্ছিক, নোটিফিকেশনের জন্য)
        $this->updateWishlistStatus();
        $this->dispatch('wishlist-updated', ['message' => $this->isInWishlist ? 'Added to wishlist!' : 'Removed from wishlist!']);
    }

    // বর্তমান স্ট্যাটাস চেক এবং আপডেট করার জন্য
    private function updateWishlistStatus(): void
    {
        $this->isInWishlist = auth()->check()
            ? auth()->user()->wishlist()->where('property_id', $this->property->id)->exists()
            : false;
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.wishlist-button');
    }
}
