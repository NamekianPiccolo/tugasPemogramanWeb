<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Workspace DMS' ?></title>
    <!-- Organic Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Kalam:wght@400;700&family=Lora:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <style>
        /* ================================================
           ORGANIC NATURE (E-INK) DESIGN SYSTEM
           ================================================ */
        :root {
            /* Warm Earth Palette */
            --bg:       #f5f0e6; /* Warm paper beige */
            --surface:  #fffcf2; /* Lighter paper */
            --primary:  #84a98c; /* Sage green */
            --secondary:#e07a5f; /* Soft Terracotta */
            --txt:      #3d405b; /* Deep charcoal blue (ink) */
            --muted:    #8a817c; /* Warm gray */
            --dim:      #b5b0a1; /* Light warm gray */
        }

        *, *::before, *::after { box-sizing: border-box; }

        body, html {
            margin: 0; padding: 0; height: 100%; overflow: hidden;
            background-color: var(--bg);
            /* SVG Paper Texture Overlay */
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E");
            color: var(--txt);
            font-family: 'Lora', serif; /* Changed to Lora for organic journal feel */
        }

        h1, h2, h3, h4, h5, .font-kalam {
            font-family: 'Kalam', cursive;
            letter-spacing: 0.5px;
        }

        /* ───────── ORGANIC BORDERS & SHADOWS ───────── */
        .organic-shape {
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
            border: 2px solid var(--txt);
        }
        .organic-shadow {
            box-shadow: 4px 4px 0px rgba(61, 64, 91, 0.2);
        }

        /* ───────── SIDEBAR ───────── */
        .sidebar-container {
            background: var(--surface);
            border-right: 2px solid var(--txt);
            transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1), transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        /* Hand-drawn divider line */
        .sidebar-container::after {
            content: ''; position: absolute; top: 0; right: -4px; height: 100%; width: 2px;
            background: var(--txt); opacity: 0.2;
            border-radius: 50% 50% 50% 50% / 10% 90% 10% 90%;
        }
        
        .nav-item {
            position: relative; border-radius: 8px;
            color: rgba(61, 64, 91, 0.8); /* Darker text for better readability */
            transition: all 0.2s ease;
            font-family: 'Kalam', cursive; font-weight: 700; font-size: 16px; letter-spacing: 0.5px;
            border: 2px solid transparent;
        }
        .nav-item:hover {
            color: var(--txt);
            transform: translateX(4px) rotate(-1deg);
            background: rgba(132, 169, 140, 0.08);
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
            border: 2px solid var(--txt);
            box-shadow: 4px 4px 0px rgba(61, 64, 91, 0.2);
        }
        .nav-item.active {
            background: rgba(132, 169, 140, 0.15); /* Sage green tint */
            color: var(--txt);
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
            border: 2px solid var(--txt);
            box-shadow: 4px 4px 0px rgba(61, 64, 91, 0.2);
        }

        /* ───────── GLASS CARD -> PAPER CARD ───────── */
        .glass-card {
            background: var(--surface);
            border: 1.5px solid var(--txt);
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
            box-shadow: 3px 3px 0px rgba(61, 64, 91, 0.15);
            transition: all 0.3s ease;
            position: relative;
        }
        .glass-card::before {
            content: ''; position: absolute; inset: 2px; border: 1px solid rgba(61, 64, 91, 0.1);
            border-radius: 15px 255px 15px 225px / 255px 15px 225px 15px; pointer-events: none;
        }
        .glass-card:hover {
            box-shadow: 8px 8px 0px rgba(61, 64, 91, 0.2);
            transform: translateY(-5px) rotate(1.5deg) scale(1.02);
            z-index: 10; /* Bring forward so shadow doesn't clip */
        }

        /* ───────── HEADER ───────── */
        .header-glass {
            background: rgba(255, 252, 242, 0.9);
            backdrop-filter: blur(8px);
            border-bottom: 2px solid rgba(61, 64, 91, 0.1);
        }

        /* ───────── SCROLLBAR (Pencil style) ───────── */
        .ws-scroll { flex:1; overflow-y:auto; padding:32px; }
        .ws-scroll::-webkit-scrollbar { width:8px; }
        .ws-scroll::-webkit-scrollbar-track { background:transparent; }
        .ws-scroll::-webkit-scrollbar-thumb { background:var(--dim); border-radius:10px; border: 2px solid var(--bg); }
        .ws-scroll::-webkit-scrollbar-thumb:hover { background:var(--muted); }

        /* ───────── SIDEBAR SCROLLBAR ───────── */
        .nav-scroll::-webkit-scrollbar { width:4px; }
        .nav-scroll::-webkit-scrollbar-track { background:transparent; }
        .nav-scroll::-webkit-scrollbar-thumb { background:rgba(61,64,91,0.2); border-radius:4px; }
        .nav-scroll::-webkit-scrollbar-thumb:hover { background:rgba(61,64,91,0.4); }

        /* ───────── TYPOGRAPHY & COMPONENTS ───────── */
        .grad-violet {
            color: var(--secondary); /* Replaced gradient with Terracotta */
        }
        
        .btn-violet {
            background: var(--primary); /* Replaced with Sage Green */
            border: 2px solid var(--txt); color: #fffcf2;
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px;
            box-shadow: 3px 3px 0px var(--txt);
            transition: all 0.2s ease;
            font-family: 'Kalam', cursive;
            font-size: 16px; letter-spacing: 1px;
        }
        .btn-violet:hover {
            background: #73967b;
            transform: translate(-1px, -1px);
            box-shadow: 4px 4px 0px var(--txt);
        }
        
        .glass-input {
            background: var(--surface); border: 2px solid var(--muted); color:var(--txt);
            border-radius: 255px 15px 225px 15px / 15px 225px 15px 255px; 
            transition: all 0.2s ease;
            font-family: 'Lora', serif;
        }
        .glass-input:focus {
            outline:none; border-color:var(--txt);
            box-shadow: 3px 3px 0px rgba(61, 64, 91, 0.15);
            background: #ffffff;
        }

        /* ───────── BADGES (Hand-drawn tags) ───────── */
        .badge-ok  { background:rgba(132,169,140,0.2); color:#4a7c59; border:1px solid #4a7c59; border-radius: 255px 15px 225px 15px/15px 225px 15px 255px; padding:2px 8px; font-family:'Kalam',cursive; }
        .badge-err { background:rgba(224,122,95,0.2); color:#c44536; border:1px solid #c44536; border-radius: 255px 15px 225px 15px/15px 225px 15px 255px; padding:2px 8px; font-family:'Kalam',cursive; }
        .badge-wrn { background:rgba(242,204,143,0.2); color:#d97706; border:1px solid #d97706; border-radius: 255px 15px 225px 15px/15px 225px 15px 255px; padding:2px 8px; font-family:'Kalam',cursive; }
        .badge-vio { background:rgba(224,122,95,0.15); color:var(--secondary); border:1px solid var(--secondary); border-radius: 255px 15px 225px 15px/15px 225px 15px 255px; padding:2px 8px; font-family:'Kalam',cursive; }

    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body class="antialiased w-full h-full flex flex-row">

<!-- ══════════════ SIDEBAR ══════════════ -->
<aside id="sidebarEl" class="sidebar-container w-[280px] h-full z-20 flex flex-col justify-between p-6 shrink-0 overflow-y-auto overflow-x-hidden nav-scroll">
    
    <div class="flex-1 flex flex-col">
        <!-- Logo -->
        <div class="flex items-center space-x-3 px-2 mb-10 mt-2 shrink-0">
            <div class="w-10 h-10 flex items-center justify-center text-white organic-shape"
                 style="background:var(--secondary); border:2px solid var(--txt); box-shadow: 2px 2px 0px var(--txt);">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
            </div>
            <div>
                <span class="font-bold text-lg tracking-tight font-kalam">Workspace DMS</span>
                <div class="text-[10px] uppercase tracking-widest font-bold text-gray-500 mt-0.5" style="font-family:'Plus Jakarta Sans',sans-serif;">Organic Edition</div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="space-y-8 flex-1 pr-2">
            <!-- Workspace section -->
            <div>
                <div class="px-2 mb-3 text-[11px] font-bold uppercase tracking-widest text-gray-500 font-kalam">Main Menu</div>
                <nav class="space-y-1.5">
                    <?php $role = session()->get('role') ?? 'admin'; ?>

                    <a href="<?= base_url("$role/dashboard") ?>"
                       class="nav-item flex items-center px-4 py-2.5 <?= strpos(current_url(),'dashboard')!==false?'active':'' ?>">
                        <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>

                    <a href="<?= base_url("$role/dokumen") ?>"
                       class="nav-item flex items-center px-4 py-2.5 <?= strpos(current_url(),'dokumen')!==false?'active':'' ?>">
                        <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Dokumen Explorer
                    </a>

                    <?php if ($role === 'admin'): ?>
                    <a href="<?= base_url('admin/kategori') ?>"
                       class="nav-item flex items-center px-4 py-2.5 <?= strpos(current_url(),'kategori')!==false?'active':'' ?>">
                        <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        Kategori Dokumen
                    </a>

                    <a href="<?= base_url('admin/unit') ?>"
                       class="nav-item flex items-center px-4 py-2.5 <?= strpos(current_url(),'/unit')!==false?'active':'' ?>">
                        <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                        Unit Kerja
                    </a>

                    <a href="<?= base_url('admin/user') ?>"
                       class="nav-item flex items-center px-4 py-2.5 <?= strpos(current_url(),'/user')!==false?'active':'' ?>">
                        <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Manajemen User
                    </a>
                    <?php endif; ?>
                </nav>
            </div>

            <!-- Workflow section -->
            <div>
                <div class="px-2 mb-3 text-[11px] font-bold uppercase tracking-widest text-gray-500 font-kalam">Workflow</div>
                <nav class="space-y-1.5">
                    <a href="<?= base_url("$role/distribusi") ?>"
                       class="nav-item flex items-center px-4 py-2.5 <?= strpos(current_url(),'distribusi')!==false?'active':'' ?>">
                        <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                        Distribusi Berkas
                    </a>

                    <a href="<?= base_url("$role/izin") ?>"
                       class="nav-item flex items-center px-4 py-2.5 <?= strpos(current_url(),'izin')!==false?'active':'' ?>">
                        <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Izin Akses
                    </a>

                    <?php if ($role === 'admin'): ?>
                    <a href="<?= base_url('admin/revisi') ?>"
                       class="nav-item flex items-center px-4 py-2.5 <?= strpos(current_url(),'revisi')!==false?'active':'' ?>">
                        <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Revisi Dokumen
                    </a>

                    <a href="<?= base_url('admin/riwayat') ?>"
                       class="nav-item flex items-center px-4 py-2.5 <?= strpos(current_url(),'riwayat')!==false?'active':'' ?>">
                        <svg class="w-5 h-5 mr-3 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Riwayat Aktivitas
                    </a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </div>

    <!-- User card -->
    <div class="mt-6 bg-[#fffcf2] border-2 border-[var(--txt)] p-3 relative organic-shape organic-shadow shrink-0">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2 min-w-0">
                <div class="w-9 h-9 flex items-center justify-center text-xs font-bold text-white shrink-0 organic-shape"
                     style="background:var(--primary); border: 2px solid var(--txt);">
                    <?= strtoupper(substr(session()->get('nama_lengkap') ?? 'US',0,2)) ?>
                </div>
                <div class="min-w-0 pr-2">
                    <p class="text-xs font-bold text-gray-800 truncate font-kalam leading-tight"><?= esc(session()->get('nama_lengkap') ?? 'Pengguna') ?></p>
                    <p class="text-[10px] text-gray-500 truncate capitalize" style="font-family:'Lora',serif;"><?= esc($role) ?></p>
                </div>
            </div>
            <a href="<?= base_url('/logout') ?>"
               class="w-8 h-8 ml-2 shrink-0 organic-shape bg-white border-2 border-[var(--txt)] flex items-center justify-center text-gray-600 hover:bg-[var(--secondary)] hover:text-white transition-all duration-200"
               title="Logout">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </a>
        </div>
    </div>
</aside>

<!-- ══════════════ WORKSPACE ══════════════ -->
<div id="workspaceEl" class="flex-1 h-full flex flex-col z-10 relative bg-transparent overflow-hidden">

    <!-- HEADER -->
    <header class="header-glass h-[72px] px-8 flex items-center justify-between shrink-0 z-20">
        <div class="flex items-center space-x-4">
            <!-- Toggle btn -->
            <button id="sidebarToggleBtn" title="Toggle Sidebar" class="w-10 h-10 organic-shape bg-white flex items-center justify-center text-[var(--txt)] hover:bg-[var(--primary)] hover:text-white transition-all duration-200">
                <svg id="toggleIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <!-- Breadcrumb -->
            <div class="flex items-center text-sm font-bold text-gray-500 font-kalam">
                <span>Journal</span>
                <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
                <span id="headerTitle" class="text-[var(--txt)]"><?= $title ?? 'Halaman' ?></span>
            </div>
        </div>

        <!-- Notification bell -->
        <button class="w-10 h-10 organic-shape flex items-center justify-center bg-white text-[var(--txt)] hover:bg-[var(--secondary)] hover:text-white transition-all duration-200 relative">
            <div class="absolute top-1.5 right-1.5 w-2.5 h-2.5 rounded-full border-2 border-white"
                 style="background:var(--secondary);"></div>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
        </button>
    </header>

    <!-- CONTENT -->
    <main class="ws-scroll" id="contentArea">
        <div class="max-w-7xl mx-auto pb-12">
            <?= $this->renderSection('content') ?>
        </div>
    </main>
</div>

<!-- ══════════════ GLOBAL CONFIRM MODAL ══════════════ -->
<div id="organicConfirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 9999; background: rgba(61, 64, 91, 0.6); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); justify-content: center; align-items: center;">
    <div id="organicConfirmContent" class="p-6 md:p-8 organic-shape transition-all duration-300 opacity-0" style="background-color: var(--surface); width: 90%; max-width: 24rem; border: 3px solid var(--txt); box-shadow: 6px 6px 0px var(--txt); transform: scale(0.95);">
        <h3 id="organicConfirmTitle" class="text-2xl font-bold font-kalam mb-2" style="color: var(--txt);">Konfirmasi</h3>
        <p id="organicConfirmText" class="text-sm font-lora mb-6" style="color: var(--muted); line-height: 1.6;">Apakah Anda yakin?</p>
        
        <div class="flex space-x-3 justify-end">
            <button id="organicConfirmBtnCancel" class="organic-shape px-4 py-2 font-kalam font-bold text-sm bg-transparent cursor-pointer transition-all" style="border: 2px solid var(--txt); color: var(--txt);" onmouseover="this.style.background='rgba(61,64,91,0.05)'" onmouseout="this.style.background='transparent'">
                Batal
            </button>
            <button id="organicConfirmBtnOk" class="organic-shape px-4 py-2 font-kalam font-bold text-sm cursor-pointer transition-all" style="background: var(--primary); border: 2px solid var(--txt); color: #fffcf2; box-shadow: 3px 3px 0px var(--txt);" onmouseover="this.style.transform='translateY(1px)'; this.style.boxShadow='2px 2px 0px var(--txt)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='3px 3px 0px var(--txt)';">
                Ya, Lanjutkan
            </button>
        </div>
    </div>
</div>

<!-- ══════════════ GLOBAL SCRIPTS ══════════════ -->
<script>
(function() {
    'use strict';

    // ─── Sidebar Toggle ───
    let collapsed = false;
    const sidebar    = document.getElementById('sidebarEl');
    const toggleBtn  = document.getElementById('sidebarToggleBtn');
    
    toggleBtn?.addEventListener('click', () => {
        collapsed = !collapsed;
        if (collapsed) {
            sidebar.style.width = '0px';
            sidebar.style.paddingLeft = '0px';
            sidebar.style.paddingRight = '0px';
            sidebar.style.borderRightWidth = '0px';
            sidebar.style.overflow = 'hidden';
            sidebar.style.opacity = '0';
        } else {
            sidebar.style.width = '280px';
            sidebar.style.paddingLeft = '1.5rem';
            sidebar.style.paddingRight = '1.5rem';
            sidebar.style.borderRightWidth = '2px';
            sidebar.style.opacity = '1';
            setTimeout(() => { sidebar.style.overflow = 'visible'; }, 400);
        }
    });

    // ─── PJAX (Smooth Page Loading) ───
    function setupPJAX() {
        document.body.addEventListener('click', e => {
            const link = e.target.closest('a');
            if (!link) return;
            const href = link.getAttribute('href');
            if (href
                && (href.startsWith('<?= base_url('admin') ?>') || href.startsWith('<?= base_url('karyawan') ?>'))
                && !href.includes('delete') && !href.includes('logout')
                && !link.hasAttribute('target')) {
                e.preventDefault();
                loadPage(href);
            }
        });
        window.addEventListener('popstate', e => {
            if (e.state?.url) loadPage(e.state.url, false);
        });
    }

    function loadPage(url, push = true) {
        if(typeof gsap === 'undefined') {
            window.location.href = url;
            return;
        }
        // Organic bounce effect
        gsap.to('#contentArea', {
            opacity: 0, scale: 0.98, rotation: -0.5, duration: 0.25, ease: 'back.in(1.5)',
            onComplete: () => {
                fetch(url).then(r => r.text()).then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    const newContent = doc.getElementById('contentArea');
                    if(newContent) {
                        document.getElementById('contentArea').innerHTML = newContent.innerHTML;
                    }

                    const t = doc.getElementById('headerTitle')?.innerText;
                    if (t) document.getElementById('headerTitle').innerText = t;
                    document.title = doc.title;

                    // Update active nav
                    document.querySelectorAll('.nav-item').forEach(item => {
                        const h = item.getAttribute('href') || '';
                        if (url.includes(h) && h.length > 10) item.classList.add('active');
                        else item.classList.remove('active');
                    });

                    if (push) history.pushState({ url }, doc.title, url);

                    // Re-inject scripts
                    doc.getElementById('contentArea')?.querySelectorAll('script').forEach(s => {
                        const ns = document.createElement('script');
                        ns.text = s.text;
                        document.getElementById('contentArea').appendChild(ns);
                    });

                    // Scroll back to top
                    document.getElementById('contentArea').scrollTop = 0;

                    gsap.fromTo('#contentArea',
                        { opacity: 0, scale: 1.02, rotation: 0.5 },
                        { opacity: 1, scale: 1, rotation: 0, duration: 0.4, ease: 'back.out(1.5)' }
                    );
                }).catch(() => { window.location.href = url; });
            }
        });
    }

    // ─── GLOBAL CONFIRMATION MODAL ───
    window.showConfirm = function(title, text, btnText, btnColor) {
        return new Promise((resolve) => {
            const modal = document.getElementById('organicConfirmModal');
            const content = document.getElementById('organicConfirmContent');
            const titleEl = document.getElementById('organicConfirmTitle');
            const textEl = document.getElementById('organicConfirmText');
            const btnOk = document.getElementById('organicConfirmBtnOk');
            const btnCancel = document.getElementById('organicConfirmBtnCancel');

            titleEl.innerText = title;
            textEl.innerText = text;
            btnOk.innerText = btnText;
            if(btnColor) {
                btnOk.style.background = btnColor;
            }

            modal.style.display = 'flex';
            setTimeout(() => {
                content.style.transform = 'scale(1)';
                content.classList.remove('opacity-0');
                content.classList.add('opacity-100');
            }, 10);

            const close = (result) => {
                content.style.transform = 'scale(0.95)';
                content.classList.remove('opacity-100');
                content.classList.add('opacity-0');
                setTimeout(() => {
                    modal.style.display = 'none';
                    resolve(result);
                }, 300);
                
                btnOk.removeEventListener('click', onOk);
                btnCancel.removeEventListener('click', onCancel);
            };

            const onOk = () => close(true);
            const onCancel = () => close(false);

            btnOk.addEventListener('click', onOk);
            btnCancel.addEventListener('click', onCancel);
        });
    };

    // Intercept all inline confirm() links (like Delete)
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a[onclick*="return confirm"]');
        if (link) {
            e.preventDefault();
            e.stopPropagation(); // Stop default confirm() from firing
            
            const match = link.getAttribute('onclick').match(/confirm\(['"](.*?)['"]\)/);
            const msg = match ? match[1] : 'Apakah Anda yakin ingin menghapus data ini?';
            
            showConfirm('Konfirmasi Hapus', msg, 'Hapus', 'var(--secondary)').then(res => {
                if(res) {
                    link.removeAttribute('onclick'); // prevent loop
                    link.click();
                }
            });
        }
    }, true); // use capture phase

    // Intercept all form submissions (Create / Update / Action)
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.method.toLowerCase() === 'get') return; // Ignore search/filters
        if (form.hasAttribute('data-no-confirm')) return; // Already confirmed
        
        e.preventDefault();
        
        let title = 'Konfirmasi Simpan';
        let text = 'Apakah Anda yakin ingin menyimpan data ini?';
        let btnText = 'Simpan';
        let btnColor = 'var(--primary)';

        // If it's a delete form or "Hapus" button form
        if (form.action.includes('delete') || (form.querySelector('button[type="submit"]') && form.querySelector('button[type="submit"]').innerText.toLowerCase().includes('hapus'))) {
            title = 'Konfirmasi Hapus';
            text = 'Yakin ingin menghapus data ini secara permanen?';
            btnText = 'Hapus';
            btnColor = 'var(--secondary)';
        }

        showConfirm(title, text, btnText, btnColor).then(res => {
            if(res) {
                form.setAttribute('data-no-confirm', 'true');
                form.submit(); // Bypass listener and submit directly
            }
        });
    });

    setupPJAX();
})();
</script>

<?= $this->renderSection('scripts') ?>
</body>
</html>
