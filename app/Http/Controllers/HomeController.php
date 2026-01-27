<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Detpesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Beranda',
            'produk' => Produk::where('stock_produk', '>', 0)->get()
        ];

        return view('main.home', $data);
    }

    public function home()
    {
        $data = [
            'title' => 'Beranda',
            'produk' => Produk::where('stock_produk', '>', 0)
                ->limit(8)
                ->get(),
            'produk_slider' => Produk::where('stock_produk', '>', 0)
                ->orderBy('created_at', 'desc')
                ->limit(12)
                ->get(),
            'totalCart' => $this->totalCart(),
        ];

        return view('main.home', $data);
    }


    public function about()
    {
        $data = [
            'title' => 'Tentang',
            'totalCart' => $this->totalCart(),
        ];
        return view('main.about', $data);
    }


    public function contact()
    {
        $data = [
            'title' => 'Hubungi Kami',
            'totalCart' => $this->totalCart(),
        ];
        return view('main.contact', $data);
    }


    public function profile(Request $request)
    {
        if ($request->isMethod('POST')) {
            User::where('id', auth()->user()->id)->update([
                'notelp' => $request->notelp,
                'alamat' => $request->alamat
            ]);

            return redirect()->route('profile')->with('success', 'Berhasil Update Profile');
        } else {
            $store = Store::where('user_id', auth()->user()->id)->first();
            $store = ($store) ? $store : null;
            $data = [
                'title' => 'Profil Saya',
                'user' => User::where('id', auth()->user()->id)->first(),
                'store' => $store,
                'totalCart' => $this->totalCart(),
            ];

            return view('user.profile', $data);
        }
    }

    public function update_password(Request $request)
    {
        if ($request->isMethod('POST')) {
            $post = $request->validate([
                'password' => 'required|min:6',
                'password2' => 'required|same:password',
            ], [
                'password.required' => 'Password Tidak Boleh Kosong',
                'password2.required' => 'Konfirmasi Password Tidak Boleh Kosong',
                'password.min' => 'Password Minimal 6 Karakter',
                'password2.same' => 'Konfirmasi Password Salah',
            ]);

            $post['password'] = Hash::make($post['password']);

            $user = User::find(auth()->user()->id);
            $user->password = $post['password'];
            $user->save();

            return redirect()->back()->with('success', 'Berhasil Update Password');
        }

        $data = [
            'title' => 'My Profile',
            'user' => User::where('id', auth()->user()->id)->first(),
            'totalCart' => $this->totalCart()
        ];

        return view('user.edit_password', $data);
    }

    private function totalCart()
    {
        if (Auth::check()) {
            $pesanan = Pesanan::where(['user_id' => auth()->user()->id, 'status' => 0])->first();
            if ($pesanan != null) {
                $total =  Detpesanan::where('pesanan_id', $pesanan->id)->groupBy('produk_id')->get();
                $total = $total->count();
            } else {
                $total = 0;
            }
        } else {
            $total = 0;
        }

        return $total;
    }
}
