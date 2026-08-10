<style>
    /* =========================================================
       THEME VARIABLES
    ========================================================= */

    :root {
        --theme-bg: #F4F7F6;
        --theme-bg-secondary: #E8F0EC;
        --theme-card: #FFFFFF;
        --theme-text: #2D3748;
        --theme-text-secondary: #64748B;
        --theme-border: #D9E2DE;
        --theme-input: #FFFFFF;
        --theme-navbar: rgba(255, 255, 255, .95);

        --theme-primary: #4A7A6D;
        --theme-primary-hover: #3B6358;
    }

    html[data-bs-theme="dark"] {
        --theme-bg: #0F172A;
        --theme-bg-secondary: #172235;
        --theme-card: #1E293B;
        --theme-text: #F8FAFC;
        --theme-text-secondary: #94A3B8;
        --theme-border: #334155;
        --theme-input: #172033;
        --theme-navbar: rgba(15, 23, 42, .96);

        --theme-primary: #6BB29E;
        --theme-primary-hover: #83C5B3;
    }


    /* =========================================================
       GLOBAL TRANSITION
    ========================================================= */

    html,
    body {
        transition:
            background-color .3s ease,
            color .3s ease;
    }


    /* =========================================================
       DARK MODE - BODY
    ========================================================= */

    html[data-bs-theme="dark"] body {
        background-color: var(--theme-bg) !important;
        color: var(--theme-text) !important;
    }


    /* =========================================================
       DARK MODE - HEADER / NAVBAR
    ========================================================= */

    html[data-bs-theme="dark"] header,
    html[data-bs-theme="dark"] nav,
    html[data-bs-theme="dark"] .navbar,
    html[data-bs-theme="dark"] .header,
    html[data-bs-theme="dark"] footer {
        background-color: var(--theme-navbar) !important;
        color: var(--theme-text) !important;
        border-color: var(--theme-border) !important;
    }


    /* =========================================================
       DARK MODE - MAIN / SECTION
    ========================================================= */

    html[data-bs-theme="dark"] main,
    html[data-bs-theme="dark"] section {
        color: var(--theme-text);
    }


    /* =========================================================
       DARK MODE - CARD
    ========================================================= */

    html[data-bs-theme="dark"] .card,
    html[data-bs-theme="dark"] .login-card,
    html[data-bs-theme="dark"] .register-card {
        background: var(--theme-card) !important;
        color: var(--theme-text) !important;
        border-color: var(--theme-border) !important;
    }


    /* =========================================================
       DARK MODE - TEXT
    ========================================================= */

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


    /* =========================================================
       DARK MODE - LINK
    ========================================================= */

    html[data-bs-theme="dark"] a {
        color: #83C5B3;
    }


    /* =========================================================
       DARK MODE - FORM
    ========================================================= */

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


    /* =========================================================
       DARK MODE - BACKGROUND
    ========================================================= */

    html[data-bs-theme="dark"] .bg-white {
        background-color: var(--theme-card) !important;
    }

    html[data-bs-theme="dark"] .bg-light {
        background-color: var(--theme-bg-secondary) !important;
    }


    /* =========================================================
       DARK MODE - INLINE BACKGROUND
    ========================================================= */

    html[data-bs-theme="dark"] [style*="background:#fff"],
    html[data-bs-theme="dark"] [style*="background: #fff"],
    html[data-bs-theme="dark"] [style*="background:#FFFFFF"],
    html[data-bs-theme="dark"] [style*="background: #FFFFFF"],
    html[data-bs-theme="dark"] [style*="background:white"],
    html[data-bs-theme="dark"] [style*="background: white"] {
        background: var(--theme-card) !important;
    }


    /* =========================================================
       DARK MODE - INLINE TEXT
    ========================================================= */

    html[data-bs-theme="dark"] [style*="color:#2D3748"],
    html[data-bs-theme="dark"] [style*="color: #2D3748"],
    html[data-bs-theme="dark"] [style*="color:#1E293B"],
    html[data-bs-theme="dark"] [style*="color: #1E293B"] {
        color: #F8FAFC !important;
    }


    /* =========================================================
       THEME TOGGLE
       DEFAULT STYLE
    ========================================================= */

    .theme-toggle-auth {
        width: 44px;
        height: 44px;

        padding: 0;

        border: 1px solid rgba(203, 213, 208, .7);
        border-radius: 50%;

        background: rgba(255, 255, 255, .95);

        color: #2D3748;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        font-size: 17px;

        cursor: pointer;

        box-shadow: 0 6px 20px rgba(0, 0, 0, .12);

        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);

        transition: all .3s ease;

        outline: none;
    }


    /* =========================================================
       HOVER
    ========================================================= */

    .theme-toggle-auth:hover {
        transform: translateY(-2px) rotate(8deg);

        box-shadow:
            0 8px 24px rgba(0, 0, 0, .18);
    }


    /* =========================================================
       DARK MODE TOGGLE
    ========================================================= */

    html[data-bs-theme="dark"] .theme-toggle-auth {
        background: #1E293B;
        border-color: #475569;
        color: #F8FAFC;
    }

    html[data-bs-theme="dark"] .theme-toggle-auth:hover {
        color: #83C5B3;
        border-color: #64748B;
    }


    /* =========================================================
       AUTH PAGE BUTTON
       LOGIN / REGISTER
    ========================================================= */

    .auth-theme-toggle {
        position: fixed;

        top: 24px;
        right: 24px;

        z-index: 999999;
    }


    /* =========================================================
       NAVBAR BUTTON
    ========================================================= */

    .navbar-theme-toggle {
        margin-left: 24px;
    }


    /* =========================================================
       MOBILE
    ========================================================= */

    @media (max-width: 576px) {

        .theme-toggle-auth {
            width: 40px;
            height: 40px;

            font-size: 15px;
        }

        .auth-theme-toggle {
            top: 15px;
            right: 15px;
        }

        .navbar-theme-toggle {
            margin-left: 10px;
        }
    }
