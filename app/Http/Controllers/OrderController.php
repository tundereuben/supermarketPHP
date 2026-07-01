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
    public function checkout(Request $request)
    {
        $cartData = $request->session()->get('cart', []);
        
        if (empty($cartData)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $products = Product::whereIn('id', array_keys($cartData))->get()->keyBy('id');
        $items = [];
        $total = 0;

        foreach ($cartData as $productId => $quantity) {
            if (isset($products[$productId])) {
                $product = $products[$productId];
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'price' => $product->price * $quantity,
                ];
                $total += $product->price * $quantity;
            }
        }

        return view('checkout.index', [
            'items' => $items,
            'total' => $total,
        ]);
    }

    public function store(Request $request)
    {
        $cartData = $request->session()->get('cart', []);
        
        if (empty($cartData)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:500'],
            'payment_method' => ['required', 'string', 'in:cash,card'],
        ]);

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

        try {
            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . date('Y') . '-' . str_pad(Order::count() + 1, 4, '0', STR_PAD_LEFT),
                'subtotal' => $subtotal,
                'shipping_fee' => 0,
                'total' => $subtotal,
                'status' => 'pending',
                'shipping_address' => $validated['address'],
                'phone' => $validated['phone'],
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'pending',
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

        return redirect()->route('orders.index')->with('success', 'Order created successfully! Order #' . $order->order_number);
    }
}
