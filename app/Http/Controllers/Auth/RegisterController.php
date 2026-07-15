<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Menampilkan halaman form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Memproses data registrasi
    public function register(Request $request)
    {
        // 1. Validasi inputan
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:255|unique:users,nim', // NIM tidak boleh sama dengan yang sudah ada
            'password' => 'required|string|min:8|confirmed',     // Harus ada input password_confirmation
        ], [
            'nim.unique' => 'NIM ini sudah terdaftar. Silakan langsung login atau hubungi Admin.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        // 2. Simpan ke database (Otomatis role = mahasiswa)
        $user = User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa', 
        ]);

        // 3. Otomatis login setelah berhasil daftar
        Auth::login($user);

        // 4. Arahkan ke dashboard mahasiswa
        return redirect()->route('mahasiswa.dashboard')
            ->with('success', 'Akun berhasil dibuat! Selamat datang di sistem skrining.');
    }
}