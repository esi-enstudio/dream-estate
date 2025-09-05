<?php

namespace App\Livewire;

use App\Models\Enquiry;
use App\Models\Property;
use App\Notifications\NewEnquiryNotification;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class EnquiryForm extends Component
{
    public Property $property;

    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $message = '';
    public string $successMessage = '';

    public function mount(Property $property): void
    {
        $this->property = $property;
        if (auth()->check()) {
            $this->name = auth()->user()->name;
            $this->email = auth()->user()->email;
            $this->phone = auth()->user()->phone;
        }
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|min:11|max:15',
            'message' => 'required|string|min:20|max:1000',
        ];
    }

    public function submit(): void
    {
        $validatedData = $this->validate();

        $enquiry = Enquiry::create([
            'property_id' => $this->property->id,
            'user_id' => auth()->id(), // লগইন করা না থাকলে null হবে
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ]);

        // প্রপার্টি মালিককে নোটিফিকেশন পাঠান
        try {
            $this->property->user->notify(new NewEnquiryNotification($enquiry));
        } catch (\Exception $e) {
            // ইমেইল ফেইল হলেও যেন অ্যাপ্লিকেশন ক্র্যাশ না করে
            // Log::error('Mail sending failed: ' . $e->getMessage());
        }

        $this->successMessage = 'Thank you for your enquiry! We will get back to you shortly.';
        $this->reset('name', 'email', 'phone', 'message');

        // লগইন করা ইউজার হলে নাম ও ইমেইল আবার পূরণ করে দিন
        if (auth()->check()) {
            $this->name = auth()->user()->name;
            $this->email = auth()->user()->email;
            $this->phone = auth()->user()->phone;
        }
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.enquiry-form');
    }
}
