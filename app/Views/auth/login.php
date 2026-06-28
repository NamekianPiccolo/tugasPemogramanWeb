<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Workspace DMS</title>
    <!-- Organic Theme Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@400;700&display=swap" rel="stylesheet">
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <style>
        :root {
            --bg: #f4ebd8;
            --surface: #fffcf2;
            --primary: #84a98c;
            --secondary: #e07a5f;
            --txt: #3d405b;
            --muted: #8a817c;
        }
        *, *::before, *::after { 
            box-sizing: border-box; 
            font-family: 'Kalam', cursive !important;
        }
        body {
            margin: 0; padding: 0;
            background-color: var(--bg);
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E");
            font-family: 'Kalam', cursive;
            color: var(--txt);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .organic-shape {
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
        }

        .container {
            background: var(--surface);
            position: relative;
            overflow: hidden;
            width: 800px;
            max-width: 90%;
            min-height: 520px;
            border: 3px solid var(--txt);
            box-shadow: 6px 6px 0px var(--txt);
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: var(--surface);
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }
        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
            opacity: 0;
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }
        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {
            0%, 49.99% { opacity: 0; z-index: 1; }
            50%, 100% { opacity: 1; z-index: 5; }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            z-index: 100;
        }
        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: var(--primary);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #fffcf2;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            display: flex;
            border-left: 3px solid var(--txt);
            border-right: 3px solid var(--txt);
        }
        .container.right-panel-active .overlay {
            transform: translateX(50%);
            background: var(--secondary);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .overlay-left {
            transform: translateX(-20%);
        }
        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }
        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        h1 {
            font-family: 'Kalam', cursive;
            font-weight: 700;
            margin: 0;
            margin-bottom: 16px;
            font-size: 32px;
            color: var(--txt);
        }
        .overlay-panel h1 {
            color: #fffcf2;
        }

        p {
            font-size: 15px;
            font-weight: 400;
            line-height: 24px;
            margin: 10px 0 30px;
        }

        .ni {
            background-color: transparent;
            border: 2px solid var(--txt);
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
            outline: none;
            font-family: 'Kalam', cursive;
            font-size: 15px;
            color: var(--txt);
            transition: all 0.2s;
        }
        .ni:focus {
            background-color: rgba(132, 169, 140, 0.1);
            transform: scale(1.02);
            box-shadow: 2px 2px 0px var(--txt);
        }
        .ni::placeholder {
            color: var(--muted);
            font-family: 'Kalam', cursive;
        }

        .btn-custom {
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
            border: 2px solid var(--txt);
            background-color: var(--primary);
            color: #fffcf2;
            font-size: 16px;
            font-family: 'Kalam', cursive;
            font-weight: bold;
            padding: 10px 45px;
            letter-spacing: 1px;
            transition: all 0.2s ease;
            cursor: pointer;
            margin-top: 15px;
            box-shadow: 3px 3px 0px var(--txt);
        }

        .btn-custom:active { transform: translateY(2px); box-shadow: 1px 1px 0px var(--txt); }
        .btn-custom:hover { background-color: #6a8c72; }
        .btn-custom:focus { outline: none; }
        
        .btn-custom.ghost {
            background-color: transparent;
            border-color: #fffcf2;
            color: #fffcf2;
            box-shadow: 3px 3px 0px #fffcf2;
        }
        .btn-custom.ghost:hover {
            background-color: rgba(255,255,255,0.1);
        }
        .btn-custom.ghost:active {
            transform: translateY(2px); box-shadow: 1px 1px 0px #fffcf2;
        }

        /* Scribble decoration */
        .scribble {
            position: absolute;
            opacity: 0.1;
            pointer-events: none;
            z-index: 0;
        }

        /* ═══════════════════════════════════════
           MOBILE LAYOUT (Android / ≤640px)
           ═══════════════════════════════════════ */
        @media (max-width: 640px) {
            /* Hide the desktop sliding-panel layout */
            .container,
            .scribble {
                display: none !important;
            }

            /* Show the mobile layout */
            .mobile-login-wrap {
                display: flex !important;
            }

            body {
                overflow: auto;
                align-items: flex-start;
                padding: 0;
            }
        }

        /* Mobile login: hidden on desktop */
        .mobile-login-wrap {
            display: none;
            flex-direction: column;
            align-items: stretch;
            min-height: 100vh;
            width: 100%;
            background: var(--bg);
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E");
        }

        /* Mobile header banner */
        .mob-header {
            background: var(--primary);
            border-bottom: 3px solid var(--txt);
            padding: 40px 24px 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .mob-header::after {
            content: '';
            position: absolute;
            bottom: -30px; right: -30px;
            width: 100px; height: 100px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
        }

        .mob-header-logo {
            width: 56px; height: 56px;
            background: #fffcf2;
            border: 3px solid var(--txt);
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
            box-shadow: 3px 3px 0 var(--txt);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
        }

        .mob-header-logo svg { color: var(--primary); }

        .mob-header h1 {
            color: #fffcf2;
            font-size: 1.6rem;
            margin: 0 0 6px;
        }

        .mob-header p {
            color: rgba(255,252,242,0.75);
            font-size: 0.85rem;
            margin: 0;
        }

        /* Tab switcher */
        .mob-tabs {
            display: flex;
            margin: 24px 20px 0;
            background: var(--surface);
            border: 2px solid var(--txt);
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
            box-shadow: 3px 3px 0 var(--txt);
            overflow: hidden;
        }

        .mob-tab {
            flex: 1;
            padding: 12px 8px;
            text-align: center;
            font-family: 'Kalam', cursive;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--muted);
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .mob-tab.active {
            background: var(--primary);
            color: #fffcf2;
        }

        .mob-tab:first-child.active {
            border-radius: 253px 13px 223px 13px / 13px 223px 13px 253px;
        }

        .mob-tab:last-child.active {
            background: var(--secondary);
            border-radius: 13px 253px 13px 223px / 223px 13px 253px 13px;
        }

        /* Form card */
        .mob-form-card {
            margin: 20px;
            background: var(--surface);
            border: 2px solid var(--txt);
            border-radius: 24px;
            box-shadow: 4px 4px 0 var(--txt);
            padding: 28px 24px;
        }

        .mob-form-card h2 {
            font-family: 'Kalam', cursive;
            font-size: 1.3rem;
            color: var(--txt);
            margin: 0 0 6px;
        }

        .mob-form-card p.mob-subtitle {
            font-size: 0.82rem;
            color: var(--muted);
            margin: 0 0 24px;
        }

        .mob-input {
            width: 100%;
            background: var(--bg);
            border: 2px solid var(--txt);
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
            padding: 14px 18px;
            font-family: 'Kalam', cursive;
            font-size: 1rem;
            color: var(--txt);
            outline: none;
            margin-bottom: 14px;
            transition: all 0.2s;
            display: block;
        }

        .mob-input:focus {
            background: #fff;
            box-shadow: 2px 2px 0 var(--txt);
            transform: scale(1.01);
        }

        .mob-input::placeholder { color: var(--muted); }

        .mob-btn {
            width: 100%;
            padding: 14px;
            border: 2px solid var(--txt);
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
            background: var(--primary);
            color: #fffcf2;
            font-family: 'Kalam', cursive;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 3px 3px 0 var(--txt);
            transition: all 0.2s;
            margin-top: 6px;
        }

        .mob-btn:active {
            transform: translateY(2px);
            box-shadow: 1px 1px 0 var(--txt);
        }

        .mob-btn.karyawan {
            background: var(--secondary);
        }

        .mob-error {
            background: rgba(224,122,95,0.12);
            border: 2px solid var(--secondary);
            border-radius: 12px;
            padding: 10px 14px;
            font-family: 'Kalam', cursive;
            font-size: 0.85rem;
            color: var(--txt);
            font-weight: 700;
            margin-bottom: 16px;
        }

        .mob-footer {
            text-align: center;
            padding: 20px 24px 32px;
            font-family: 'Kalam', cursive;
            font-size: 0.78rem;
            color: var(--muted);
        }

        /* Form panels */
        .mob-panel { display: none; }
        .mob-panel.active { display: block; }
    </style>
</head>
<body>

<!-- Background Decorations -->
<svg class="scribble" style="top: 10%; left: 5%; width: 150px" viewBox="0 0 100 100">
    <path fill="none" stroke="var(--txt)" stroke-width="2" d="M10 50 Q 30 20 50 50 T 90 50" />
</svg>
<svg class="scribble" style="bottom: 10%; right: 5%; width: 200px" viewBox="0 0 100 100">
    <path fill="none" stroke="var(--secondary)" stroke-width="2" d="M10 80 Q 40 10 90 80" />
</svg>

<?php
$session = session();
$flashError = $session->getFlashdata('error');
$flashLoginType = $session->getFlashdata('login_type');
?>

<div class="container <?= ($flashLoginType === 'karyawan') ? 'right-panel-active' : '' ?>" id="container">
    
    <!-- ADMIN LOGIN (Sign In / Default Left) -->
    <div class="form-container sign-in-container">
        <form action="<?= base_url('login') ?>" method="POST" class="h-full flex flex-col justify-center items-center text-center">
            <?= csrf_field() ?>
            <input type="hidden" name="login_type" value="admin">
            <h1>Sign in Admin</h1>
            
            <?php if ($flashError && $flashLoginType !== 'karyawan'): ?>
            <div class="text-xs mb-4 p-3 w-full organic-shape" style="background:rgba(224,122,95,0.15); color:var(--txt); border: 2px solid var(--secondary); font-family: 'Kalam', cursive; font-weight: bold; font-size: 14px">
                <?= $flashError ?>
            </div>
            <?php endif; ?>

            <input type="text" name="username" class="ni" placeholder="Username" required value="<?= old('username') ?>" />
            <input type="password" name="password" class="ni" placeholder="Password" required />
            <button type="submit" class="btn-custom" style="background: var(--primary)">Masuk</button>
        </form>
    </div>

    <!-- KARYAWAN LOGIN (Sign Up / Hidden Left) -->
    <div class="form-container sign-up-container">
        <form action="<?= base_url('login') ?>" method="POST" class="h-full flex flex-col justify-center items-center text-center">
            <?= csrf_field() ?>
            <input type="hidden" name="login_type" value="karyawan">
            <h1>Sign in Karyawan</h1>
            
            <?php if ($flashError && $flashLoginType === 'karyawan'): ?>
            <div class="text-xs mb-4 p-3 w-full organic-shape" style="background:rgba(224,122,95,0.15); color:var(--txt); border: 2px solid var(--secondary); font-family: 'Kalam', cursive; font-weight: bold; font-size: 14px">
                <?= $flashError ?>
            </div>
            <?php endif; ?>

            <input type="text" name="username" class="ni" placeholder="Username" required value="<?= old('username') ?>" />
            <input type="password" name="password" class="ni" placeholder="Password" required />
            <button type="submit" class="btn-custom" style="background: var(--secondary)">Masuk</button>
        </form>
    </div>

    <!-- OVERLAY PANEL -->
    <div class="overlay-container">
        <div class="overlay">
            
            <!-- Left Overlay (Shown when Karyawan form is active) -->
            <div class="overlay-panel overlay-left">
                <h1>Selamat Datang!</h1>
                <p>Masuk sebagai Administrator untuk mengelola seluruh dokumen dan arsip digital.</p>
                <button class="btn-custom ghost" id="signIn">Sign In Admin</button>
            </div>
            
            <!-- Right Overlay (Shown when Admin form is active) -->
            <div class="overlay-panel overlay-right">
                <h1>Halo, Karyawan!</h1>
                <p>Masuk menggunakan akun Karyawan Anda untuk mencari dokumen dan mengajukan izin akses.</p>
                <button class="btn-custom ghost" id="signUp">Sign In Karyawan</button>
            </div>
            
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════
     MOBILE LOGIN LAYOUT (only shown on ≤640px)
     ═══════════════════════════════════════════════ -->
<div class="mobile-login-wrap">

    <!-- Header Banner -->
    <div class="mob-header">
        <div class="mob-header-logo">
            <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
            </svg>
        </div>
        <h1>Workspace DMS</h1>
        <p>Kelola Dokumen Digital Perusahaan</p>
    </div>

    <!-- Tab Switcher -->
    <div class="mob-tabs">
        <button class="mob-tab <?= ($flashLoginType !== 'karyawan') ? 'active' : '' ?>" id="mobTabAdmin">🛡️ Admin</button>
        <button class="mob-tab <?= ($flashLoginType === 'karyawan') ? 'active' : '' ?>" id="mobTabKaryawan">👤 Karyawan</button>
    </div>

    <!-- Form Card -->
    <div class="mob-form-card">

        <!-- Admin Panel -->
        <div class="mob-panel <?= ($flashLoginType !== 'karyawan') ? 'active' : '' ?>" id="mobPanelAdmin">
            <h2>Masuk sebagai Admin</h2>
            <p class="mob-subtitle">Kelola dokumen dan pengaturan sistem</p>

            <?php if ($flashError && $flashLoginType !== 'karyawan'): ?>
            <div class="mob-error">⚠️ <?= $flashError ?></div>
            <?php endif; ?>

            <form action="<?= base_url('login') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="login_type" value="admin">
                <input type="text"     name="username" class="mob-input" placeholder="Username" required value="<?= old('username') ?>">
                <input type="password" name="password" class="mob-input" placeholder="Password" required>
                <button type="submit" class="mob-btn" id="mobFormBtn">Masuk →</button>
            </form>
        </div>

        <!-- Karyawan Panel -->
        <div class="mob-panel <?= ($flashLoginType === 'karyawan') ? 'active' : '' ?>" id="mobPanelKaryawan">
            <h2>Masuk sebagai Karyawan</h2>
            <p class="mob-subtitle">Cari dokumen dan ajukan izin akses</p>

            <?php if ($flashError && $flashLoginType === 'karyawan'): ?>
            <div class="mob-error">⚠️ <?= $flashError ?></div>
            <?php endif; ?>

            <form action="<?= base_url('login') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="login_type" value="karyawan">
                <input type="text"     name="username" class="mob-input" placeholder="Username" required value="<?= old('username') ?>">
                <input type="password" name="password" class="mob-input" placeholder="Password" required>
                <button type="submit" class="mob-btn karyawan">Masuk →</button>
            </form>
        </div>

    </div>

    <div class="mob-footer">
        © <?= date('Y') ?> Workspace DMS. All rights reserved.
    </div>
</div>

<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });

    // Entrance Animation
    document.addEventListener('DOMContentLoaded', () => {
        gsap.from('#container', { y: 40, opacity: 0, duration: 1, ease: 'back.out(1.2)' });
        gsap.from('.scribble', { opacity: 0, duration: 2, delay: 0.5 });
    });

    // ─── MOBILE TAB TOGGLE ───
    const mobTabAdmin    = document.getElementById('mobTabAdmin');
    const mobTabKaryawan = document.getElementById('mobTabKaryawan');
    const mobPanelAdmin    = document.getElementById('mobPanelAdmin');
    const mobPanelKaryawan = document.getElementById('mobPanelKaryawan');
    const mobFormBtn = document.getElementById('mobFormBtn');

    function activateMobileTab(role) {
        if (role === 'admin') {
            mobTabAdmin.classList.add('active');
            mobTabKaryawan.classList.remove('active');
            mobPanelAdmin.classList.add('active');
            mobPanelKaryawan.classList.remove('active');
            if (mobFormBtn) { mobFormBtn.classList.remove('karyawan'); }
        } else {
            mobTabKaryawan.classList.add('active');
            mobTabAdmin.classList.remove('active');
            mobPanelKaryawan.classList.add('active');
            mobPanelAdmin.classList.remove('active');
            if (mobFormBtn) { mobFormBtn.classList.add('karyawan'); }
        }
    }

    if (mobTabAdmin)    mobTabAdmin.addEventListener('click',    () => activateMobileTab('admin'));
    if (mobTabKaryawan) mobTabKaryawan.addEventListener('click', () => activateMobileTab('karyawan'));

    // If returning from flash error on karyawan, activate that tab automatically
    <?php if ($flashLoginType === 'karyawan'): ?>
    document.addEventListener('DOMContentLoaded', () => activateMobileTab('karyawan'));
    <?php endif; ?>
</script>

</body>
</html>
