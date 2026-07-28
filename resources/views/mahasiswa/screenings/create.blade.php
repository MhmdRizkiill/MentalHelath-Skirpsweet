@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        CUSTOM STYLE KUESIONER
    =========================== */
    .questionnaire-card {
        border: 1px solid rgba(255, 255, 255, 0.9);
        border-radius: var(--radius-lg, 24px);
        background: var(--card-bg, rgba(255, 255, 255, 0.88));
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 10px 40px -10px rgba(74, 122, 109, 0.08);
        position: relative;
    }

    .questionnaire-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        padding: 30px 20px;
        text-align: center;
        color: white;
        border-top-left-radius: var(--radius-lg, 24px);
        border-top-right-radius: var(--radius-lg, 24px);
        box-shadow: 0 4px 15px rgba(74, 122, 109, 0.15);
    }

    .info-panel {
        background: rgba(107, 144, 128, 0.08); /* Soft sage transparent */
        border: 1px solid rgba(107, 144, 128, 0.2);
        border-radius: var(--radius-md, 16px);
        padding: 24px;
        color: var(--primary-hover);
    }
    
    .info-panel ul {
        margin-top: 12px;
        padding-left: 20px;
    }

    .info-panel li {
        margin-bottom: 6px;
        font-size: 14.5px;
    }

    /* Progress Bar Sticky */
    .progress-container {
        position: -webkit-sticky; /* Support untuk browser Safari */
        position: sticky;
        top: 90px; /* Jarak aman dari navbar atas */
        z-index: 1020; /* Nilai tinggi agar selalu di depan */
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        padding: 16px 20px;
        border-radius: var(--radius-md, 16px);
        box-shadow: 0 4px 20px rgba(74, 122, 109, 0.1);
        border: 1px solid var(--border);
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .custom-progress-bar {
        background: linear-gradient(90deg, var(--secondary) 0%, var(--primary) 100%);
        border-radius: 10px;
        transition: width 0.4s ease, background 0.4s ease;
    }

    .custom-progress-bar.completed {
        background: linear-gradient(90deg, var(--primary) 0%, var(--success) 100%);
        box-shadow: 0 0 10px rgba(56, 161, 105, 0.4);
    }

    /* Style untuk Pertanyaan */
    .question-block {
        padding: 24px 0;
        border-bottom: 1px dashed var(--border);
        transition: all 0.3s ease;
    }

    .question-block:last-child {
        border-bottom: none;
    }

    .question-block:hover {
        background: rgba(244, 247, 246, 0.6);
        border-radius: 12px;
        padding: 24px 16px;
        margin: 0 -16px;
    }

    .question-text {
        font-size: 16px;
        font-weight: 600;
        color: var(--text);
        line-height: 1.6;
        margin-bottom: 16px;
    }

    /* Highlight Error jika belum diisi (Soft Coral) */
    .question-block.has-error {
        background-color: rgba(229, 62, 62, 0.05) !important;
        border: 1px solid rgba(229, 62, 62, 0.2) !important;
        border-radius: 12px;
        padding: 24px 16px;
        margin: 0 -16px;
    }

    .error-text {
        display: none;
        color: var(--danger);
        font-size: 13px;
        font-weight: 600;
        margin-top: 10px;
    }

    .question-block.has-error .error-text {
        display: block;
    }

    /* Transformasi Radio Button Menjadi Kotak (Pills) */
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
        background: rgba(255, 255, 255, 0.9);
        border: 1.5px solid var(--border);
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        color: var(--muted);
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        z-index: 1;
    }

    .custom-radio:hover .form-check-label {
        border-color: var(--accent);
        background: rgba(74, 122, 109, 0.04);
        color: var(--text);
    }

    .custom-radio .form-check-input:checked + .form-check-label {
        background: rgba(74, 122, 109, 0.12); /* Soft sage background */
        border-color: var(--primary);
        color: var(--primary-hover);
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(74, 122, 109, 0.15);
        transform: translateY(-2px);
    }

    .custom-radio .form-check-input:focus-visible + .form-check-label {
        box-shadow: 0 0 0 3px rgba(107, 144, 128, 0.3);
        outline: none;
    }

    .btn-submit-test {
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

    .btn-submit-test:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(74, 122, 109, 0.32);
        background: linear-gradient(135deg, var(--primary-hover) 0%, var(--primary) 100%);
    }

    @media(max-width: 768px) {
        .options-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .question-block {
            padding: 20px 0;
        }
        .info-panel {
            padding: 16px;
        }
    }
    
    @media(max-width: 480px) {
        .options-grid {
            grid-template-columns: 1fr;
        }
        .custom-radio .form-check-label {
            justify-content: flex-start;
            padding: 14px 16px;
        }
    }
</style>

