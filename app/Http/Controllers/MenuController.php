<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Throwable;

class MenuController extends Controller
{
    // LIST MENU
    public function index()
    {
        try {
            $merchant = Auth::user()->merchant;

            if (!$merchant) {
                return redirect('/merchant/profile')
                    ->with('error', 'Lengkapi profil merchant terlebih dahulu');
            }

            $menus = $merchant->menus()->latest()->get();

            return view('merchant.menu.index', compact('menus'));
        } catch (Throwable $e) {
            return back()->withErrors([
                'error' => 'Gagal memuat menu'
            ]);
        }
    }

    // FORM TAMBAH
    public function create()
    {
        try {
            return view('merchant.menu.create');
        } catch (Throwable $e) {
            abort(500);
        }
    }

    // PROSES TAMBAH DAN SIMPAN MENU
    public function store(Request $request)
    {
        try {
            $merchant = Auth::user()->merchant;

            if (!$merchant) {
                return redirect('/merchant/profile')
                    ->with('error', 'Lengkapi profil merchant terlebih dahulu');
            }

            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required',
                'price' => 'required|integer|min:0',
                'photo' => 'nullable|image|max:2048',
            ]);

            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('menus', 'public');
            }

            $merchant->menus()->create($data);

            return redirect('/merchant/menus')
                ->with('success', 'Menu berhasil ditambahkan');
        } catch (Throwable $e) {
            return back()->withErrors([
                'error' => 'Gagal menambahkan menu'
            ]);
        }
    }

    // FORM EDIT
    public function edit(Menu $menu)
    {
        try {
            $this->authorizeMenu($menu);

            return view('merchant.menu.edit', compact('menu'));
        } catch (Throwable $e) {
            abort(403);
        }
    }

    // UPDATE MENU
    public function update(Request $request, Menu $menu)
    {
        try {
            $this->authorizeMenu($menu);

            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required',
                'price' => 'required|integer|min:0',
                'photo' => 'nullable|image|max:2048',
            ]);

            if ($request->hasFile('photo')) {
                if ($menu->photo) {
                    Storage::disk('public')->delete($menu->photo);
                }

                $data['photo'] = $request->file('photo')->store('menus', 'public');
            }

            $menu->update($data);

            return redirect('/merchant/menus')
                ->with('success', 'Menu berhasil diupdate');
        } catch (Throwable $e) {
            return back()->withErrors([
                'error' => 'Gagal mengupdate menu'
            ]);
        }
    }

    //delete 
    public function destroy(Menu $menu)
    {
        //hapus file foto jika ada 
        $merchant = Auth::user()->merchant;
        if ($menu->photo && Storage::disk('public')->exists($menu->photo)) {
            Storage::disk('public')->delete($menu->photo);
        }

        //hapus menu 
        $menu->delete();

        return redirect('/merchant')->with("success", "Delete Menu Berhasil");
    }

    // SECURITY CHECK
    private function authorizeMenu(Menu $menu)
    {
        if (
            !$menu->merchant ||
            $menu->merchant_id !== Auth::user()->merchant->id
        ) {
            abort(403, 'Akses ditolak');
        }
    }
}
