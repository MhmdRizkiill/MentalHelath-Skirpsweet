@extends('layouts.app')

@section('content')
<style>
    /* ===========================
       VARIABEL TEMA KUESIONER 
       (Default: MODE TERANG)
    =========================== */
    :root {
        --sage-primary: #4A7A6D;
        --sage-hover: #3b6358;
        --sage-light: #e8f0ec;
        --sage-surface: #f4f7f6;
        --card-bg: #ffffff;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --border-soft: rgba(74, 122, 109, 0.18);
        --sticky-bg: rgba(255, 255, 255, 0.92);
        --radio-bg: #ffffff;
        --danger-color: #e53e3e;
        --success-color: #22c55e;
        --radius-lg: 24px;
        --radius-md: 16px;
    }

    /* MODE GELAP (DARK MODE) */
    html.dark, body.dark, body.dark-mode, [data-theme="dark"], [data-bs-theme="dark"] {
        --sage-hover: #5b9686;
        --sage-light: rgba(74, 122, 109, 0.2);
        --sage-surface: #1e293b;
        --card-bg: #151e2b;
        --text-dark: #f8fafc;
        --text-muted: #94a3b8;
        --border-soft: rgba(255, 255, 255, 0.1);
        --sticky-bg: rgba(21, 30, 43, 0.92);
        --radio-bg: #1e293b;
    }

    /* ===========================
       KARTU & HEADER KUESIONER
    =========================== */
    .questionnaire-card {
        border: 1px solid var(--border-soft);
        border-radius: var(--radius-lg);
        background: var(--card-bg);
        box-shadow: 0 12px 35px rgba(74, 122, 109, 0.06);
        position: relative;
        overflow: hidden;
    }

    .questionnaire-header {
        background: linear-gradient(135deg, var(--sage-primary) 0%, var(--sage-hover) 100%);
        padding: 32px 20px;
        text-align: center;
        color: #ffffff;
        border-top-left-radius: var(--radius-lg);
        border-top-right-radius: var(--radius-lg);
        box-shadow: 0 4px 15px rgba(74, 122, 109, 0.15);
    }

    .info-panel {
        background: var(--sage-surface);
        border: 1px solid var(--border-soft);
        border-radius: var(--radius-md);
        padding: 20px 24px;
        color: var(--text-dark);
    }

    /* ===========================
       PROGRESS BAR STICKY
    =========================== */
    .progress-container {
        position: -webkit-sticky;
        position: sticky;
        top: 85px;
        z-index: 1020;
        background: var(--sticky-bg);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        padding: 16px 20px;
        border-radius: var(--radius-md);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid var(--border-soft);
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .custom-progress-bar {
        background: linear-gradient(90deg, #6bb29e 0%, var(--sage-primary) 100%);
        border-radius: 10px;
        transition: width 0.4s ease;
    }

    .custom-progress-bar.completed {
        background: linear-gradient(90deg, var(--sage-primary) 0%, var(--success-color) 100%);
        box-shadow: 0 0 10px rgba(34, 197, 94, 0.4);
    }

    /* ===========================
       STYLE PERTANYAAN
    =========================== */
    .question-block {
        padding: 24px 16px;
        border-bottom: 1px dashed var(--border-soft);
        border-radius: 12px;
        transition: all 0.25s ease;
    }

    .question-block:last-child {
        border-bottom: none;
    }

    .question-block:hover {
        background: var(--sage-surface);
    }

    .question-text {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
        line-height: 1.6;
        margin-bottom: 16px;
    }

    /* Highlight Error (Pertanyaan Belum Diisi) */
    .question-block.has-error {
        background-color: rgba(229, 62, 62, 0.06) !important;
        border: 1px solid rgba(229, 62, 62, 0.3) !important;
    }

    .error-text {
        display: none;
        color: var(--danger-color);
        font-size: 13px;
        font-weight: 600;
        margin-top: 12px;
    }

    .question-block.has-error .error-text {
        display: flex;
        align-items: center;
    }

    /* ===========================
       RADIO PILLS (PILIHAN JAWABAN)
    =========================== */
    .options-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }

    .custom-radio {
        position: relative;
        width: 100%;
        margin: 0;
    }

    .custom-radio .form-check-input {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 2;
        margin: 0;
    }

    .custom-radio .form-check-label {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        width: 100%;
        height: 100%;
        padding: 12px 14px;
        background: var(--radio-bg);
        border: 1.5px solid var(--border-soft);
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        color: var(--text-muted);
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
        z-index: 1;
    }

    .custom-radio:hover .form-check-label {
        border-color: var(--sage-primary);
        background: var(--sage-light);
        color: var(--text-dark);
    }

    .custom-radio .form-check-input:checked + .form-check-label {
        background: var(--sage-primary);
        border-color: var(--sage-primary);
        color: #ffffff;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(74, 122, 109, 0.25);
        transform: translateY(-2px);
    }

    .custom-radio .form-check-input:focus-visible + .form-check-label {
        box-shadow: 0 0 0 3px rgba(74, 122, 109, 0.3);
        outline: none;
    }

    /* ===========================
       TOMBOL SUBMIT
    =========================== */
    .btn-submit-test {
        height: 54px;
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 0.5px;
        border-radius: var(--radius-md);
        background: var(--sage-primary);
        border: none;
        box-shadow: 0 8px 20px rgba(74, 122, 109, 0.25);
        transition: all 0.3s ease;
        color: #ffffff !important;
    }

    .btn-submit-test:hover {
        background: var(--sage-hover);
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(74, 122, 109, 0.35);
    }

    /* RESPONSIVE DESIGN */
    @media (max-width: 768px) {
        .options-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .question-block {
            padding: 20px 10px;
        }
        .info-panel {
            padding: 16px;
        }
    }

    @media (max-width: 480px) {
        .options-grid {
            grid-template-columns: 1fr;
        }
        .custom-radio .form-check-label {
            justify-content: flex-start;
            padding: 14px 16px;
        }
    }
</style>

<div class="row justify-content-center mb-5 pt-3">
    <div class="col-lg-10 col-xl-9">
        <div class="card questionnaire-card">
            <!-- HEADER -->
            <div class="questionnaire-header">
                <i class="bi bi-clipboard-pulse fs-1 mb-2 d-block opacity-75"></i>
                <h3 class="mb-1 fw-bold">Kuesioner DASS-42</h3>
                <p class="mb-0 opacity-75" style="font-size: 14.5px;">Pemantauan Berkala Kesehatan Mental Anda</p>
            </div>

            <!-- BODY -->
            <div class="card-body p-4 p-md-5">
                <!-- PETUNJUK PENGISIAN -->
                <div class="info-panel mb-4">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-info-circle-fill fs-5 me-2 text-sage"></i>
                        <h5 class="mb-0 fw-bold" style="color: var(--text-dark);">Petunjuk Pengisian</h5>
                    </div>
                    <p class="mb-0" style="font-size: 14.5px; color: var(--text-muted);">
                        Bacalah setiap pernyataan dan pilih jawaban yang paling menggambarkan keadaan Anda selama 
                        <strong class="text-sage">SATU MINGGU TERAKHIR</strong>. 
                        <em>Tidak ada jawaban yang benar atau salah, jawablah secara jujur.</em>
                    </p>
                </div>

                <!-- PROGRESS BAR STICKY -->
                <div class="progress-container">
                    <div class="d-flex justify-content-between align-items-end mb-2">
                        <span class="fw-bold" style="font-size: 14px; color: var(--text-dark);">Progres Pengisian</span>
                        <span class="fw-bold" id="progress-text" style="font-size: 14px; color: var(--sage-primary);">
                            0 / {{ count($questions) }} Terjawab
                        </span>
                    </div>
                    <div class="progress" style="height: 10px; border-radius: 10px; background-color: var(--sage-surface);">
                        <div class="progress-bar custom-progress-bar" id="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <!-- FORM KUESIONER -->
                <form id="form-skrining" action="{{ route('mahasiswa.screenings.store') }}" method="POST" novalidate>
                    @csrf

                    @foreach($questions as $index => $q)
                        <div class="question-block" id="block_{{ $q->id }}">
                            <p class="question-text">
                                <span class="me-1 text-sage">{{ $index + 1 }}.</span> {{ $q->question_text }}
                            </p>

                            <div class="options-grid">
                                <div class="custom-radio">
                                    <input class="form-check-input" type="radio" name="answers[{{ $q->id }}]" id="q_{{ $q->id }}_0" value="0">
                                    <label class="form-check-label" for="q_{{ $q->id }}_0">Tidak Pernah</label>
                                </div>
                                <div class="custom-radio">
                                    <input class="form-check-input" type="radio" name="answers[{{ $q->id }}]" id="q_{{ $q->id }}_1" value="1">
                                    <label class="form-check-label" for="q_{{ $q->id }}_1">Kadang-kadang</label>
                                </div>
                                <div class="custom-radio">
                                    <input class="form-check-input" type="radio" name="answers[{{ $q->id }}]" id="q_{{ $q->id }}_2" value="2">
                                    <label class="form-check-label" for="q_{{ $q->id }}_2">Sering</label>
                                </div>
                                <div class="custom-radio">
                                    <input class="form-check-input" type="radio" name="answers[{{ $q->id }}]" id="q_{{ $q->id }}_3" value="3">
                                    <label class="form-check-label" for="q_{{ $q->id }}_3">Hampir Selalu</label>
                                </div>
                            </div>

                            <div class="error-text">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i> Pertanyaan ini wajib diisi.
                            </div>
                        </div>
                    @endforeach

                    <div class="d-grid mt-5 pt-3">
                        <button type="submit" id="btnSubmit" class="btn btn-submit-test">
                            <i class="bi bi-send-check-fill me-2"></i> Kirim Jawaban
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let isFormDirty = false;
    const formSkrining = document.getElementById('form-skrining');
    const btnSubmit = document.getElementById('btnSubmit');
    const formInputs = document.querySelectorAll('#form-skrining input[type="radio"]');

    const totalQuestions = document.querySelectorAll('.question-block').length;
    const progressBar = document.getElementById('progress-bar');
    const progressText = document.getElementById('progress-text');

    // =====================================================
    // UPDATE PROGRESS BAR
    // =====================================================
    function updateProgress() {
        const answeredQuestions = document.querySelectorAll('.question-block input[type="radio"]:checked').length;
        const percentage = totalQuestions > 0 ? (answeredQuestions / totalQuestions) * 100 : 0;

        if (progressBar) {
            progressBar.style.width = percentage + '%';

            if (percentage === 100) {
                progressBar.classList.add('completed');
                if (progressText) progressText.style.color = 'var(--success-color)';
            } else {
                progressBar.classList.remove('completed');
                if (progressText) progressText.style.color = 'var(--sage-primary)';
            }
        }

        if (progressText) {
            progressText.innerText = `${answeredQuestions} / ${totalQuestions} Terjawab`;
        }
    }

    updateProgress();

    // =====================================================
    // EVENT LISTENER RADIO BUTTON
    // =====================================================
    formInputs.forEach(input => {
        input.addEventListener('change', function () {
            isFormDirty = true;

            const questionBlock = this.closest('.question-block');
            if (questionBlock) {
                questionBlock.classList.remove('has-error');
            }

            updateProgress();
        });
    });

    // =====================================================
    // CEGAH KELUAR HALAMAN TIDAK SENGAJA
    // =====================================================
    window.addEventListener('beforeunload', function (e) {
        if (isFormDirty) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    // =====================================================
    // VALIDASI & SUBMIT SWEETALERT
    // =====================================================
    if (formSkrining) {
        formSkrining.addEventListener('submit', function (e) {
            e.preventDefault();

            let isValid = true;
            let firstErrorBlock = null;
            let emptyCount = 0;

            const questionBlocks = document.querySelectorAll('.question-block');

            questionBlocks.forEach(block => {
                const isChecked = block.querySelector('input[type="radio"]:checked');

                if (!isChecked) {
                    isValid = false;
                    emptyCount++;
                    block.classList.add('has-error');

                    if (!firstErrorBlock) {
                        firstErrorBlock = block;
                    }
                } else {
                    block.classList.remove('has-error');
                }
            });

            // JIKA ADA PERTANYAAN BELUM DIISI
            if (!isValid) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Belum Selesai',
                    text: `Terdapat ${emptyCount} pertanyaan yang belum Anda jawab. Silakan periksa kembali bagian yang ditandai merah.`,
                    confirmButtonColor: '#4A7A6D',
                    confirmButtonText: 'Baik, Saya Periksa',
                    customClass: { popup: 'rounded-4' }
                }).then(() => {
                    if (firstErrorBlock) {
                        setTimeout(() => {
                            const y = firstErrorBlock.getBoundingClientRect().top + window.scrollY - 160;
                            window.scrollTo({
                                top: y,
                                behavior: 'smooth'
                            });
                        }, 250);
                    }
                });

                return;
            }

            // JIKA SEMUA SUDAH TERISI
            Swal.fire({
                title: 'Sudah Yakin?',
                text: 'Pastikan semua pertanyaan telah dijawab sesuai dengan apa yang Anda rasakan.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4A7A6D',
                cancelButtonColor: '#e53e3e',
                confirmButtonText: '<i class="bi bi-send-check me-1"></i> Ya, Kirim Sekarang',
                cancelButtonText: 'Cek Kembali',
                reverseButtons: true,
                customClass: { popup: 'rounded-4' }
            }).then((result) => {
                if (result.isConfirmed) {
                    isFormDirty = false;

                    if (btnSubmit) {
                        btnSubmit.disabled = true;
                        btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Menyimpan...';
                    }

                    formSkrining.submit();
                }
            });
        });
    }
});
</script>
@endpush