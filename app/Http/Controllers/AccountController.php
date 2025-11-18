<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    /**
     * Tampilkan form edit profile
     */
    public function editProfile()
    {
        $user = auth()->user();
        return view('account.edit-profile', compact('user'));
    }

    /**
     * Update profile
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('account.profile')->with('success', 'Profil berhasil diupdate');
    }

    /**
     * Tampilkan form change password
     */
    public function changePassword()
    {
        return view('account.change-password');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                Password::defaults(),
            ],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('account.profile')->with('success', 'Password berhasil diubah');
    }
}
