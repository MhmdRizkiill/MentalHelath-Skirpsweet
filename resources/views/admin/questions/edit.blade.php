@extends('layouts.app')

@section('content')

<style>
    /* ===========================
        VARIABEL TEMA FORM ADMIN
    =========================== */
    :root {
        --form-bg-card: #FFFFFF;
        --form-header-bg: #F8FAFC;
        --form-border: rgba(226, 232, 240, 0.8);
        --form-text-main: #0F172A;
        --form-text-muted: #64748B;
        --form-input-bg: #FFFFFF;
        --form-input-border: #CBD5E1;
        --form-input-text: #1E293B;
        --form-input-placeholder: #94A3B8;
        --form-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.05);
        
        --btn-cancel-bg: #FFFFFF;
        --btn-cancel-border: #CBD5E1;
        --btn-cancel-text: #475569;
        --btn-cancel-hover-bg: #F8FAFC;
        --btn-cancel-hover-border: #94A3B8;
        --btn-cancel-hover-text: #0F172A;
        --border-divider: #F1F5F9;
    }

    html.dark, body.dark-mode, [data-bs-theme="dark"] {
        --form-bg-card: #1e293b;
        --form-header-bg: #0f172a;
        --form-border: rgba(255, 255, 255, 0.1);
        --form-text-main: #f8fafc;
        --form-text-muted: #94a3b8;
        --form-input-bg: #1e293b;
        --form-input-border: #475569;
        --form-input-text: #f8fafc;
        --form-input-placeholder: #94a3b8;
        --form-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.3);
        
        --btn-cancel-bg: #1e293b;
        --btn-cancel-border: #475569;
        --btn-cancel-text: #cbd5e1;
        --btn-cancel-hover-bg: rgba(255, 255, 255, 0.05);
        --btn-cancel-hover-border: #94a3b8;
        --btn-cancel-hover-text: #f8fafc;
        --border-divider: rgba(255, 255, 255, 0.1);
    }

    /* Helper Classes */
    .text-adaptive { color: var(--form-text-main) !important; }
    .text-adaptive-muted { color: var(--form-text-muted) !important; }

    /* ===========================
        CUSTOM STYLE FORM ADMIN
    =========================== */
    .admin-form-card {
        border: 1px solid var(--form-border);
        border-radius: 20px;
        background: var(--form-bg-card);
        box-shadow: var(--form-shadow);
        overflow: hidden;
    }

    .admin-form-header {
        background: var(--form-header-bg);
        border-bottom: 1px solid var(--border-divider);
        padding: 24px 30px;
        display: flex;
        align-items: center;
    }

    .header-icon-box {
        width: 48px;
        height: 48px;
        background: rgba(79, 70, 229, 0.1);
        color: #4F46E5;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-right: 16px;
    }

    .form-label {
        font-weight: 600;
        color: var(--form-text-main);
        font-size: 14px;
        margin-bottom: 8px;
    }

    /* Input Group Styling */
    .input-group {
        border: 1px solid var(--form-input-border);
        border-radius: 14px;
        background: var(--form-input-bg);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .input-group:focus-within {
        border-color: #4F46E5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    .input-group-text {
        background: transparent;
        border: none;
        color: var(--form-input-placeholder);
        padding-left: 16px;
        padding-right: 10px;
    }

    /* Styling khusus icon pada textarea agar posisinya di atas */
    .input-group-text.textarea-icon {
        align-items: flex-start;
        padding-top: 14px;
    }

    .form-control, .form-select {
        border: none;
        border-radius: 0 14px 14px 0;
        font-size: 14.5px;
        color: var(--form-input-text);
        background: transparent;
    }
    
    .form-select {
        height: 52px;
        padding-left: 6px;
        cursor: pointer;
    }

    /* Memperbaiki warna opsi dropdown select pada dark mode */
    .form-select option {
        background-color: var(--form-bg-card);
        color: var(--form-text-main);
    }

    .form-control:not(textarea) {
        height: 52px;
        padding-left: 6px;
    }

    textarea.form-control {
        padding-top: 14px;
        padding-left: 6px;
        resize: vertical;
        min-height: 120px;
    }

    .form-control:focus, .form-select:focus {
        background: transparent;
        box-shadow: none;
        border: none;
        outline: none;
        color: var(--form-input-text);
    }

    .form-control::placeholder {
        color: var(--form-input-placeholder);
        font-size: 14px;
    }

    /* Error Handling Style */
    .input-group.is-invalid-group {
        border-color: #EF4444;
    }
    .input-group.is-invalid-group:focus-within {
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    /* Button Actions */
    .btn-action {
        height: 50px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 14.5px;
        padding: 0 24px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        letter-spacing: 0.3px;
    }

    .btn-save {
        background: linear-gradient(135deg, #4F46E5 0%, #3B82F6 100%);
        border: none;
        color: white;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
    }

    .btn-save:hover {
        background: linear-gradient(135deg, #4338CA 0%, #2563EB 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.25);
        color: white;
    }

    .btn-cancel {
        background: var(--btn-cancel-bg);
        border: 1px solid var(--btn-cancel-border);
        color: var(--btn-cancel-text);
    }

    .btn-cancel:hover {
        background: var(--btn-cancel-hover-bg);
        border-color: var(--btn-cancel-hover-border);
        color: var(--btn-cancel-hover-text);
    }

    @media(max-width: 576px) {
        .admin-form-header {
            padding: 20px;
        }
        .action-buttons {
            flex-direction: column-reverse;
            gap: 12px;
        }
        .btn-action {
            width: 100%;
        }
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            
            <div class="card admin-form-card">
                <!-- Header Card -->
                <div class="admin-form-header">
                    <div class="header-icon-box">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 fw-bold text-adaptive" style="letter-spacing: -0.5px;">Edit Pertanyaan</h4>
                        <p class="text-adaptive-muted mb-0" style="font-size: 13.5px;">Perbarui teks atau kategori instrumen kuesioner DASS-42.</p>
                    </div>
                </div>
                
                <!-- Body Card -->
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Input Teks Pertanyaan -->
                        <div class="mb-4">
                            <label for="question_text" class="form-label">Teks Pertanyaan</label>
                            <div class="input-group @error('question_text') is-invalid-group @enderror">
                                <span class="input-group-text textarea-icon">
                                    <i class="bi bi-card-text"></i>
                                </span>
                                <textarea class="form-control @error('question_text') is-invalid @enderror" 
                                          id="question_text" 
                                          name="question_text" 
                                          rows="4" 
                                          required>{{ old('question_text', $question->question_text) }}</textarea>
                            </div>
                            @error('question_text')
                                <div class="invalid-feedback d-block mt-2 px-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Select Kategori DASS-42 -->
                        <div class="mb-5">
                            <label for="category" class="form-label">Kategori DASS-42</label>
                            <div class="input-group @error('category') is-invalid-group @enderror">
                                <span class="input-group-text">
                                    <i class="bi bi-tags"></i>
                                </span>
                                <select class="form-select @error('category') is-invalid @enderror" 
                                        id="category" 
                                        name="category" 
                                        required>
                                    <option value="depression" {{ old('category', $question->category) == 'depression' ? 'selected' : '' }}>Depresi (Depression)</option>
                                    <option value="anxiety" {{ old('category', $question->category) == 'anxiety' ? 'selected' : '' }}>Kecemasan (Anxiety)</option>
                                    <option value="stress" {{ old('category', $question->category) == 'stress' ? 'selected' : '' }}>Stres (Stress)</option>
                                </select>
                            </div>
                            @error('category')
                                <div class="invalid-feedback d-block mt-2 px-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between action-buttons border-top pt-4 mt-2" style="border-color: var(--border-divider) !important;">
                            <a href="{{ route('admin.questions.index') }}" class="text-decoration-none btn-action btn-cancel">
                                <i class="bi bi-arrow-left me-2"></i> Kembali
                            </a>
                            <button type="submit" class="btn-action btn-save">
                                <i class="bi bi-cloud-check-fill me-2"></i> Update Pertanyaan
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection