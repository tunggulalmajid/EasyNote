<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cari user berdasarkan google_id ATAU email
            $user = User::where('google_id', $googleUser->getId())
                        ->orWhere('email', $googleUser->getEmail())
                        ->first();

            if ($user) {
                // Jika user lama (via email) login via google, sambungkan akunnya
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        // Jika mau foto otomatis terupdate dari google saat login pertama kali:
                        'foto_profil' => $user->foto_profil ?: $googleUser->getAvatar()
                    ]);
                }

                Auth::login($user);
                return redirect()->intended('dashboard');

            } else {
                // User baru, buat akun
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(16)), // Password acak
                    'foto_profil' => $googleUser->getAvatar(), // Simpan URL Google langsung
                ]);

                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Login Google Gagal. Silakan coba lagi.');
        }
    }
}
