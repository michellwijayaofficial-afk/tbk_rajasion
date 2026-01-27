<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'totalStore' => Store::count(),
            'totalCustomer' => User::where('role', 3)->count(),
            'totalProduk' => Produk::count(),
            'totalPesanan' => Pesanan::where('status', '!=', 0)->count()
        ];
        return view('admin.dashboard', $data);
    }

    public function produk()
    {
        $data = [
            'title' => 'Data Produk',
            'produk' => Produk::get()
        ];

        return view('admin.produk', $data);
    }

    public function produk_create()
    {
        $data = [
            'title' => 'Tambah Produk'
        ];

        return view('admin.produk_create', $data);
    }

    public function produk_store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric|min:0',
            'stock_produk' => 'required|integer|min:0',
            'deskripsi_produk' => 'nullable|string',
            'foto_produk' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048'
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi',
            'harga_produk.required' => 'Harga produk wajib diisi',
            'harga_produk.numeric' => 'Harga produk harus berupa angka',
            'stock_produk.required' => 'Stock produk wajib diisi',
            'stock_produk.integer' => 'Stock produk harus berupa angka',
            'stock_produk.min' => 'Stock produk tidak boleh negatif',
            'foto_produk.image' => 'File harus berupa gambar',
            'foto_produk.mimes' => 'Format gambar harus: jpeg, jpg, png, gif',
            'foto_produk.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        // Handle image upload
        if ($request->hasFile('foto_produk')) {
            $image = $request->file('foto_produk');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage'), $imageName);
            $validated['foto_produk'] = $imageName;
        }

        Produk::create($validated);

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil ditambahkan');
    }

    public function produk_edit(Produk $produk)
    {
        $data = [
            'title' => 'Edit Produk',
            'produk' => $produk
        ];

        return view('admin.produk_edit', $data);
    }

    public function produk_update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric|min:0',
            'stock_produk' => 'required|integer|min:0',
            'deskripsi_produk' => 'nullable|string',
            'foto_produk' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048'
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi',
            'harga_produk.required' => 'Harga produk wajib diisi',
            'harga_produk.numeric' => 'Harga produk harus berupa angka',
            'stock_produk.required' => 'Stock produk wajib diisi',
            'stock_produk.integer' => 'Stock produk harus berupa angka',
            'stock_produk.min' => 'Stock produk tidak boleh negatif',
            'foto_produk.image' => 'File harus berupa gambar',
            'foto_produk.mimes' => 'Format gambar harus: jpeg, jpg, png, gif',
            'foto_produk.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        // Handle image upload
        if ($request->hasFile('foto_produk')) {
            // Delete old image if exists
            if ($produk->foto_produk) {
                $oldImagePath = public_path('storage/' . $produk->foto_produk);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $image = $request->file('foto_produk');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage'), $imageName);
            $validated['foto_produk'] = $imageName;
        }

        $produk->update($validated);

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil diperbarui');
    }

    public function produk_destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil dihapus');
    }

    public function customer()
    {
        $data = [
            'title' => 'Data Customer',
            'customer' => User::where('role', 3)->orderbyDesc('created_at')->get(),
        ];

        return view('user.customer', $data);
    }

    public function admin()
    {
        $data = [
            'title' => 'Data Administrator',
            'admin' => User::where('role', 1)->where('id', '!=', auth()->user()->id)->where('username', '!=', 'admin')->orderbyDesc('created_at')->get(),
        ];

        return view('user.admin', $data);
    }

    public function tambah_admin(Request $request)
    {

        if ($request->isMethod('POST')) {
            $dataValid = $request->validate([
                'username' => 'required|unique:users,username',
                'notelp' => 'required|numeric|min:10',
                'email' => 'required|unique:users,email|email:rfc,dns',
                'password' => 'required|min:6',
            ], [
                'username.required' => 'Username Tidak Boleh Kosong',
                'notelp.required' => 'No.Telp Tidak Boleh Kosong',
                'email.required' => 'Email Tidak Boleh Kosong',
                'notelp.numeric' => 'No.Telp Tidak Valid',
                'notelp.min' => 'No.Telp Tidak Valid',
                'password.required' => 'Password Tidak Boleh Kosong',
                'username.unique' => 'Username Sudah Digunakan',
                'email.unique' => 'Email Sudah Digunakan',
                'email.email' => 'Email Tidak Valid',
            ]);


            User::create([
                'username' => $dataValid['username'],
                'notelp' => $dataValid['notelp'],
                'email' => $dataValid['email'],
                'role' => 1,
                'password' => Hash::make($dataValid['password'])
            ]);

            return redirect('/admin/user/admin')->with('success', 'Berhasil Tambah Data Admin');
        }

        $data['title'] = 'Tambah Data Administrator';
        return view('user.tambah_admin', $data);
    }

    public function delete_user(User $user)
    {
        $store = Store::where('user_id', $user->id)->first();
        if ($store) {
            $user = User::find($user->id);
            $user->role = 3;
            $user->save();
            Store::destroy($store->id);
        } else {
            User::destroy($user->id);
        }

        return redirect()->back()->with('success', 'Berhasil Hapus Data User');
    }

    public function profile(Request $request)
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
            'title' => 'Profile Admin',
            'user' => User::where('id', auth()->user()->id)->first()
        ];

        return view('admin.profile', $data);
    }
}
