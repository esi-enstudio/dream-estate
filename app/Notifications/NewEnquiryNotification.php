<?php

namespace App\Notifications;

use App\Models\Enquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewEnquiryNotification extends Notification
{
    use Queueable;
    public Enquiry $enquiry;

    /**
     * Create a new notification instance.
     */
    public function __construct(Enquiry $enquiry)
    {
        $this->enquiry = $enquiry;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database']; // দুটি চ্যানেলই ব্যবহার করবে
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $property = $this->enquiry->property;
        $url = route('property.details', $property->slug); // অ্যাডমিন প্যানেলের লিঙ্কও দিতে পারেন

        return (new MailMessage)
            ->subject("New Enquiry for your property: {$property->title}")
            ->greeting("Hello {$notifiable->name},")
            ->line("You have received a new enquiry for your property '{$property->title}'.")
            ->line("Enquirer Name: {$this->enquiry->name}")
            ->line("Enquirer Email: {$this->enquiry->email}")
            ->line("Message: {$this->enquiry->message}")
            ->action('View Property Listing', $url)
            ->line('Please respond to the enquiry as soon as possible.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => "New enquiry from {$this->enquiry->name} for {$this->enquiry->property->title}",
            'link' => '#', // অ্যাডমিন প্যানেলের enquiry পেজের লিঙ্ক
            'enquiry_id' => $this->enquiry->id,
        ];
    }
}
