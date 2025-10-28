<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('user.cart', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('id', $request->cart_id)
            ->firstOrFail();

        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->back()->with('success', 'Cart updated successfully.');
    }

    public function remove(Request $request)
    {
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('id', $request->cart_id)
            ->firstOrFail();

        $cartItem->delete();

        return redirect()->back()->with('success', 'Product removed from cart.');
    }

    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Calculate total
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Here you would typically process payment
        // For now, we'll just clear the cart
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('user.products')->with('success', 'Order placed successfully! Total: Rp ' . number_format($total, 0, ',', '.'));
    }
}