</style>


{{-- =========================================================
     AUTH THEME BUTTON
     HANYA MUNCUL DI LOGIN / REGISTER
========================================================= --}}

@if (
    request()->routeIs('login') ||
    request()->routeIs('register')
)
    <button
        type="button"
        class="theme-toggle-auth auth-theme-toggle"
        id="authThemeToggle"
        aria-label="Ganti tema"
        title="Ganti tema"
    >
        <i
            class="bi bi-moon-stars-fill theme-icon"
            id="authThemeIcon"
        ></i>
    </button>
@endif


<script>
(function () {

    /* =========================================================
       GET HTML
    ========================================================= */

    const html = document.documentElement;


    /* =========================================================
       GET SAVED THEME
    ========================================================= */

    const savedTheme = localStorage.getItem('theme');


    /* =========================================================
       GET SYSTEM THEME
    ========================================================= */

    const systemDark = window.matchMedia(
        '(prefers-color-scheme: dark)'
    ).matches;


    /* =========================================================
       INITIAL THEME
    ========================================================= */

    const initialTheme =
        savedTheme ||
        (systemDark ? 'dark' : 'light');


    /* =========================================================
       APPLY INITIAL THEME IMMEDIATELY
    ========================================================= */

    html.setAttribute(
        'data-bs-theme',
        initialTheme
    );


    /* =========================================================
       UPDATE THEME
    ========================================================= */

    function updateTheme(theme) {

        /* Apply theme */
        html.setAttribute(
            'data-bs-theme',
            theme
        );


        /* Save theme */
        localStorage.setItem(
            'theme',
            theme
        );


        /* Get all theme icons */
        const icons =
            document.querySelectorAll('.theme-icon');


        /* Update icons */
        icons.forEach(function (icon) {

            if (theme === 'dark') {

                icon.className =
                    'bi bi-sun-fill theme-icon';

            } else {

                icon.className =
                    'bi bi-moon-stars-fill theme-icon';

            }

        });


        /* Update sidebar icon */
        const sidebarIcon =
            document.getElementById('themeIconSidebar');

        if (sidebarIcon) {

            sidebarIcon.className =
                theme === 'dark'
                    ? 'bi bi-sun-fill'
                    : 'bi bi-moon-stars-fill';

        }


        /* Update mobile icon */
        const mobileIcon =
            document.getElementById('themeIconMobile');

        if (mobileIcon) {

            mobileIcon.className =
                theme === 'dark'
                    ? 'bi bi-sun-fill fs-5'
                    : 'bi bi-moon-stars-fill fs-5';

        }


        /* Update sidebar text */
        const sidebarText =
            document.getElementById('themeTextSidebar');

        if (sidebarText) {

            sidebarText.textContent =
                theme === 'dark'
                    ? 'Mode Terang'
                    : 'Mode Gelap';

        }


        /* Update aria label */
        const buttons =
            document.querySelectorAll('.theme-toggle-auth');

        buttons.forEach(function (button) {

            button.setAttribute(
                'aria-label',
                theme === 'dark'
                    ? 'Aktifkan mode terang'
                    : 'Aktifkan mode gelap'
            );

            button.setAttribute(
                'title',
                theme === 'dark'
                    ? 'Aktifkan mode terang'
                    : 'Aktifkan mode gelap'
            );

        });

    }


    /* =========================================================
       DOM READY
    ========================================================= */

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            /* Apply current theme */
            updateTheme(
                html.getAttribute(
                    'data-bs-theme'
                ) || 'light'
            );


            /* =================================================
               ALL THEME BUTTONS
            ================================================= */

            const themeButtons =
                document.querySelectorAll(
                    '#authThemeToggle, #navbarThemeToggle, .theme-toggle-auth'
                );


            /* =================================================
               CLICK EVENT
            ================================================= */

            themeButtons.forEach(
                function (button) {

                    button.addEventListener(
                        'click',
                        function () {

                            const currentTheme =
                                html.getAttribute(
                                    'data-bs-theme'
                                ) || 'light';


                            const newTheme =
                                currentTheme === 'dark'
                                    ? 'light'
                                    : 'dark';


                            updateTheme(
                                newTheme
                            );

                        }
                    );

                }
            );

        }
    );

})();
</script>