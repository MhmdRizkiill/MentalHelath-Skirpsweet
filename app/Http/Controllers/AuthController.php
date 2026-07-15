<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses autentikasi login
     */
    public function login(Request $request)
    {
        // Validasi input: nim diubah menjadi username
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.'
        ]);

        // Coba melakukan login (Laravel otomatis mengecek array credentials ini)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect berdasarkan role
            if(Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard')->with('success', 'Berhasil login sebagai Admin');
            }
            
            return redirect()->intended('/mahasiswa/dashboard')->with('success', 'Berhasil login sebagai Mahasiswa');
        }

        // Jika gagal
        return back()->withErrors([
            'username' => 'Username atau Password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    /**
     * Menampilkan halaman registrasi (Khusus Mahasiswa)
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses pendaftaran Mahasiswa baru
     */
    public function register(Request $request)
    {
        // Validasi input: name dihapus, nim diubah ke username
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username ini sudah terpakai. Silakan buat yang lain.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.'
        ]);

        // Buat user baru: name dihapus, nim diubah ke username
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa', // Default mendaftar sebagai mahasiswa
        ]);

        // Langsung login setelah sukses register
        Auth::login($user);

        return redirect('/mahasiswa/dashboard')->with('success', 'Registrasi berhasil, Selamat datang!');
    }

    /**
     * Proses Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Anda telah berhasil logout.');
    }
}