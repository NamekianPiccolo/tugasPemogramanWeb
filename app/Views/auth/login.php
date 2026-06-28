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

        /* ════════════════════════════════════════════
           PREMIUM MOBILE LOGIN  (Android / ≤640px)
           ════════════════════════════════════════════ */
        @media (max-width: 640px) {
            .container, .scribble { display: none !important; }
            .mobile-login-wrap    { display: flex !important; }
            body { overflow: auto; align-items: flex-start; padding: 0; background: #1a1c2c; }
        }

        /* ── Wrapper ── */
        .mobile-login-wrap {
            display: none;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
            background: #1a1c2c;
            position: relative;
            overflow: hidden;
        }

        /* ── Animated gradient orbs ── */
        .mob-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            pointer-events: none;
            opacity: 0;
            animation: orbPulse 6s ease-in-out infinite;
        }
        .mob-orb-1 { width: 280px; height: 280px; background: rgba(132,169,140,0.35); top: -80px; left: -80px; animation-delay: 0s; }
        .mob-orb-2 { width: 220px; height: 220px; background: rgba(224,122,95,0.25);  top: 60px;  right:-60px; animation-delay: 2s; }
        .mob-orb-3 { width: 180px; height: 180px; background: rgba(132,169,140,0.2);  bottom:60px;left:20px;   animation-delay: 4s; }

        @keyframes orbPulse {
            0%,100% { opacity: 0.6; transform: scale(1); }
            50%      { opacity: 1;   transform: scale(1.12); }
        }

        /* ── Floating dots canvas ── */
        #mobParticles {
            position: absolute; inset: 0;
            pointer-events: none; z-index: 0;
        }

        /* ── Hero section ── */
        .mob-hero {
            position: relative; z-index: 2;
            padding: 56px 28px 0;
            text-align: center;
        }

        .mob-logo-ring {
            width: 72px; height: 72px;
            margin: 0 auto 20px;
            position: relative;
            display: flex; align-items: center; justify-content: center;
        }

        .mob-logo-ring::before {
            content: '';
            position: absolute; inset: 0;
            border-radius: 50%;
            border: 2px solid rgba(132,169,140,0.5);
            animation: ringPulse 2.5s ease-in-out infinite;
        }

        .mob-logo-ring::after {
            content: '';
            position: absolute; inset: -10px;
            border-radius: 50%;
            border: 1.5px solid rgba(132,169,140,0.2);
            animation: ringPulse 2.5s ease-in-out infinite 0.5s;
        }

        @keyframes ringPulse {
            0%,100% { transform: scale(1);   opacity: 1; }
            50%      { transform: scale(1.12); opacity: 0.5; }
        }

        .mob-logo-inner {
            width: 54px; height: 54px;
            background: linear-gradient(135deg, #84a98c, #52796f);
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 24px rgba(132,169,140,0.4);
        }

        .mob-logo-inner svg { color: white; }

        .mob-hero-title {
            font-family: 'Kalam', cursive;
            font-size: 1.9rem;
            font-weight: 700;
            color: #fffcf2;
            margin: 0 0 8px;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 20px rgba(132,169,140,0.4);
        }

        .mob-hero-sub {
            font-family: 'Kalam', cursive;
            font-size: 0.88rem;
            color: rgba(255,252,242,0.5);
            margin: 0 0 40px;
        }

        /* ── Card ── */
        .mob-card {
            position: relative; z-index: 2;
            margin: 0 16px 24px;
            background: rgba(255, 252, 242, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1.5px solid rgba(255,252,242,0.1);
            border-radius: 28px;
            padding: 28px 22px 32px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.08);
            overflow: hidden;
        }

        /* Shimmer sweep on card */
        .mob-card::before {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.04), transparent);
            animation: cardShimmer 4s ease-in-out infinite;
        }
        @keyframes cardShimmer {
            0%   { left: -100%; }
            60%,100% { left: 160%; }
        }

        /* ── Role pill tabs ── */
        .mob-pill-bar {
            display: flex;
            background: rgba(255,252,242,0.06);
            border: 1.5px solid rgba(255,252,242,0.1);
            border-radius: 50px;
            padding: 4px;
            margin-bottom: 28px;
            position: relative;
        }

        .mob-pill {
            flex: 1;
            padding: 10px 8px;
            text-align: center;
            font-family: 'Kalam', cursive;
            font-size: 0.9rem;
            font-weight: 700;
            color: rgba(255,252,242,0.5);
            background: transparent;
            border: none;
            border-radius: 46px;
            cursor: pointer;
            transition: color 0.3s ease;
            position: relative; z-index: 2;
            letter-spacing: 0.3px;
        }

        .mob-pill.active { color: #1a1c2c; }

        /* Sliding active background */
        .mob-pill-slider {
            position: absolute;
            top: 4px; bottom: 4px;
            width: calc(50% - 4px);
            left: 4px;
            border-radius: 46px;
            background: linear-gradient(135deg, #84a98c, #52796f);
            box-shadow: 0 4px 16px rgba(132,169,140,0.4);
            transition: left 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                        background 0.35s ease;
            z-index: 1;
        }
        .mob-pill-slider.karyawan {
            left: calc(50%);
            background: linear-gradient(135deg, #e07a5f, #c45c3d);
            box-shadow: 0 4px 16px rgba(224,122,95,0.4);
        }

        /* ── Floating label inputs ── */
        .mob-field {
            position: relative;
            margin-bottom: 18px;
        }

        .mob-field-icon {
            position: absolute;
            left: 16px;
            top: 50%; transform: translateY(-50%);
            color: rgba(255,252,242,0.3);
            pointer-events: none;
            transition: color 0.2s;
        }

        .mob-field-input {
            width: 100%;
            background: rgba(255,252,242,0.06);
            border: 1.5px solid rgba(255,252,242,0.1);
            border-radius: 14px;
            padding: 16px 16px 16px 44px;
            font-family: 'Kalam', cursive;
            font-size: 1rem;
            color: #fffcf2;
            outline: none;
            transition: all 0.25s ease;
            -webkit-appearance: none;
            appearance: none;
        }

        .mob-field-input::placeholder {
            color: rgba(255,252,242,0.3);
            font-family: 'Kalam', cursive;
        }

        .mob-field-input:focus {
            background: rgba(255,252,242,0.1);
            border-color: rgba(132,169,140,0.7);
            box-shadow: 0 0 0 3px rgba(132,169,140,0.15);
        }

        .mob-field-input:focus + .mob-field-icon,
        .mob-field:focus-within .mob-field-icon {
            color: #84a98c;
        }

        .mob-field-input.karyawan-focus:focus {
            border-color: rgba(224,122,95,0.7);
            box-shadow: 0 0 0 3px rgba(224,122,95,0.15);
        }

        /* ── Submit button ── */
        .mob-submit {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #84a98c, #52796f);
            color: #fffcf2;
            font-family: 'Kalam', cursive;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 6px 24px rgba(132,169,140,0.35);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            margin-top: 8px;
        }

        /* Ripple + shimmer on button */
        .mob-submit::after {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 70%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            animation: btnShimmer 2.5s ease-in-out infinite 1s;
        }
        @keyframes btnShimmer {
            0%   { left: -100%; }
            60%,100% { left: 160%; }
        }

        .mob-submit:active {
            transform: scale(0.97);
            box-shadow: 0 2px 10px rgba(132,169,140,0.3);
        }

        .mob-submit.karyawan {
            background: linear-gradient(135deg, #e07a5f, #c45c3d);
            box-shadow: 0 6px 24px rgba(224,122,95,0.35);
        }

        /* ── Error box ── */
        .mob-error {
            display: flex; align-items: center; gap: 10px;
            background: rgba(224,122,95,0.12);
            border: 1.5px solid rgba(224,122,95,0.35);
            border-radius: 12px;
            padding: 12px 14px;
            margin-bottom: 20px;
            font-family: 'Kalam', cursive;
            font-size: 0.87rem;
            color: #e07a5f;
            font-weight: 700;
            animation: errorShake 0.4s ease;
        }
        @keyframes errorShake {
            0%,100% { transform: translateX(0); }
            20%     { transform: translateX(-6px); }
            40%     { transform: translateX(6px); }
            60%     { transform: translateX(-4px); }
            80%     { transform: translateX(4px); }
        }

        .mob-role-label {
            font-family: 'Kalam', cursive;
            font-size: 1.1rem;
            font-weight: 700;
            color: #fffcf2;
            margin: 0 0 4px;
        }

        .mob-role-sub {
            font-family: 'Kalam', cursive;
            font-size: 0.78rem;
            color: rgba(255,252,242,0.4);
            margin: 0 0 22px;
        }

        /* ── Footer ── */
        .mob-footer {
            position: relative; z-index: 2;
            text-align: center;
            padding: 8px 24px 36px;
            font-family: 'Kalam', cursive;
            font-size: 0.75rem;
            color: rgba(255,252,242,0.25);
        }

        /* ── Panel switch ── */
        .mob-panel { display: none; }
        .mob-panel.active { display: block; animation: panelFadeUp 0.35s ease; }
        @keyframes panelFadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
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

<!-- ════════════════════════════════════════════════════
     PREMIUM MOBILE LOGIN  (only shown on ≤640px)
     ════════════════════════════════════════════════════ -->
<div class="mobile-login-wrap" id="mobileLoginWrap">

    <!-- Ambient orbs -->
    <div class="mob-orb mob-orb-1"></div>
    <div class="mob-orb mob-orb-2"></div>
    <div class="mob-orb mob-orb-3"></div>
    <canvas id="mobParticles"></canvas>

    <!-- Hero -->
    <div class="mob-hero" id="mobHero">
        <div class="mob-logo-ring" id="mobLogo">
            <div class="mob-logo-inner">
                <svg width="26" height="26" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
        <div class="mob-hero-title">Workspace DMS</div>
        <div class="mob-hero-sub">Kelola Dokumen Digital Perusahaan</div>
    </div>

    <!-- Card -->
    <div class="mob-card" id="mobCard">

        <!-- Pill tab bar -->
        <div class="mob-pill-bar">
            <div class="mob-pill-slider" id="mobSlider"></div>
            <button class="mob-pill <?= ($flashLoginType !== 'karyawan') ? 'active' : '' ?>" id="mobPillAdmin">
                🛡️ Admin
            </button>
            <button class="mob-pill <?= ($flashLoginType === 'karyawan') ? 'active' : '' ?>" id="mobPillKaryawan">
                👤 Karyawan
            </button>
        </div>

        <!-- Admin panel -->
        <div class="mob-panel <?= ($flashLoginType !== 'karyawan') ? 'active' : '' ?>" id="mobPanelAdmin">
            <div class="mob-role-label">Selamat datang, Admin 👋</div>
            <div class="mob-role-sub">Masuk untuk mengelola dokumen &amp; sistem</div>

            <?php if ($flashError && $flashLoginType !== 'karyawan'): ?>
            <div class="mob-error">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <?= $flashError ?>
            </div>
            <?php endif; ?>

            <form action="<?= base_url('login') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="login_type" value="admin">

                <div class="mob-field">
                    <input type="text" name="username" class="mob-field-input" placeholder="Username" required
                           value="<?= old('username') ?>" autocomplete="username">
                    <span class="mob-field-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </span>
                </div>

                <div class="mob-field">
                    <input type="password" name="password" class="mob-field-input" placeholder="Password" required
                           autocomplete="current-password">
                    <span class="mob-field-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </span>
                </div>

                <button type="submit" class="mob-submit" id="mobBtnAdmin">
                    Masuk sebagai Admin &nbsp;→
                </button>
            </form>
        </div>

        <!-- Karyawan panel -->
        <div class="mob-panel <?= ($flashLoginType === 'karyawan') ? 'active' : '' ?>" id="mobPanelKaryawan">
            <div class="mob-role-label">Halo, Karyawan 👋</div>
            <div class="mob-role-sub">Cari dokumen &amp; ajukan izin akses</div>

            <?php if ($flashError && $flashLoginType === 'karyawan'): ?>
            <div class="mob-error">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <?= $flashError ?>
            </div>
            <?php endif; ?>

            <form action="<?= base_url('login') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="login_type" value="karyawan">

                <div class="mob-field">
                    <input type="text" name="username" class="mob-field-input karyawan-focus" placeholder="Username" required
                           value="<?= old('username') ?>" autocomplete="username">
                    <span class="mob-field-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </span>
                </div>

                <div class="mob-field">
                    <input type="password" name="password" class="mob-field-input karyawan-focus" placeholder="Password" required
                           autocomplete="current-password">
                    <span class="mob-field-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </span>
                </div>

                <button type="submit" class="mob-submit karyawan">
                    Masuk sebagai Karyawan &nbsp;→
                </button>
            </form>
        </div>

    </div><!-- /mob-card -->

    <div class="mob-footer">© <?= date('Y') ?> Workspace DMS · All rights reserved</div>

</div><!-- /mobile-login-wrap -->

<script>
    // ─── Desktop panel toggle ───
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container    = document.getElementById('container');
    if (signUpButton) signUpButton.addEventListener('click', () => container.classList.add('right-panel-active'));
    if (signInButton) signInButton.addEventListener('click', () => container.classList.remove('right-panel-active'));

    document.addEventListener('DOMContentLoaded', () => {
        // Desktop entrance
        if (typeof gsap !== 'undefined') {
            gsap.from('#container', { y: 40, opacity: 0, duration: 1, ease: 'back.out(1.2)' });
            gsap.from('.scribble',  { opacity: 0, duration: 2, delay: 0.5 });
        }

        // Only run mobile code on small screens
        if (window.innerWidth > 640) return;

        // ── GSAP entrance sequence ──
        if (typeof gsap !== 'undefined') {
            const tl = gsap.timeline({ defaults: { ease: 'back.out(1.4)' }});
            tl.from('#mobLogo',  { scale: 0,   opacity: 0, duration: 0.6 })
              .from('.mob-hero-title', { y: 20,  opacity: 0, duration: 0.5 }, '-=0.2')
              .from('.mob-hero-sub',   { y: 15,  opacity: 0, duration: 0.4 }, '-=0.3')
              .from('#mobCard',  { y: 40,  opacity: 0, duration: 0.6, ease: 'back.out(1.2)' }, '-=0.2')
              .from('.mob-pill-bar', { scaleX: 0.8, opacity: 0, duration: 0.4 }, '-=0.3')
              .from('.mob-role-label, .mob-role-sub', { x: -20, opacity: 0, duration: 0.4, stagger: 0.1 }, '-=0.2')
              .from('.mob-field', { y: 15, opacity: 0, duration: 0.35, stagger: 0.12 }, '-=0.2')
              .from('.mob-submit', { scale: 0.9, opacity: 0, duration: 0.4 }, '-=0.1')
              .from('.mob-footer', { opacity: 0, duration: 0.4 }, '-=0.1');
        }

        // ── Particle canvas ──
        const canvas = document.getElementById('mobParticles');
        if (canvas) {
            const ctx = canvas.getContext('2d');
            canvas.width  = window.innerWidth;
            canvas.height = window.innerHeight;
            const dots = Array.from({ length: 35 }, () => ({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                r: Math.random() * 1.5 + 0.5,
                vx: (Math.random() - 0.5) * 0.3,
                vy: (Math.random() - 0.5) * 0.3,
                a: Math.random() * 0.4 + 0.1
            }));
            function drawParticles() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                dots.forEach(d => {
                    d.x += d.vx; d.y += d.vy;
                    if (d.x < 0) d.x = canvas.width;
                    if (d.x > canvas.width) d.x = 0;
                    if (d.y < 0) d.y = canvas.height;
                    if (d.y > canvas.height) d.y = 0;
                    ctx.beginPath();
                    ctx.arc(d.x, d.y, d.r, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(132,169,140,${d.a})`;
                    ctx.fill();
                });
                requestAnimationFrame(drawParticles);
            }
            drawParticles();
        }

        // ── Pill tab logic ──
        const pillAdmin    = document.getElementById('mobPillAdmin');
        const pillKaryawan = document.getElementById('mobPillKaryawan');
        const panelAdmin    = document.getElementById('mobPanelAdmin');
        const panelKaryawan = document.getElementById('mobPanelKaryawan');
        const slider        = document.getElementById('mobSlider');

        function switchTab(role) {
            const isAdmin = role === 'admin';
            pillAdmin.classList.toggle('active', isAdmin);
            pillKaryawan.classList.toggle('active', !isAdmin);
            panelAdmin.classList.toggle('active', isAdmin);
            panelKaryawan.classList.toggle('active', !isAdmin);
            slider.classList.toggle('karyawan', !isAdmin);

            // Micro-bounce on card
            if (typeof gsap !== 'undefined') {
                gsap.fromTo('#mobCard', { scale: 0.98 }, { scale: 1, duration: 0.35, ease: 'back.out(1.8)' });
            }
        }

        if (pillAdmin)    pillAdmin.addEventListener('click',    () => switchTab('admin'));
        if (pillKaryawan) pillKaryawan.addEventListener('click', () => switchTab('karyawan'));

        <?php if ($flashLoginType === 'karyawan'): ?>
        switchTab('karyawan');
        <?php endif; ?>
    });
</script>

</body>
</html>
