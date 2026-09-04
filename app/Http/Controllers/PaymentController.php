<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Mock payment processing for Paystack/Flutterwave
     * In production, this would integrate with actual payment gateway APIs
     */
    public function process(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => ['required', 'in:cash,card'],
            'card_number' => ['nullable', 'required_if:payment_method,card', 'regex:/^\d{16}$/'],
            'card_expiry' => ['nullable', 'required_if:payment_method,card', 'regex:/^\d{2}\/\d{2}$/'],
            'card_cvv' => ['nullable', 'required_if:payment_method,card', 'regex:/^\d{3,4}$/'],
        ]);

        // Cash on Delivery - Always succeeds
        if ($validated['payment_method'] === 'cash') {
            return response()->json([
                'success' => true,
                'message' => 'Payment method selected: Cash on Delivery',
                'payment_status' => 'pending',
                'transaction_id' => 'COD-' . time(),
            ]);
        }

        // Mock Card Payment - Simulate Paystack/Flutterwave
        // In production: Send to actual gateway, wait for webhook
        // For demo: Accept any 16-digit number (test cards: 4111111111111111, 5555555555554444)
        
        $cardNumber = $validated['card_number'];
        
        // Mock validation - reject certain test cards
        if (in_array($cardNumber, ['0000000000000000', '9999999999999999'])) {
            return response()->json([
                'success' => false,
                'message' => 'Card declined. Please try another card.',
            ], 422);
        }

        // Mock successful payment
        // In production: Wait for webhook confirmation from payment gateway
        // For now: Instant success after "processing"
        
        $transactionId = $this->generateTransactionId();
        
        return response()->json([
            'success' => true,
            'message' => 'Payment processed successfully',
            'payment_status' => 'paid',
            'transaction_id' => $transactionId,
            'amount' => $request->input('amount'),
            'currency' => 'NGN',
        ]);
    }

    /**
     * Generate mock transaction ID (Paystack style)
     */
    private function generateTransactionId()
    {
        $timestamp = time();
        $random = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        return 'TXN-' . $timestamp . '-' . $random;
    }

    /**
     * Verify payment status (for webhook/callback)
     * In production: Check with payment gateway API
     */
    public function verify($transactionId)
    {
        // Mock verification - check if transaction ID format is valid
        if (!str_starts_with($transactionId, ['TXN-', 'COD-'])) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'transaction_id' => $transactionId,
            'status' => 'confirmed',
            'message' => 'Payment verified',
        ]);
    }
}
