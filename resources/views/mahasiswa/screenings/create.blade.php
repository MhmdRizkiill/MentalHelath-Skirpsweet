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
        overflow: hidden;
    }

    .questionnaire-header {
        background: linear-gradient(135deg, #4F46E5 0%, #3B82F6 100%);
        padding: 30px 20px;
        text-align: center;
        color: white;
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

    /* Style untuk Pertanyaan */
    .question-block {
        padding: 24px 0;
        border-bottom: 1px dashed #E2E8F0;
        transition: background 0.3s ease;
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
                
                <div class="info-panel mb-5">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-info-circle-fill fs-4 me-2"></i>
                        <h5 class="mb-0 fw-bold">Petunjuk Pengisian</h5>
                    </div>
                    <p class="mb-0">Bacalah setiap pernyataan dan pilih jawaban yang paling menggambarkan keadaan Anda selama <strong>SATU MINGGU TERAKHIR</strong>. <em>Tidak ada jawaban yang benar atau salah, jawablah secara jujur.</em></p>
                </div>

                <form id="form-skrining" action="{{ route('mahasiswa.screenings.store') }}" method="POST">
                    @csrf
                    
                    @foreach($questions as $index => $q)
                    <div class="question-block">
                        <p class="question-text">
                            <span class="text-primary me-1">{{ $index + 1 }}.</span> {{ $q->question_text }}
                        </p>
                        
                        <div class="options-grid">
                            <div class="custom-radio">
                                <input class="form-check-input" type="radio" name="answers[{{ $q->id }}]" id="q_{{ $q->id }}_0" value="0" required>
                                <label class="form-check-label" for="q_{{ $q->id }}_0">Tidak Pernah</label>
                            </div>
                            <div class="custom-radio">
                                <input class="form-check-input" type="radio" name="answers[{{ $q->id }}]" id="q_{{ $q->id }}_1" value="1" required>
                                <label class="form-check-label" for="q_{{ $q->id }}_1">Kadang-kadang</label>
                            </div>
                            <div class="custom-radio">
                                <input class="form-check-input" type="radio" name="answers[{{ $q->id }}]" id="q_{{ $q->id }}_2" value="2" required>
                                <label class="form-check-label" for="q_{{ $q->id }}_2">Sering</label>
                            </div>
                            <div class="custom-radio">
                                <input class="form-check-input" type="radio" name="answers[{{ $q->id }}]" id="q_{{ $q->id }}_3" value="3" required>
                                <label class="form-check-label" for="q_{{ $q->id }}_3">Hampir Selalu</label>
                            </div>
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
<!-- Tambahkan CDN SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let isFormDirty = false;
    const formSkrining = document.getElementById('form-skrining');
    const btnSubmit = document.getElementById('btnSubmit');

    // 1. Pantau jika user sudah mulai mengisi
    const formInputs = document.querySelectorAll('#form-skrining input[type="radio"]');
    formInputs.forEach(input => {
        input.addEventListener('change', () => {
            isFormDirty = true;
        });
    });

    // 2. Cegah user keluar secara tidak sengaja
    window.addEventListener('beforeunload', function (e) {
        if (isFormDirty) {
            e.preventDefault();
            e.returnValue = ''; 
        }
    });

    // 3. Konfirmasi sebelum Submit Form menggunakan SweetAlert2
    if (formSkrining) {
        formSkrining.addEventListener('submit', function(e) {
            e.preventDefault(); // Tahan pengiriman form

            Swal.fire({
                title: 'Sudah Yakin?',
                text: "Pastikan semua pertanyaan telah dijawab sesuai dengan apa yang Anda rasakan.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4F46E5', // Warna tombol utama (primary)
                cancelButtonColor: '#EF4444', // Warna tombol batal (danger)
                confirmButtonText: '<i class="bi bi-send-check"></i> Ya, Kirim Sekarang',
                cancelButtonText: 'Cek Kembali',
                reverseButtons: true, // Membalik posisi tombol agar 'Kirim' ada di kanan
                customClass: {
                    popup: 'rounded-4' // Membuat sudut popup lebih halus
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Matikan peringatan beforeunload
                    isFormDirty = false; 
                    
                    // Ubah state tombol menjadi loading
                    if (btnSubmit) {
                        btnSubmit.disabled = true;
                        btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Menyimpan...';
                    }

                    // Kirim form secara terprogram
                    formSkrining.submit();
                }
            });
        });
    }
});
</script>
@endpush