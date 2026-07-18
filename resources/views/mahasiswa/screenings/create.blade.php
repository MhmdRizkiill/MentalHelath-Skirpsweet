@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        CUSTOM STYLE KUESIONER
    =========================== */
    .questionnaire-card {
        border: none;
        border-radius: 20px;
        background: #FFFFFF;
        box-shadow: 0 10px 40px -10px rgba(15, 23, 42, 0.08);
        position: relative;
        /* overflow: hidden; SUDAH DIHAPUS AGAR STICKY BERFUNGSI */
    }

    .questionnaire-header {
        background: linear-gradient(135deg, #4F46E5 0%, #3B82F6 100%);
        padding: 30px 20px;
        text-align: center;
        color: white;
        border-top-left-radius: 20px; /* Ditambahkan agar sudut atas tetap melengkung */
        border-top-right-radius: 20px;
    }

    .info-panel {
        background: #F0F7FF;
        border: 1px solid #D1E5F9;
        border-radius: 16px;
        padding: 24px;
        color: #1E3A8A;
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
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 16px 20px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.12);
        border: 1px solid rgba(226, 232, 240, 0.8);
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    /* Style untuk Pertanyaan */
    .question-block {
        padding: 24px 0;
        border-bottom: 1px dashed #E2E8F0;
        transition: all 0.3s ease;
    }

    .question-block:last-child {
        border-bottom: none;
    }

    .question-block:hover {
        background: #F8FAFC;
        border-radius: 12px;
        padding: 24px 16px;
        margin: 0 -16px;
    }

    .question-text {
        font-size: 16px;
        font-weight: 600;
        color: #0F172A;
        line-height: 1.6;
        margin-bottom: 16px;
    }

    /* Highlight Error jika belum diisi */
    .question-block.has-error {
        background-color: #FEF2F2 !important;
        border: 1px solid #FECACA !important;
        border-radius: 12px;
        padding: 24px 16px;
        margin: 0 -16px;
    }

    .error-text {
        display: none;
        color: #EF4444;
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
        background: #FFFFFF;
        border: 1.5px solid #CBD5E1;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        color: #475569;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        z-index: 1;
    }

    .custom-radio:hover .form-check-label {
        border-color: #94A3B8;
        background: #F8FAFC;
    }

    .custom-radio .form-check-input:checked + .form-check-label {
        background: #EEF6FF;
        border-color: #3B82F6;
        color: #1D4ED8;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        transform: translateY(-2px);
    }

    .custom-radio .form-check-input:focus-visible + .form-check-label {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        outline: none;
    }

    .btn-submit-test {
        height: 56px;
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 0.5px;
        border-radius: 16px;
        background: linear-gradient(135deg, #4F46E5 0%, #3B82F6 100%);
        border: none;
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.2);
        transition: all 0.3s ease;
    }

    .btn-submit-test:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(79, 70, 229, 0.3);
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
                    <p class="mb-0">Bacalah setiap pernyataan dan pilih jawaban yang paling menggambarkan keadaan Anda selama <strong>SATU MINGGU TERAKHIR</strong>. <em>Tidak ada jawaban yang benar atau salah, jawablah secara jujur.</em></p>
                </div>

                <!-- PROGRESS BAR MELAYANG (STICKY) -->
                <div class="progress-container">
                    <div class="d-flex justify-content-between align-items-end mb-2">
                        <span class="fw-bold text-dark" style="font-size: 14px;">Progres Pengisian</span>
                        <span class="fw-bold text-primary" id="progress-text" style="font-size: 14px;">0 / {{ count($questions) }} Terjawab</span>
                    </div>
                    <div class="progress" style="height: 10px; border-radius: 10px; background-color: #E2E8F0;">
                        <div class="progress-bar bg-primary" id="progress-bar" role="progressbar" style="width: 0%; border-radius: 10px; transition: width 0.4s ease;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <form id="form-skrining" action="{{ route('mahasiswa.screenings.store') }}" method="POST" novalidate>
                    @csrf
                    
                    @foreach($questions as $index => $q)
                    <div class="question-block" id="block_{{ $q->id }}">
                        <p class="question-text">
                            <span class="text-primary me-1">{{ $index + 1 }}.</span> {{ $q->question_text }}
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
                        <button type="submit" id="btnSubmit" class="btn btn-primary btn-submit-test text-white">
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

        if (progressBar) progressBar.style.width = percentage + '%';
        if (progressText) progressText.innerText = `${answeredQuestions} / ${totalQuestions} Terjawab`;

        if (percentage === 100) {
            progressBar.classList.remove('bg-primary');
            progressBar.classList.add('bg-success');
        } else {
            progressBar.classList.remove('bg-success');
            progressBar.classList.add('bg-primary');
        }
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
                    confirmButtonColor: '#4F46E5',
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
                confirmButtonColor: '#22C55E', 
                cancelButtonColor: '#EF4444', 
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