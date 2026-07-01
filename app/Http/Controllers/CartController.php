<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        
        $cart = $request->session()->get('cart', []);
        $cart[$product->id] = ($cart[$product->id] ?? 0) + 1;
        
        $request->session()->put('cart', $cart);
        
        return back()->with('success', "{$product->name} added to cart!");
    }

    public function update(Request $request, int $productId)
    {
        $quantity = (int) $request->input('quantity', 1);
        
        if ($quantity < 1) {
            return $this->remove($request, $productId);
        }

        $cart = $request->session()->get('cart', []);
        $cart[$productId] = $quantity;
        
        $request->session()->put('cart', $cart);
        
        return back()->with('success', 'Cart updated!');
    }

    public function remove(Request $request, int $productId)
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$productId]);
        
        $request->session()->put('cart', $cart);
        
        return back()->with('success', 'Item removed from cart!');
    }
}
