<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscriptions.index', [
            'subscriptions' => Subscription::all(),
        ]);
    }

    public function subscribe(Request $request, Subscription $subscription)
    {
        $request->validate([
            'frequency' => ['required', 'in:monthly,quarterly,yearly'],
        ]);

        // Check if already subscribed
        $existing = auth()->user()->subscriptions()->where('subscription_id', $subscription->id)->first();
        
        if ($existing && $existing->status === 'active') {
            return back()->with('error', 'You are already subscribed to this plan!');
        }

        // Calculate next delivery date
        $now = Carbon::now();
        $frequency = $request->input('frequency', 'monthly');
        
        $nextDeliveryDate = match($frequency) {
            'monthly' => $now->addMonth(),
            'quarterly' => $now->addMonths(3),
            'yearly' => $now->addYear(),
            default => $now->addMonth(),
        };

        // Create or reactivate subscription
        if ($existing) {
            $existing->update([
                'status' => 'active',
                'next_delivery_date' => $nextDeliveryDate,
            ]);
        } else {
            UserSubscription::create([
                'user_id' => auth()->id(),
                'subscription_id' => $subscription->id,
                'status' => 'active',
                'next_delivery_date' => $nextDeliveryDate,
                'shipping_address' => auth()->user()->address,
                'payment_method' => 'card',
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Successfully subscribed to ' . $subscription->name . '!');
    }

    public function cancel(UserSubscription $subscription)
    {
        if ($subscription->user_id !== auth()->id()) {
            abort(403);
        }

        $subscription->update(['status' => 'cancelled']);

        return back()->with('success', 'Subscription cancelled.');
    }
}
