<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ],[
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata Sandi wajib diisi.',
        ]);

        $key =$this->throttleKey($request);

       if (RateLimiter::tooManyAttempts($key,5)) {
        $detik = RateLimiter::availableIn($key);
        $pesan = "Terlalu banyak percobaan login. Silakan coba lagi dalam $detik detik.";

        return back()->with('error', $pesan)->onlyInput();
       }
       if (Auth::attempt($credentials,$request->boolean('remember'))) {
            RateLimiter::clear($key);
            $request->session()->regenerate();

            $pesan ='Login berhasil. Selamat datang, '.Auth::user()->name.'.';

            return redirect()->intended(route('dashboard'))->with('success', $pesan);
       }

       RateLimiter::hit($key, 60);

        return back()->with('error', 'Email atau Kata Sandi salah.')->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil Keluar.');
    }

    private function throttleKey(Request $request): string
    {
        return Str::transliterate(Str::lower((String)$request->input('email')).'|'.$request->ip());
    }
}
