@extends('layouts.app')

@section('content')

<style>
    /* ===========================
       VARIABEL TEMA & WARNA 
       (Default: MODE TERANG)
    =========================== */Karena Anda memberikan kode tampilan (view) untuk halaman *Onboarding/Welcome* dan meminta untuk "melakukan hal yang sama" tanpa konteks sebelumnya, saya berasumsi Anda ingin dibuatkan **Halaman Form Kuesioner (Skrining)** (`create.blade.php`) dengan **gaya desain (UI/UX) yang sama** (glassmorphism, nuansa *sage green*, dan tata letak kartu yang rapi).

Berikut adalah desain untuk halaman pengisian kuesioner DASS-42 yang menggunakan elemen visual senada dengan halaman *onboarding* Anda:

```html
@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        CUSTOM STYLE SCREENING FORM
    =========================== */
    .screening-card {
        border: 1px solid rgba(255, 255, 255, 0.9);
        border-radius: var(--radius-lg, 24px);
        background: var(--card-bg, rgba(255, 255, 255, 0.88));
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 15px 40px -10px rgba(74, 122, 109, 0.1);
        overflow: hidden;
    }

    .form-header {
        background: linear-gradient(135deg, rgba(74, 122, 109, 0.06) 0%, rgba(107, 144, 128, 0.12) 100%);
        padding: 40px 30px;
        text-align: center;
        border-bottom: 1px solid var(--border);
    }

    .progress-container {
        width: 100%;
        background-color: rgba(74, 122, 109, 0.15);
        border-radius: 10px;
        margin-top: 20px;
        height: 8px;
        overflow: hidden;
    }

    .progress-bar-custom {
        height: 100%;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        border-radius: 10px;
        transition: width 0.4s ease;
    }

    .question-box {
        padding: 24px;
        background: rgba(255, 255, 255, 0.6);
        border-radius: var(--radius-md, 16px);
        border: 1px solid var(--border);
        margin-bottom: 24px;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .question-box:hover {
        background: #FFFFFF;
        box-shadow: 0 8px 25px rgba(74, 122, 109, 0.08);
        border-color: var(--accent);
    }

    .question-number {
        display: inline-block;
        background: var(--primary);
        color: #fff;
        width: 32px;
        height: 32px;
        line-height: 32px;
        text-align: center;
        border-radius: 50%;
        font-weight: bold;
        margin-right: 12px;
        font-size: 14px;
    }

    /* Custom Radio Buttons */
    .radio-group {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 16px;
    }

    .radio-option {
        position: relative;
        display: flex;
        align-items: center;
        padding: 12px 16px;
        border: 1px solid var(--border);
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #fff;
    }

    .radio-option:hover {
        border-color: var(--primary);
        background: rgba(74, 122, 109, 0.03);
    }

    .radio-option input[type="radio"] {
        display: none;
    }

    .radio-option span {
        margin-left: 12px;
        color: var(--text);
        font-size: 15px;
    }

    .radio-option input[type="radio"]:checked + .radio-circle {
        border-color: var(--primary);
    }

    .radio-option input[type="radio"]:checked + .radio-circle::after {
        transform: scale(1);
    }

    .radio-option input[type="radio"]:checked ~ span {
        font-weight: 600;
        color: var(--primary);
    }

    .radio-circle {
        width: 20px;
        height: 20px;
        border: 2px solid #ccc;
        border-radius: 50%;
        position: relative;
        transition: border-color 0.2s ease;
    }

    .radio-circle::after {
        content: '';
        width: 10px;
        height: 10px;
        background: var(--primary);
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .btn-submit {
        height: 56px;
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 0.5px;
        border-radius: var(--radius-md, 16px);
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        border: none;
        box-shadow: 0 8px 20px rgba(74, 122, 109, 0.22);
        transition: all 0.3s ease;
        color: #FFFFFF !important;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(74, 122, 109, 0.32);
        background: linear-gradient(135deg, var(--primary-hover) 0%, var(--primary) 100%);
    }
</style>

<div class="row justify-content-center mb-5">
    <div class="col-lg-10 col-xl-8">
        <div class="card screening-card">
            
            <!-- Header & Progress -->
            <div class="form-header">
                <h3 class="fw-bold mb-2" style="color: var(--text);">Skrining DASS-42</h3>
                <p class="mb-0 mx-auto" style="color: var(--muted); max-width: 500px; font-size: 15px;">
                    Pilih jawaban yang paling sesuai dengan kondisi Anda selama satu minggu terakhir.
                </p>
                
                <!-- Progress Bar (Bisa diatur dinamis dengan JS nanti) -->
                <div class="mt-4">
                    <div class="d-flex justify-content-between mb-1" style="font-size: 13px; color: var(--muted);">
                        <span>Progres Pengisian</span>
                        <span class="fw-bold" style="color: var(--primary);">0%</span>
                    </div>
                    <div class="progress-container">
                        <div class="progress-bar-custom" style="width: 5%;"></div>
                    </div>
                </div>
            </div>

            <div class="card-body p-4 p-md-5">
                
                <form action="{{ route('mahasiswa.screenings.store') }}" method="POST">
                    @csrf

                    <!-- Contoh Looping Pertanyaan -->
                    @php
                        // Array contoh untuk demonstrasi visual
                        $questions = [
                            'Saya merasa bahwa saya menjadi marah karena hal-hal sepele.',
                            'Saya merasa bibir saya sering kering.',
                            'Saya sama sekali tidak dapat merasakan perasaan positif.'
                        ];
                    @endphp

                    @foreach($questions as $index => $question)
                        <div class="question-box">
                            <h6 class="fw-bold mb-3 d-flex align-items-center" style="color: var(--text); line-height: 1.5;">
                                <span class="question-number">{{ $index + 1 }}</span>
                                {{ $question }}
                            </h6>
                            
                            <div class="radio-group">
                                <label class="radio-option">
                                    <input type="radio" name="answers[{{ $index + 1 }}]" value="0" required>
                                    <div class="radio-circle"></div>
                                    <span>Tidak pernah (Tidak sesuai dengan saya)</span>
                                </label>
                                
                                <label class="radio-option">
                                    <input type="radio" name="answers[{{ $index + 1 }}]" value="1" required>
                                    <div class="radio-circle"></div>
                                    <span>Kadang-kadang (Sesuai dengan saya sampai tingkat tertentu)</span>
                                </label>
                                
                                <label class="radio-option">
                                    <input type="radio" name="answers[{{ $index + 1 }}]" value="2" required>
                                    <div class="radio-circle"></div>
                                    <span>Sering (Sesuai dengan saya sampai tingkat yang dapat dipertimbangkan)</span>
                                </label>

                                <label class="radio-option">
                                    <input type="radio" name="answers[{{ $index + 1 }}]" value="3" required>
                                    <div class="radio-circle"></div>
                                    <span>Hampir selalu (Sangat sesuai dengan saya)</span>
                                </label>
                            </div>
                        </div>
                    @endforeach

                    <!-- Tombol Submit -->
                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-submit w-100 w-md-auto px-5">
                            Kirim Jawaban <i class="bi bi-check2-circle ms-2"></i>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection