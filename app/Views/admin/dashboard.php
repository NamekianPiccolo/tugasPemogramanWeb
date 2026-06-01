<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<?php $role = session()->get('role') ?? 'admin'; ?>

<!-- ─── Welcome Banner (E-Ink Style) ─── -->
<div class="mb-7 page-intro">
    <div class="glass-card p-6 relative overflow-hidden" style="background-image: radial-gradient(circle at top right, rgba(132,169,140,0.1), transparent 50%); border-radius: 255px 15px 225px 15px/15px 225px 15px 255px;">
        <div style="position:relative;z-index:1;">
            <div class="flex items-center space-x-2 mb-2">
                <div class="w-1.5 h-5 organic-shape" style="background:var(--primary);"></div>
                <span class="text-[11px] font-bold uppercase tracking-widest font-kalam" style="color:var(--muted);">Personal Journal</span>
            </div>
            <h1 class="text-3xl font-bold mb-1.5 font-kalam">
                <span style="color:var(--txt);">Selamat Datang, </span>
                <span style="color:var(--secondary); text-decoration: underline wavy var(--primary);"><?= esc(session()->get('nama_lengkap')) ?>!</span>
            </h1>
            <p class="text-sm mt-3" style="color:var(--muted); font-family:'Lora',serif;">
                Masuk sebagai
                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold capitalize badge-vio ml-1 mr-1">
                    <?= esc($role) ?>
                </span>
                — Kelola arsip Anda dengan sentuhan alam yang menenangkan.
            </p>
        </div>
    </div>
</div>

<!-- ─── Metric Cards ─── -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-7 metrics-row">
    <?php if ($role === 'admin'): ?>

        <!-- Card: Total Dokumen -->
        <div class="glass-card p-5 flex items-center justify-between metric-card" style="background-color: #f2e8cf;">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-widest mb-1.5 font-kalam" style="color:var(--txt);">Total Dokumen</p>
                <h3 class="text-4xl font-extrabold font-kalam" style="color:var(--txt);"><?= esc($total_dokumen ?? 0) ?></h3>
                <p class="text-xs mt-1" style="color:var(--muted); font-family:'Lora',serif;">lembar tersimpan</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center shrink-0 organic-shape"
                 style="background:rgba(224,122,95,0.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt);">
                <svg class="w-6 h-6" fill="none" stroke="var(--txt)" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>

        <!-- Card: Total Kategori -->
        <div class="glass-card p-5 flex items-center justify-between metric-card" style="background-color: #d8e2dc;">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-widest mb-1.5 font-kalam" style="color:var(--txt);">Total Kategori</p>
                <h3 class="text-4xl font-extrabold font-kalam" style="color:var(--txt);"><?= esc($total_kategori ?? 0) ?></h3>
                <p class="text-xs mt-1" style="color:var(--muted); font-family:'Lora',serif;">map terorganisir</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center shrink-0 organic-shape"
                 style="background:rgba(132,169,140,0.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt);">
                <svg class="w-6 h-6" fill="none" stroke="var(--txt)" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
        </div>

        <!-- Card: Total Unit Kerja -->
        <div class="glass-card p-5 flex items-center justify-between metric-card" style="background-color: #fae1dd;">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-widest mb-1.5 font-kalam" style="color:var(--txt);">Total Unit Kerja</p>
                <h3 class="text-4xl font-extrabold font-kalam" style="color:var(--txt);"><?= esc($total_unit ?? 0) ?></h3>
                <p class="text-xs mt-1" style="color:var(--muted); font-family:'Lora',serif;">divisi terdaftar</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center shrink-0 organic-shape"
                 style="background:rgba(224,122,95,0.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt);">
                <svg class="w-6 h-6" fill="none" stroke="var(--txt)" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                </svg>
            </div>
        </div>

    <?php else: ?>

        <!-- Card: Total Dokumen -->
        <div class="glass-card p-5 flex items-center justify-between metric-card" style="background-color: #f2e8cf;">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-widest mb-1.5 font-kalam" style="color:var(--txt);">Total Dokumen</p>
                <h3 class="text-4xl font-extrabold font-kalam" style="color:var(--txt);"><?= esc($total_dokumen ?? 0) ?></h3>
                <p class="text-xs mt-1" style="color:var(--muted); font-family:'Lora',serif;">lembar tersedia</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center shrink-0 organic-shape"
                 style="background:rgba(224,122,95,0.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt);">
                <svg class="w-6 h-6" fill="none" stroke="var(--txt)" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>

        <!-- Card: Izin Pending -->
        <div class="glass-card p-5 flex items-center justify-between metric-card" style="background-color: #fae1dd;">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-widest mb-1.5 font-kalam" style="color:var(--txt);">Izin Pending</p>
                <h3 class="text-4xl font-extrabold font-kalam" style="color:var(--txt);"><?= esc($izin_pending ?? 0) ?></h3>
                <p class="text-xs mt-1" style="color:var(--muted); font-family:'Lora',serif;">menunggu ulasan</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center shrink-0 organic-shape"
                 style="background:rgba(224,122,95,0.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt);">
                <svg class="w-6 h-6" fill="none" stroke="var(--txt)" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>

        <!-- Card: Izin Disetujui -->
        <div class="glass-card p-5 flex items-center justify-between metric-card" style="background-color: #d8e2dc;">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-widest mb-1.5 font-kalam" style="color:var(--txt);">Izin Disetujui</p>
                <h3 class="text-4xl font-extrabold font-kalam" style="color:var(--txt);"><?= esc($izin_disetujui ?? 0) ?></h3>
                <p class="text-xs mt-1" style="color:var(--muted); font-family:'Lora',serif;">akses diberikan</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center shrink-0 organic-shape"
                 style="background:rgba(132,169,140,0.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt);">
                <svg class="w-6 h-6" fill="none" stroke="var(--txt)" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>

    <?php endif; ?>
