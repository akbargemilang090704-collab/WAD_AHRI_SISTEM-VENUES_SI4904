<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Selalu ke dashboard sesuai role (bukan 'intended'), supaya user tidak
            // dilempar ke URL admin yang pernah diketik sebelum login.
            return redirect()->route($this->rutDashboard(Auth::user()))
                ->with('success', 'Selamat datang, ' . Auth::user()->nama . '!');
        }

        return back()->withInput($request->only('username'))
            ->with('error', 'Username atau password salah.');
    }

    private function rutDashboard($user): string
    {
        return $user->isAdmin() ? 'admin.dashboard' : 'user.dashboard';
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}
