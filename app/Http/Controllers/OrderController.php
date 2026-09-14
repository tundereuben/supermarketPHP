<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public const SHIPPING_FEE = 3000;

    public function checkout(Request $request)
    {
        $cartData = $request->session()->get('cart', []);
        
        if (empty($cartData)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $products = Product::whereIn('id', array_keys($cartData))->get()->keyBy('id');
        $items = [];
        $subtotal = 0;

        foreach ($cartData as $productId => $quantity) {
            if (isset($products[$productId])) {
                $product = $products[$productId];
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'price' => $product->price * $quantity,
                ];
                $subtotal += $product->price * $quantity;
            }
        }

        return view('checkout.index', [
            'items' => $items,
            'subtotal' => $subtotal,
            'shippingFee' => self::SHIPPING_FEE,
            'total' => $subtotal + self::SHIPPING_FEE,
        ]);
    }

    public function store(Request $request)
    {
        $cartData = $request->session()->get('cart', []);
        
        if (empty($cartData)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $validated = $request->validate([
            'guest_name' => ['nullable', 'string', 'max:255'],
            'guest_email' => ['nullable', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:500'],
            'payment_method' => ['nullable', 'string', 'in:cash,card,whatsapp'],
            'card_number' => ['nullable', 'required_if:payment_method,card', 'regex:/^\d{16}$/'],
            'card_expiry' => ['nullable', 'required_if:payment_method,card', 'regex:/^\d{2}\/\d{2}$/'],
            'card_cvv' => ['nullable', 'required_if:payment_method,card', 'regex:/^\d{3,4}$/'],
        ]);

        // No payment method field on the checkout form means the order is finalized manually via WhatsApp
        $validated['payment_method'] = $validated['payment_method'] ?? 'whatsapp';

        if (! auth()->check() && (empty($validated['guest_name']) || empty($validated['guest_email']))) {
            return back()->withInput()->withErrors(['guest_name' => 'Name and email are required for guest checkout.']);
        }

        $products = Product::whereIn('id', array_keys($cartData))->get()->keyBy('id');
        $subtotal = 0;
        $orderItems = [];

        foreach ($cartData as $productId => $quantity) {
            if (isset($products[$productId])) {
                $product = $products[$productId];
                $subtotal += $product->price * $quantity;
                $orderItems[$productId] = ['product' => $product, 'quantity' => $quantity];
            }
        }

        // Process payment if card payment
        $paymentStatus = 'pending';
        if ($validated['payment_method'] === 'card') {
            // Mock payment processing
            $paymentResult = $this->processCardPayment($validated, $subtotal);
            
            if (!$paymentResult['success']) {
                return back()
                    ->withInput()
                    ->with('error', $paymentResult['message']);
            }
            
            $paymentStatus = 'paid';
        }

        try {
            DB::beginTransaction();

            // Create order with payment status
            $order = Order::create([
                'user_id' => auth()->id(),
                'guest_name' => auth()->check() ? null : $validated['guest_name'],
                'guest_email' => auth()->check() ? null : $validated['guest_email'],
                'order_number' => 'ORD-' . date('Y') . '-' . str_pad(Order::count() + 1, 4, '0', STR_PAD_LEFT),
                'subtotal' => $subtotal,
                'shipping_fee' => self::SHIPPING_FEE,
                'total' => $subtotal + self::SHIPPING_FEE,
                'status' => $paymentStatus === 'paid' ? 'processing' : 'pending',
                'shipping_address' => $validated['address'],
                'phone' => $validated['phone'],
                'payment_method' => $validated['payment_method'],
                'payment_status' => $paymentStatus,
            ]);

            // Create order items
            foreach ($orderItems as $productId => $data) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $data['product']->name,
                    'quantity' => $data['quantity'],
                    'price' => $data['product']->price,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error creating order: ' . $e->getMessage());
        }

        // Clear cart
        $request->session()->forget('cart');

        if (! auth()->check()) {
            $request->session()->push('guest_order_ids', $order->id);
        }

        return redirect()->route('checkout.confirmation', $order->id)->with('success', 'Order created successfully!');
    }

    /**
     * Mock card payment processing
     */
    private function processCardPayment($cardData, $amount)
    {
        // Reject blocked test cards
        if (in_array($cardData['card_number'], ['0000000000000000', '9999999999999999'])) {
            return [
                'success' => false,
                'message' => 'Card declined. Please try another card.',
            ];
        }

        // Mock successful payment
        return [
            'success' => true,
            'message' => 'Payment processed successfully',
            'transaction_id' => 'TXN-' . time() . '-' . rand(1000, 9999),
        ];
    }

    public function confirmation(Order $order)
    {
        // Guests own an order only if its id was recorded in their session at checkout time
        $ownsAsGuest = ! auth()->check() && in_array($order->id, session('guest_order_ids', []));

        if (! $ownsAsGuest && $order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $items = $order->items()->with('product')->get();

        return view('checkout.confirmation', [
            'order' => $order,
            'items' => $items,
        ]);
    }
}