</div>

<!-- ─── Quick Links ─── -->
<div class="glass-card p-5 shortcuts-panel">
    <h4 class="text-lg font-bold mb-4 flex items-center font-kalam" style="color:var(--txt);">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="var(--primary)" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
        </svg>
        Jalan Pintas
    </h4>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Shortcut item template -->
        <a href="<?= base_url("$role/dokumen") ?>"
           class="group p-4 organic-shape flex items-center justify-between transition-all duration-300"
           style="background:rgba(132,169,140,0.05); color:var(--txt); box-shadow: 2px 2px 0px rgba(61,64,91,0.15);"
           onmouseover="this.style.boxShadow='4px 4px 0px rgba(61,64,91,0.3)'; this.style.transform='translateY(-2px)';"
           onmouseout="this.style.boxShadow='2px 2px 0px rgba(61,64,91,0.15)'; this.style.transform='translateY(0)';">
            <span class="text-sm font-semibold font-kalam">Jelajahi Arsip</span>
            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        <?php if ($role === 'admin'): ?>
        <a href="<?= base_url('admin/dokumen/create') ?>"
           class="group p-4 organic-shape flex items-center justify-between transition-all duration-300"
           style="background:rgba(224,122,95,0.05); color:var(--txt); box-shadow: 2px 2px 0px rgba(61,64,91,0.15);"
           onmouseover="this.style.boxShadow='4px 4px 0px rgba(61,64,91,0.3)'; this.style.transform='translateY(-2px)';"
           onmouseout="this.style.boxShadow='2px 2px 0px rgba(61,64,91,0.15)'; this.style.transform='translateY(0)';">
            <span class="text-sm font-semibold font-kalam">Tulis Dokumen</span>
            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
        </a>

        <a href="<?= base_url('admin/user') ?>"
           class="group p-4 organic-shape flex items-center justify-between transition-all duration-300"
           style="background:rgba(132,169,140,0.05); color:var(--txt); box-shadow: 2px 2px 0px rgba(61,64,91,0.15);"
           onmouseover="this.style.boxShadow='4px 4px 0px rgba(61,64,91,0.3)'; this.style.transform='translateY(-2px)';"
           onmouseout="this.style.boxShadow='2px 2px 0px rgba(61,64,91,0.15)'; this.style.transform='translateY(0)';">
            <span class="text-sm font-semibold font-kalam">Catatan User</span>
            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
        </a>

        <a href="<?= base_url('admin/revisi') ?>"
           class="group p-4 organic-shape flex items-center justify-between transition-all duration-300"
           style="background:rgba(224,122,95,0.05); color:var(--txt); box-shadow: 2px 2px 0px rgba(61,64,91,0.15);"
           onmouseover="this.style.boxShadow='4px 4px 0px rgba(61,64,91,0.3)'; this.style.transform='translateY(-2px)';"
           onmouseout="this.style.boxShadow='2px 2px 0px rgba(61,64,91,0.15)'; this.style.transform='translateY(0)';">
            <span class="text-sm font-semibold font-kalam">Ulas Revisi</span>
            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
        </a>

        <?php else: ?>

        <a href="<?= base_url('karyawan/izin/create') ?>"
           class="group p-4 organic-shape flex items-center justify-between transition-all duration-300"
           style="background:rgba(132,169,140,0.05); color:var(--txt); box-shadow: 2px 2px 0px rgba(61,64,91,0.15);"
           onmouseover="this.style.boxShadow='4px 4px 0px rgba(61,64,91,0.3)'; this.style.transform='translateY(-2px)';"
           onmouseout="this.style.boxShadow='2px 2px 0px rgba(61,64,91,0.15)'; this.style.transform='translateY(0)';">
            <span class="text-sm font-semibold font-kalam">Tulis Izin Akses</span>
            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
        </a>

        <a href="<?= base_url('karyawan/distribusi/create') ?>"
           class="group p-4 organic-shape flex items-center justify-between transition-all duration-300"
           style="background:rgba(224,122,95,0.05); color:var(--txt); box-shadow: 2px 2px 0px rgba(61,64,91,0.15);"
           onmouseover="this.style.boxShadow='4px 4px 0px rgba(61,64,91,0.3)'; this.style.transform='translateY(-2px)';"
           onmouseout="this.style.boxShadow='2px 2px 0px rgba(61,64,91,0.15)'; this.style.transform='translateY(0)';">
            <span class="text-sm font-semibold font-kalam">Pinjam Berkas</span>
            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
            </svg>
        </a>

        <a href="<?= base_url('karyawan/izin') ?>"
           class="group p-4 organic-shape flex items-center justify-between transition-all duration-300"
           style="background:rgba(132,169,140,0.05); color:var(--txt); box-shadow: 2px 2px 0px rgba(61,64,91,0.15);"
           onmouseover="this.style.boxShadow='4px 4px 0px rgba(61,64,91,0.3)'; this.style.transform='translateY(-2px)';"
           onmouseout="this.style.boxShadow='2px 2px 0px rgba(61,64,91,0.15)'; this.style.transform='translateY(0)';">
            <span class="text-sm font-semibold font-kalam">Catatan Izin</span>
            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </a>
        <?php endif; ?>
    </div>
</div>

<script>
(() => {
    // Hand-drawn bounce animations (using fromTo to prevent opacity bugs during PJAX)
    gsap.fromTo('.page-intro',    
        { y: -10, rotation: -1, opacity: 0 }, 
        { y: 0, rotation: 0, opacity: 1, duration: 0.6, ease: 'back.out(1.7)' }
    );
    gsap.fromTo('.metric-card',   
        { y: -10, rotation: 1, opacity: 0 }, 
        { y: 0, rotation: 0, opacity: 1, duration: 0.5, stagger: 0.1, ease: 'back.out(1.7)', delay: 0.15 }
    );
    gsap.fromTo('.shortcuts-panel', 
        { y: -10, opacity: 0 }, 
        { y: 0, opacity: 1, duration: 0.6, ease: 'back.out(1.2)', delay: 0.35 }
    );
})();
</script>
<?= $this->endSection() ?>
