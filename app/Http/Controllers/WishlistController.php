<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $products = auth()->user()->wishlists()->with('product')->paginate(9);
        
        return view('wishlist.index', [
            'products' => $products->map(fn($wishlist) => $wishlist->product),
            'wishlists' => $products,
        ]);
    }

    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Check if already in wishlist
        $exists = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->exists();

        if ($exists) {
            return back()->with('info', 'Product already in your wishlist!');
        }

        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        return back()->with('success', $product->name . ' added to wishlist!');
    }

    public function remove($wishlistId)
    {
        $wishlist = Wishlist::findOrFail($wishlistId);

        if ($wishlist->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $productName = $wishlist->product->name;
        $wishlist->delete();

        return back()->with('success', $productName . ' removed from wishlist!');
    }

    public function isWishlisted($productId)
    {
        return Wishlist::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->exists();
    }
}
