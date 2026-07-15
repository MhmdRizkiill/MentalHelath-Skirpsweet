<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        // Ubah 'category' menjadi 'id' agar urutannya terkunci dan stabil
        $questions = Question::orderBy('id', 'asc')->paginate(15);
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required|string',
            'category' => 'required|in:depression,anxiety,stress',
        ]);

        // 1. Ambil semua input dari form (baru berisi text & category)
        $data = $request->all();

        // 2. Buat kode otomatis berdasarkan urutan ID terakhir agar unik
        // Menggunakan id terakhir memastikan kodenya tidak akan pernah kembar
        $lastQuestion = \App\Models\Question::orderBy('id', 'desc')->first();
        $nextNumber = $lastQuestion ? ($lastQuestion->id + 1) : 1;
        
        $data['code'] = 'Q' . $nextNumber; // Menghasilkan "Q1", "Q2", dst.

        // 3. Simpan ke database
        Question::create($data);

        return redirect()->route('admin.questions.index')
            ->with('success', 'Pertanyaan berhasil ditambahkan dengan kode ' . $data['code']);
    }

    public function edit(Question $question)
    {
        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question_text' => 'required|string',
            'category' => 'required|in:depression,anxiety,stress',
        ]);

        $question->update($request->all());

        return redirect()->route('admin.questions.index')
            ->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('admin.questions.index')
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }
}