<?php

namespace App\Livewire;

use App\Models\Property;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\On;
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

    /**
     * প্যারেন্ট কম্পোনেন্ট থেকে 'refresh-wishlist-button' ইভেন্টটি শোনার জন্য
     */
    #[On('refresh-wishlist-button')]
    public function refreshComponent()
    {
        // এই মেথডটি খালি থাকলেও, এটি Livewire-কে এই কম্পোনেন্টটিকে
        // সম্পূর্ণরূপে re-render করার জন্য ট্রিগার করবে।
        // এর ফলে, এর DOM এবং জাভাস্ক্রিপ্ট ইভেন্ট লিসেনারগুলো পুনরুদ্ধার হবে।
    }

    public function toggleWishlist()
    {
        if (!auth()->check()) {
            return $this->redirect(route('filament.app.auth.login')); // Livewire v3 তে navigate ব্যবহার করুন
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
