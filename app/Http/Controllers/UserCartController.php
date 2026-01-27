<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pesanan;
use App\Models\Detpesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class UserCartController extends Controller
{
    public function index()
    {
        // Get all regular users (role = 3)
        $users = User::where('role', 3)
                    ->orderBy('id')
                    ->get();

        $userCarts = [];

        foreach ($users as $user) {
            // Get user's active cart (status = 0)
            $pesanan = Pesanan::where('user_id', $user->id)
                            ->where('status', 0)
                            ->first();

            $cartData = [
                'user' => $user,
                'pesanan' => $pesanan,
                'items' => [],
                'total_items' => 0,
                'total_quantity' => 0,
                'total_value' => 0
            ];

            if ($pesanan) {
                // Get cart items
                $items = Detpesanan::where('pesanan_id', $pesanan->id)->get();
                
                foreach ($items as $item) {
                    $product = Produk::find($item->produk_id);
                    $cartData['items'][] = [
                        'detpesanan' => $item,
                        'product' => $product
                    ];
                    $cartData['total_quantity'] += $item->qty;
                    $cartData['total_value'] += $item->subtotal;
                }
                $cartData['total_items'] = count($items);
            }

            $userCarts[] = $cartData;
        }

        $data = [
            'title' => 'Daftar User dan Keranjang Belanja',
            'userCarts' => $userCarts,
            'totalUsers' => count($users),
            'totalCarts' => Pesanan::where('status', 0)->count(),
            'totalCartItems' => Detpesanan::count(),
        ];

        return view('admin.user_carts', $data);
    }
}
