<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    public function home()
    {
        return view('home', [
            'categories' => Category::all(),
            'featuredProducts' => Product::where('is_featured', true)->get(),
            'subscriptions' => Subscription::all(),
        ]);
    }

    public function page(string $view)
    {
        return view($view);
    }

    public function products(Request $request)
    {
        $query = Product::with('category');
        $search = trim((string) $request->query('search'));
        $category = $request->query('category');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category) {
            $query->whereHas('category', fn($q) => $q->where('slug', $category));
        }

        $products = $query->paginate(12);

        return view('products.index', [
            'products' => $products,
            'categories' => Category::all(),
        ]);
    }

    public function product(string $slug)
    {
        $product = Product::where('slug', $slug)->with('category', 'orderItems')->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function cart(Request $request)
    {
        $cartData = $request->session()->get('cart', []);
        $items = [];
        $subtotal = 0;

        if (!empty($cartData)) {
            $products = Product::whereIn('id', array_keys($cartData))->get()->keyBy('id');
            foreach ($cartData as $productId => $quantity) {
                if (isset($products[$productId])) {
                    $product = $products[$productId];
                    $items[] = [
                        'product' => $product,
                        'quantity' => $quantity,
                        'total' => $product->price * $quantity,
                    ];
                    $subtotal += $product->price * $quantity;
                }
            }
        }

        return view('cart.index', [
            'items' => $items,
            'subtotal' => $subtotal,
            'shipping' => 0,
            'total' => $subtotal,
        ]);
    }

    public function checkout()
    {
        $cartData = request()->session()->get('cart', []);
        
        if (empty($cartData)) {
            return redirect()->route('cart.index');
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

    public function subscriptions()
    {
        return view('subscriptions.index', ['subscriptions' => Subscription::all()]);
    }
}
