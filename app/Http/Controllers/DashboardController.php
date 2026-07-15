<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Screening;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Dashboard khusus Admin
     */
    public function admin()
    {
        // Tetap mencari role 'mahasiswa' yang kini berstatus anonim
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalScreening = Screening::count();
        $totalQuestion = Question::count();
        
        // Mengambil 5 data skrining terbaru beserta relasi usernya
        $recentScreenings = Screening::with('user')->latest()->take(5)->get();

        // 1. Menghitung data grafik untuk Depresi
        $chartDepresi = [
            Screening::where('status_depresi', 'Normal')->count(),
            Screening::where('status_depresi', 'Ringan')->count(),
            Screening::where('status_depresi', 'Sedang')->count(),
            Screening::where('status_depresi', 'Parah')->count(),
            Screening::where('status_depresi', 'Sangat Parah')->count(),
        ];

        // 2. Menghitung data grafik untuk Kecemasan
        $chartKecemasan = [
            Screening::where('status_kecemasan', 'Normal')->count(),
            Screening::where('status_kecemasan', 'Ringan')->count(),
            Screening::where('status_kecemasan', 'Sedang')->count(),
            Screening::where('status_kecemasan', 'Parah')->count(),
            Screening::where('status_kecemasan', 'Sangat Parah')->count(),
        ];

        // 3. Menghitung data grafik untuk Stres
        $chartStres = [
            Screening::where('status_stres', 'Normal')->count(),
            Screening::where('status_stres', 'Ringan')->count(),
            Screening::where('status_stres', 'Sedang')->count(),
            Screening::where('status_stres', 'Parah')->count(),
            Screening::where('status_stres', 'Sangat Parah')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalMahasiswa', 
            'totalScreening', 
            'totalQuestion', 
            'recentScreenings',
            'chartDepresi',
            'chartKecemasan',
            'chartStres'
        ));
    }

    /**
     * Dashboard khusus Pengguna Anonim (Mahasiswa)
     */
    public function mahasiswa()
    {
        // Ambil data skrining milik user (anonim) yang sedang login
        $screenings = Screening::where('user_id', Auth::id())
                        ->orderBy('created_at', 'asc')
                        ->get();

        // 1. Hitung total skrining yang pernah dilakukan
        $totalScreening = $screenings->count();

        // 2. Ambil data skrining terakhir
        $latestScreening = $screenings->last();

        // 3. Proses data tanggal untuk grafik Chart.js
        $labels = $screenings->pluck('created_at')->map(function ($date) {
            return $date->format('d M Y');
        });
        
        // 4. Pisahkan ketiga data skor DASS-42
        $dataDepresi = $screenings->pluck('score_depresi');
        $dataKecemasan = $screenings->pluck('score_kecemasan');
        $dataStres = $screenings->pluck('score_stres');

        // Kirim semua variabel ke view dashboard
        return view('mahasiswa.dashboard', compact(
            'labels', 
            'dataDepresi', 
            'dataKecemasan', 
            'dataStres', 
            'totalScreening', 
            'latestScreening'
        )); 
    }
}