<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ContactUsPage extends Component
{
    // Form State
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $subject = '';
    public string $message = '';

    protected function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|string|min:11',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:20',
        ];
    }

    public function submitForm(): void
    {
        $validatedData = $this->validate();

        ContactMessage::create($validatedData);

        // অ্যাডমিনকে নোটিফিকেশন পাঠানোর লজিক এখানে যোগ করা যেতে পারে

        $this->reset();
        session()->flash('success', 'আপনার বার্তাটি সফলভাবে পাঠানো হয়েছে। আমরা শীঘ্রই আপনার সাথে যোগাযোগ করব।');
    }

    public function render()
    {
        return view('livewire.contact-us-page');
    }
}
