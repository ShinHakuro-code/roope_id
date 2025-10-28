<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with(['product:id,name,price']) // muat yang perlu saja
            ->get();

        $total = $cartItems->sum(function ($item) {
            return (float) $item->product->price * (int) $item->quantity;
        });

        return view('user.cart', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $userId  = Auth::id();
        $product = Product::findOrFail($data['product_id']);

        // Jika ada kolom stock, cek stok gabungan (lama + baru)
        $existing = Cart::where('user_id', $userId)
            ->where('product_id', $data['product_id'])
            ->first();

        $newQty = ($existing?->quantity ?? 0) + (int) $data['quantity'];

        if (isset($product->stock) && $product->stock < $newQty) {
            return back()->with('error', "Stok {$product->name} tidak cukup. Tersedia: {$product->stock}");
        }

        if ($existing) {
            $existing->update(['quantity' => $newQty]);
        } else {
            Cart::create([
                'user_id'    => $userId,
                'product_id' => $data['product_id'],
                'quantity'   => $data['quantity'],
            ]);
        }

        return back()->with('success', 'Product added to cart successfully.');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'cart_id'  => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('id', $data['cart_id'])
            ->with('product')
            ->firstOrFail();

        // Cek stok jika ada kolom stock
        if (isset($cartItem->product->stock) && $cartItem->product->stock < (int) $data['quantity']) {
            return back()->with('error', "Stok {$cartItem->product->name} tidak cukup. Tersedia: {$cartItem->product->stock}");
        }

        $cartItem->update(['quantity' => (int) $data['quantity']]);

        return back()->with('success', 'Cart updated successfully.');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id'
        ]);

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('id', $request->cart_id)
            ->firstOrFail();

        $cartItem->delete();

        return back()->with('success', 'Product removed from cart.');
    }

    public function checkout(Request $request)
    {
        // Sesuaikan field ini dengan migration kamu (orders: customer_name, customer_phone, shipping_address)
        $payload = $request->validate([
            'customer_name'    => 'required|string|max:100',
            'customer_phone'   => 'required|string|max:30',
            'shipping_address' => 'nullable|string|max:500',
        ]);

        $userId    = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        try {
            $order = DB::transaction(function () use ($cartItems, $userId, $payload) {
                // Kunci baris produk agar stok konsisten saat concurrent checkout
                $productIds = $cartItems->pluck('product_id')->all();
                $products   = Product::whereIn('id', $productIds)
                                ->lockForUpdate()->get()->keyBy('id');

                $total = 0.0;

                // Buat order dulu (total 0, nanti update)
                $order = Order::create([
                    'user_id'          => $userId,
                    'total_amount'     => 0,
                    'status'           => 'pending',
                    'shipping_address' => $payload['shipping_address'] ?? null,
                    'customer_name'    => $payload['customer_name'],
                    'customer_phone'   => $payload['customer_phone'],
                ]);

                foreach ($cartItems as $item) {
                    $product = $products[$item->product_id];

                    // Validasi stok jika ada
                    if (isset($product->stock) && $product->stock < $item->quantity) {
                        throw new \RuntimeException("Stok {$product->name} tidak cukup (tersedia: {$product->stock}).");
                    }

                    $price    = (float) $product->price; // decimal(10,2)
                    $qty      = (int) $item->quantity;
                    $subtotal = $price * $qty;
                    $total   += $subtotal;

                    OrderItem::create([
                        'order_id'   => $order->id,
                        'product_id' => $product->id,
                        'quantity'   => $qty,
                        'price'      => $price, // snapshot harga
                    ]);

                    // Kurangi stok jika ada kolom stock
                    if (isset($product->stock)) {
                        $product->decrement('stock', $qty);
                    }
                }

                // Update total_amount (decimal)
                $order->update(['total_amount' => $total]);

                // Bersihkan cart user
                Cart::where('user_id', $userId)->delete();

                return $order;
            });

        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        } catch (\Throwable $e) {
            report($e);
            return back()->with('error', 'Checkout gagal. Silakan coba lagi.');
        }

        return redirect()
            ->route('user.cart') // ← balik ke keranjang agar kamu lihat notifikasi & keranjang kosong
            ->with('success', 'Checkout berhasil! Pesanan dibuat dan keranjang dikosongkan.');
    }
}
