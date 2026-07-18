<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Screening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScreeningController extends Controller
{
    /**
     * Menampilkan daftar riwayat skrining mahasiswa yang sedang login
     */
    public function index()
    {
        $screenings = Screening::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        $chartData = Screening::where('user_id', Auth::id())->orderBy('created_at', 'asc')->get();

        $labels = $chartData->pluck('created_at')->map(function ($date) {
            return $date->format('d M Y'); 
        });
        
        // Memisahkan data skor untuk grafik
        $dataDepresi = $chartData->pluck('score_depresi');
        $dataKecemasan = $chartData->pluck('score_kecemasan');
        $dataStres = $chartData->pluck('score_stres'); 

        return view('mahasiswa.screenings.index', compact('screenings', 'labels', 'dataDepresi', 'dataKecemasan', 'dataStres'));
    }
    
    public function create()
    {
        // Mengambil semua pertanyaan (pastikan berjumlah 42 berdasarkan seeder)
        $questions = Question::all();
        
        if ($questions->count() < 42) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('error', 'Master data pertanyaan belum lengkap. Silakan hubungi Administrator.');
        }

        return view('mahasiswa.screenings.create', compact('questions'));
    }

    /**
     * Menyimpan hasil skrining dan melakukan kalkulasi 3 Kategori DASS-42
     */
    public function store(Request $request)
    {
        // Validasi jawaban dari 42 soal
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer|min:0|max:3',
        ], [
            'answers.required' => 'Anda harus menjawab seluruh pertanyaan.',
            'answers.*.required' => 'Ada pertanyaan yang belum dijawab.',
        ]);

        $answers = $request->answers;
        // Pastikan mengambil soal urut berdasarkan ID agar nomor 1-42 presisi
        $questions = Question::orderBy('id', 'asc')->get(); 

        if (count($answers) !== $questions->count()) {
            return back()->with('error', 'Pastikan seluruh 42 pertanyaan telah dijawab dengan lengkap.');
        }

        // 1. Kelompok Nomor Soal Standar DASS-42
        $kelompokDepresi   = [3, 5, 10, 13, 16, 17, 21, 24, 26, 31, 34, 37, 38, 42];
        $kelompokKecemasan = [2, 4, 7, 9, 15, 19, 20, 23, 25, 28, 30, 36, 40, 41];
        $kelompokStres     = [1, 6, 8, 11, 12, 14, 18, 22, 27, 29, 32, 33, 35, 39];

        $score_depresi = 0;
        $score_kecemasan = 0;
        $score_stres = 0;
        $total_score = 0;

        // 2. Proses Pemisahan Nilai berdasarkan kategori
        foreach ($questions as $index => $question) {
            $nomorSoal = $index + 1; // Asumsi index 0 adalah soal no 1, dst.
            $nilaiJawaban = $answers[$question->id] ?? 0;

            if (in_array($nomorSoal, $kelompokDepresi)) {
                $score_depresi += $nilaiJawaban;
            } elseif (in_array($nomorSoal, $kelompokKecemasan)) {
                $score_kecemasan += $nilaiJawaban;
            } elseif (in_array($nomorSoal, $kelompokStres)) {
                $score_stres += $nilaiJawaban;
            }
            $total_score += $nilaiJawaban; // Tetap disimpan sebagai arsip
        }

        // 3. Tentukan Status berdasarkan Skala Masing-masing
        $status_depresi = $this->hitungStatusDepresi($score_depresi);
        $status_kecemasan = $this->hitungStatusKecemasan($score_kecemasan);
        $status_stres = $this->hitungStatusStres($score_stres);

        // 4. Simpan ke Database
        $screening = Screening::create([
            'user_id' => Auth::id(),
            'total_score' => $total_score,
            'status' => 'Selesai', // Diganti menjadi 'Selesai' karena status aslinya sudah dipecah 3
            'answers' => $answers,
            'score_depresi' => $score_depresi,
            'status_depresi' => $status_depresi,
            'score_kecemasan' => $score_kecemasan,
            'status_kecemasan' => $status_kecemasan,
            'score_stres' => $score_stres,
            'status_stres' => $status_stres,
        ]);

        return redirect()->route('mahasiswa.screenings.show', $screening->id)
            ->with('success', 'Skrining berhasil diselesaikan. Berikut adalah hasil pengukuran DASS Anda.');
    }

    public function show($id)
    {
        // Mengambil data skrining berdasarkan ID
        $screening = Screening::where('id', $id)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();

        // Mengambil master soal untuk dicocokkan dengan jawaban
        $questions = Question::all();

        return view('mahasiswa.screenings.show', compact('screening', 'questions'));
    }

    public function onboarding()
    {
        // Cukup kembalikan tampilan view onboarding
        return view('mahasiswa.screenings.onboarding');
    }

    // ==========================================
    // FUNGSI KLASIFIKASI DASS-42
    // ==========================================
    
    private function hitungStatusDepresi($score)
    {
        if ($score <= 9) return 'Normal';
        if ($score <= 13) return 'Ringan';
        if ($score <= 20) return 'Sedang';
        if ($score <= 27) return 'Parah';
        return 'Sangat Parah'; 
    }

    private function hitungStatusKecemasan($score)
    {
        if ($score <= 7) return 'Normal'; // Diperbarui menjadi <= 7 agar sesuai dengan UI tabel
        if ($score <= 9) return 'Ringan';
        if ($score <= 14) return 'Sedang';
        if ($score <= 19) return 'Parah';
        return 'Sangat Parah'; 
    }

    private function hitungStatusStres($score)
    {
        if ($score <= 14) return 'Normal';
        if ($score <= 18) return 'Ringan';
        if ($score <= 25) return 'Sedang';
        if ($score <= 33) return 'Parah';
        return 'Sangat Parah'; 
    }
}