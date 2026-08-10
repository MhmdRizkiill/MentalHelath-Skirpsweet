<style>
:root {
    --theme-bg: #F4F7F6;
    --theme-bg-secondary: #E8F0EC;
    --theme-card: #FFFFFF;
    --theme-text: #2D3748;
    --theme-text-secondary: #64748B;
    --theme-border: #D9E2DE;
    --theme-input: #FFFFFF;
    --theme-navbar: rgba(255,255,255,.95);
}
html[data-bs-theme="dark"] {
    --theme-bg: #0F172A;
    --theme-bg-secondary: #172235;
    --theme-card: #1E293B;
    --theme-text: #F8FAFC;
    --theme-text-secondary: #94A3B8;
    --theme-border: #334155;
    --theme-input: #172033;
    --theme-navbar: rgba(15,23,42,.96);
}
html,body {
    transition: background-color .3s ease,color .3s ease;
}
html[data-bs-theme="dark"] body {
    background: var(--theme-bg) !important;
    color: var(--theme-text) !important;
}
html[data-bs-theme="dark"] header,
html[data-bs-theme="dark"] nav,
html[data-bs-theme="dark"] .navbar,
html[data-bs-theme="dark"] .header,
html[data-bs-theme="dark"] footer {
    background-color: var(--theme-navbar) !important;
    color: var(--theme-text) !important;
    border-color: var(--theme-border) !important;
}
html[data-bs-theme="dark"] main,
html[data-bs-theme="dark"] section {
    color: var(--theme-text);
}
html[data-bs-theme="dark"] .card,
html[data-bs-theme="dark"] .login-card,
html[data-bs-theme="dark"] .register-card {
    background: var(--theme-card) !important;
    color: var(--theme-text) !important;
    border-color: var(--theme-border) !important;
}
html[data-bs-theme="dark"] h1,
html[data-bs-theme="dark"] h2,
html[data-bs-theme="dark"] h3,
html[data-bs-theme="dark"] h4,
html[data-bs-theme="dark"] h5,
html[data-bs-theme="dark"] h6,
html[data-bs-theme="dark"] p,
html[data-bs-theme="dark"] span,
html[data-bs-theme="dark"] label,
html[data-bs-theme="dark"] li {
    color: inherit;
}
html[data-bs-theme="dark"] .text-dark {
    color: #F8FAFC !important;
}
html[data-bs-theme="dark"] .text-muted {
    color: #94A3B8 !important;
}
html[data-bs-theme="dark"] a {
    color: #83C5B3;
}
html[data-bs-theme="dark"] .form-control,
html[data-bs-theme="dark"] .form-select,
html[data-bs-theme="dark"] input,
html[data-bs-theme="dark"] textarea {
    background-color: var(--theme-input) !important;
    color: #F8FAFC !important;
    border-color: var(--theme-border) !important;
}
html[data-bs-theme="dark"] .form-control::placeholder,
html[data-bs-theme="dark"] input::placeholder,
html[data-bs-theme="dark"] textarea::placeholder {
    color: #64748B !important;
}
html[data-bs-theme="dark"] .bg-white {
    background-color: var(--theme-card) !important;
}
html[data-bs-theme="dark"] .bg-light {
    background-color: var(--theme-bg-secondary) !important;
}
html[data-bs-theme="dark"] [style*="background:#fff"],
html[data-bs-theme="dark"] [style*="background: #fff"],
html[data-bs-theme="dark"] [style*="background:#FFFFFF"],
html[data-bs-theme="dark"] [style*="background: #FFFFFF"],
html[data-bs-theme="dark"] [style*="background:white"],
html[data-bs-theme="dark"] [style*="background: white"] {
    background: var(--theme-card) !important;
}
html[data-bs-theme="dark"] [style*="color:#2D3748"],
html[data-bs-theme="dark"] [style*="color: #2D3748"],
html[data-bs-theme="dark"] [style*="color:#1E293B"],
html[data-bs-theme="dark"] [style*="color: #1E293B"] {
    color: #F8FAFC !important;
}
.theme-toggle-auth {
    position: fixed;
    top: 24px;
    right: 24px;
    width: 44px;
    height: 44px;
    border: 1px solid rgba(203,213,208,.7);
    border-radius: 50%;
    background: rgba(255,255,255,.95);
    color: #2D3748;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 99999;
    box-shadow: 0 6px 20px rgba(0,0,0,.12);
    backdrop-filter: blur(12px);
    transition: all .3s ease;
}
.theme-toggle-auth:hover {
    transform: translateY(-2px) rotate(8deg);
}
html[data-bs-theme="dark"] .theme-toggle-auth {
    background: #1E293B;
    border-color: #475569;
    color: #F8FAFC;
}
html[data-bs-theme="dark"] .theme-toggle-auth:hover {
    color: #83C5B3;
}
@media(max-width:576px) {
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
    const initialTheme = savedTheme || (systemDark ? 'dark' : 'light');

    html.setAttribute('data-bs-theme', initialTheme);

    document.addEventListener('DOMContentLoaded', function() {
        const button = document.getElementById('authThemeToggle');
        const icon = document.getElementById('authThemeIcon');

        function updateTheme(theme) {
            html.setAttribute('data-bs-theme', theme);
            localStorage.setItem('theme', theme);

            if (icon) {
                icon.className = theme === 'dark'
                    ? 'bi bi-sun-fill'
                    : 'bi bi-moon-stars-fill';
            }
        }

        updateTheme(initialTheme);

        if (button) {
            button.addEventListener('click', function() {
                const currentTheme = html.getAttribute('data-bs-theme') || 'light';
                updateTheme(currentTheme === 'dark' ? 'light' : 'dark');
            });
        }
    });
})();
</script>