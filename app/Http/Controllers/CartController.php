<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    // نمایش سبد
    public function index()
    {
        try {
            $cart = session('cart', []);

            $total = collect($cart)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });

            Log::info('Cart viewed', ['total' => $total, 'items' => count($cart)]);

            return view('main.pages.cart.index', compact('cart', 'total'));
        } catch (\Exception $e) {
            Log::error('Error loading cart', ['message' => $e->getMessage()]);
            return back()->with('error', 'خطایی در نمایش سبد خرید رخ داد.');
        }
    }

    // افزودن به سبد
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $cart = session('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->id] = [
                'title' => $product->title,
                'quantity' => $request->quantity,
                'price' => $product->discount_price ?? $product->price,
                'main_image' => $product->main_image,
            ];
        }

        session(['cart' => $cart]);
        Log::info('Product added to cart', ['product_id' => $product->id, 'quantity' => $request->quantity]);
        return back()->with('success', 'محصول به سبد اضافه شد.');
    }

    // بروزرسانی تعداد
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session('cart', []);
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            session(['cart' => $cart]);
        }
Log::info('Cart updated', ['product_id' => $request->product_id, 'quantity' => $request->quantity]);
        return back()->with('success', 'تعداد محصول بروزرسانی شد.');
    }

    // حذف محصول
    public function remove(Product $product)
    {
        $cart = session('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session(['cart' => $cart]);
        }
        Log::info('Product removed from cart', ['product_id' => $product->id]);

        return back()->with('success', 'محصول از سبد حذف شد.');
    }
    // پاک کردن کل سبد
    public function clear()
    {
         try {
            session()->forget('cart');
            Log::info('Cart cleared by user');
            return back()->with('success', 'سبد خرید پاک شد.');
        } catch (\Exception $e) {
            Log::error('Error clearing cart', ['message' => $e->getMessage()]);
            return back()->with('error', 'مشکلی در پاک‌سازی سبد خرید پیش آمد.');
        }
    }
}
