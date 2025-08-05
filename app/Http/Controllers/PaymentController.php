<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Services\ShurjoPayService;
use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $shurjoPayService;

    public function __construct(ShurjoPayService $shurjoPayService)
    {
        $this->shurjoPayService = $shurjoPayService;
    }

    public function initiatePayment(Plan $plan): Application|Redirector|RedirectResponse
    {
        $user = Auth::user();

        // Check if user has a phone number
        if (!$user->phone) {
            // You can redirect back with an error, or to a profile page
            return redirect()->route('profile.edit')->with('error', 'Please add your phone number to proceed with the payment.');
        }

        $paymentData = [
            'amount' => $plan->price,
            'plan_id' => $plan->id,
            'user_id' => $user->id,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => $user->phone, // Using actual phone number
        ];

        $response = $this->shurjoPayService->initiatePayment($paymentData);

        if (isset($response['error'])) {
            return redirect()->route('pricing')->with('error', $response['error']);
        }

        // Create a pending transaction record
        Transaction::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'order_id' => $response['order_id'],
            'amount' => $plan->price,
            'status' => 'pending',
        ]);

        return redirect($response['redirect_url']);
    }

    public function paymentCallback(Request $request): RedirectResponse
    {
        $orderId = $request->input('order_id');
        if (!$orderId) {
            return redirect()->route('pricing')->with('error', 'Invalid payment callback.');
        }

        $transaction = Transaction::where('order_id', $orderId)->firstOrFail();

        // Avoid reprocessing a completed transaction
        if ($transaction->status === 'completed') {
            return redirect()->route('dashboard')->with('success', 'Your subscription is already active.');
        }

        $verificationResponse = $this->shurjoPayService->verifyPayment($orderId);

        if (isset($verificationResponse[0]['sp_code']) && $verificationResponse[0]['sp_code'] == '1000') {

            // Payment is successful
            $transaction->update([
                'status' => 'completed',
                'response' => json_encode($verificationResponse[0]),
            ]);

            $plan = $transaction->plan;
            $user = $transaction->user;

            // Calculate the end date based on the billing cycle
            $endsAt = Carbon::now();
            if ($plan->billing_cycle === 'monthly') {
                $endsAt->addMonth(); // এটি সঠিকভাবে মাস যোগ করে (২৮/২৯/৩০/৩১ দিনের হিসাব নিজে থেকেই করে)
            } elseif ($plan->billing_cycle === 'weekly') {
                $endsAt->addWeek();
            }
            // আপনি ভবিষ্যতে 'yearly' যোগ করলে -> elseif ($plan->billing_cycle === 'yearly') { $endsAt->addYear(); }

            // Create or update subscription
            Subscription::updateOrCreate(
                ['user_id' => $user->id], // Find an existing subscription for the user
                [
                    'plan_id' => $plan->id,
                    'starts_at' => Carbon::now(),
                    'ends_at' => $endsAt, // এখানে আমরা আমাদের গণনাকৃত তারিখ ব্যবহার করছি
                    'status' => 'active',
                ]
            );

            // Redirect to a success page or dashboard
            return redirect()->route('dashboard')->with('success', 'Subscription activated successfully!');
        }

        // Payment failed or is in a different state
        $transaction->update([
            'status' => 'failed',
            'response' => json_encode($verificationResponse[0] ?? ['error' => 'Verification failed']),
        ]);

        return redirect()->route('pricing')->with('error', $verificationResponse[0]['sp_message'] ?? 'Payment failed.');
    }

    public function paymentCancel(Request $request): RedirectResponse
    {
        $orderId = $request->input('order_id');
        if ($orderId) {
            Transaction::where('order_id', $orderId)->update(['status' => 'cancelled']);
        }
        return redirect()->route('pricing')->with('error', 'Payment was cancelled.');
    }
}