<div class="row justify-content-center mb-5">
    <div class="col-lg-10 col-xl-9">
        <div class="card questionnaire-card">
            <div class="questionnaire-header">
                <i class="bi bi-clipboard-pulse fs-1 mb-2 d-block opacity-75"></i>
                <h3 class="mb-1 fw-bold">Kuesioner DASS-42</h3>
                <p class="mb-0 opacity-75" style="font-size: 14px;">Pemantauan Berkala Kesehatan Mental Anda</p>
            </div>
            
            <div class="card-body p-4 p-md-5">
                
                <div class="info-panel mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-info-circle-fill fs-4 me-2"></i>
                        <h5 class="mb-0 fw-bold">Petunjuk Pengisian</h5>
                    </div>
                    <p class="mb-0">Bacalah setiap pernyataan dan pilih jawaban yang paling menggambarkan keadaan Anda selama <strong style="color: var(--primary-hover);">SATU MINGGU TERAKHIR</strong>. <em>Tidak ada jawaban yang benar atau salah, jawablah secara jujur.</em></p>
                </div>

                <!-- PROGRESS BAR MELAYANG (STICKY) -->
                <div class="progress-container">
                    <div class="d-flex justify-content-between align-items-end mb-2">
                        <span class="fw-bold" style="font-size: 14px; color: var(--text);">Progres Pengisian</span>
                        <span class="fw-bold" id="progress-text" style="font-size: 14px; color: var(--primary);">0 / {{ count($questions) }} Terjawab</span>
                    </div>
                    <div class="progress" style="height: 10px; border-radius: 10px; background-color: var(--border);">
                        <div class="progress-bar custom-progress-bar" id="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <form id="form-skrining" action="{{ route('mahasiswa.screenings.store') }}" method="POST" novalidate>
                    @csrf
                    
                    @foreach($questions as $index => $q)
                    <div class="question-block" id="block_{{ $q->id }}">
                        <p class="question-text">
                            <span class="me-1" style="color: var(--primary);">{{ $index + 1 }}.</span> {{ $q->question_text }}
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
document.addEventListener('DOMContentLoaded', function() {
    let isFormDirty = false;
    const formSkrining = document.getElementById('form-skrining');
    const btnSubmit = document.getElementById('btnSubmit');
    const formInputs = document.querySelectorAll('#form-skrining input[type="radio"]');
    
    // Setup Progress Bar
    const totalQuestions = document.querySelectorAll('.question-block').length;
    const progressBar = document.getElementById('progress-bar');
    const progressText = document.getElementById('progress-text');

    // Fungsi Update Progress Bar
    function updateProgress() {
        const answeredQuestions = document.querySelectorAll('.question-block input[type="radio"]:checked').length;
        const percentage = (answeredQuestions / totalQuestions) * 100;

        if (progressBar) {
            progressBar.style.width = percentage + '%';
            
            // Tambahkan efek komplit jika 100%
            if (percentage === 100) {
                progressBar.classList.add('completed');
                if (progressText) progressText.style.color = 'var(--success)';
            } else {
                progressBar.classList.remove('completed');
                if (progressText) progressText.style.color = 'var(--primary)';
            }
        }
        
        if (progressText) progressText.innerText = `${answeredQuestions} / ${totalQuestions} Terjawab`;
    }

    updateProgress();

    // Event Listener saat user memilih jawaban
    formInputs.forEach(input => {
        input.addEventListener('change', function() {
            isFormDirty = true;
            
            const questionBlock = this.closest('.question-block');
            if(questionBlock) {
                questionBlock.classList.remove('has-error');
            }

            updateProgress();
        });
    });

    // Mencegah keluar halaman tidak sengaja
    window.addEventListener('beforeunload', function (e) {
        if (isFormDirty) {
            e.preventDefault();
            e.returnValue = ''; 
        }
    });

    // Validasi dan Konfirmasi Submit
    if (formSkrining) {
        formSkrining.addEventListener('submit', function(e) {
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

            if (!isValid) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Belum Selesai',
                    text: `Terdapat ${emptyCount} pertanyaan yang belum Anda jawab. Silakan periksa kembali bagian yang ditandai merah.`,
                    confirmButtonColor: '#4A7A6D', // Sage Green
                    confirmButtonText: 'Baik, Saya Periksa'
                }).then(() => {
                    if (firstErrorBlock) {
                        // Offset -150px agar pertanyaan yang error tidak tertutup sticky progress bar
                        const y = firstErrorBlock.getBoundingClientRect().top + window.scrollY - 150;
                        window.scrollTo({top: y, behavior: 'smooth'});
                    }
                });
                return;
            }

            Swal.fire({
                title: 'Sudah Yakin?',
                text: "Pastikan semua pertanyaan telah dijawab sesuai dengan apa yang Anda rasakan.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4A7A6D', // Sage Green
                cancelButtonColor: '#E53E3E', // Soft Red
                confirmButtonText: '<i class="bi bi-send-check"></i> Ya, Kirim Sekarang',
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