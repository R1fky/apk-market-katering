<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerchantProfileController extends Controller
{
    // profile merchant
    public function getProfile()
    {
        $profile = Auth::user()->merchant;

        return view('merchant.profile', compact('profile'));
    }

    //form edit atau buat merchant
    public function edit()
    {
        $profile = Auth::user()->merchant;

        return view('merchant.editProfile', compact('profile'));
    }


    //simpan update atau buat
    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'address' => 'required',
            'phone' => 'required|string|max:20',
            'description' => 'nullable',
        ]);

        Merchant::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'company_name' => $request->company_name,
                'address' => $request->address,
                'phone' => $request->phone,
                'description' => $request->description,
            ]
        );

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}
