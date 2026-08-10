<style>
    :root {
        --theme-bg: #F4F7F6;
        --theme-text: #2D3748;
        --theme-muted: #64748B;
        --theme-card: rgba(255,255,255,.92);
        --theme-border: rgba(203,213,208,.7);
        --theme-input: #FFFFFF;
    }

    html[data-theme="dark"] {
        --theme-bg: #0F172A;
        --theme-text: #F8FAFC;
        --theme-muted: #94A3B8;
        --theme-card: rgba(30,41,59,.94);
        --theme-border: rgba(148,163,184,.18);
        --theme-input: rgba(15,23,42,.85);
    }

    body {
        background-color: var(--theme-bg) !important;
        color: var(--theme-text);
        transition: background-color .3s ease,color .3s ease;
    }

    .theme-toggle-auth {
        position: fixed;
        top: 24px;
        right: 24px;
        width: 44px;
        height: 44px;
        border: 1px solid var(--theme-border);
        border-radius: 50%;
        background: var(--theme-card);
        color: var(--theme-text);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 9999;
        box-shadow: 0 6px 20px rgba(0,0,0,.08);
        backdrop-filter: blur(12px);
        transition: all .3s ease;
    }

    .theme-toggle-auth:hover {
        transform: translateY(-2px) rotate(8deg);
        color: #4A7A6D;
        box-shadow: 0 8px 25px rgba(0,0,0,.14);
    }

    html[data-theme="dark"] .theme-toggle-auth {
        background: rgba(30,41,59,.95);
        color: #F8FAFC;
    }

    html[data-theme="dark"] .theme-toggle-auth:hover {
        color: #83C5B3;
    }

    html[data-theme="dark"] .login-card,
    html[data-theme="dark"] .register-card {
        background: var(--theme-card) !important;
        border-color: var(--theme-border) !important;
        color: var(--theme-text);
    }

    html[data-theme="dark"] .login-title,
    html[data-theme="dark"] .register-title {
        color: #F8FAFC !important;
    }

    html[data-theme="dark"] .login-subtitle,
    html[data-theme="dark"] .register-subtitle {
        color: #94A3B8 !important;
    }

    html[data-theme="dark"] .form-label {
        color: #E2E8F0 !important;
    }

    html[data-theme="dark"] .input-group {
        background: var(--theme-input) !important;
        border-color: var(--theme-border) !important;
    }

    html[data-theme="dark"] .input-group-text {
        color: #94A3B8 !important;
    }

    html[data-theme="dark"] .form-control {
        color: #F8FAFC !important;
        background: transparent !important;
    }

    html[data-theme="dark"] .form-control::placeholder {
        color: #64748B !important;
    }

    html[data-theme="dark"] .login-footer,
    html[data-theme="dark"] .register-footer {
        color: #94A3B8 !important;
    }

    html[data-theme="dark"] .text-muted {
        color: #94A3B8 !important;
    }

    html[data-theme="dark"] a {
        color: #83C5B3;
    }

    @media (max-width:576px) {
        .theme-toggle-auth {
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
        }
    }
</style>

<button type="button" class="theme-toggle-auth" id="authThemeToggle" aria-label="Ganti tema">
    <i class="bi bi-moon-stars-fill" id="authThemeIcon"></i>
</button>

<script>
(function() {
    const html = document.documentElement;
    const savedTheme = localStorage.getItem('theme');
    const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const theme = savedTheme || (systemDark ? 'dark' : 'light');

    html.setAttribute('data-theme', theme);

    document.addEventListener('DOMContentLoaded', function() {
        const button = document.getElementById('authThemeToggle');
        const icon = document.getElementById('authThemeIcon');

        function updateTheme(theme) {
            html.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);

            if (icon) {
                icon.className = theme === 'dark'
                    ? 'bi bi-sun-fill'
                    : 'bi bi-moon-stars-fill';
            }
        }

        updateTheme(theme);

        if (button) {
            button.addEventListener('click', function() {
                const currentTheme = html.getAttribute('data-theme');
                updateTheme(currentTheme === 'dark' ? 'light' : 'dark');
            });
        }
    });
})();
</script>