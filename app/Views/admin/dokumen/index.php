<?= $this->extend('admin/layout') ?>

<?= $this->section('styles') ?>
<style>
    .quick-filter-pill {
        background: var(--surface);
        color: var(--txt);
        border: 2px solid var(--txt) !important;
        box-shadow: 2px 2px 0px rgba(61, 64, 91, 0.15);
    }

    .quick-filter-pill:hover {
        background: rgba(132, 169, 140, 0.15) !important;
        transform: translateY(-1px) rotate(-1deg);
    }

    .quick-filter-pill.active-pill {
        background: var(--primary) !important;
        color: #fffcf2 !important;
        box-shadow: 2px 2px 0px var(--txt) !important;
    }

    
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $role = session()->get('role') ?? 'admin'; ?>

<!-- Page Header -->
<div class="mb-7 page-intro flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
    <div>
        <div class="flex items-center space-x-2 mb-1.5">
            <div class="w-1.5 h-5 organic-shape" style="background:var(--secondary);"></div>
            <span class="text-[11px] font-bold uppercase tracking-widest font-kalam" style="color:var(--muted);">Vault Digital</span>
        </div>
        <h1 class="text-3xl font-bold font-kalam mb-0.5" style="color:var(--txt);">Dokumen Explorer</h1>
        <p class="text-sm mt-2" style="color:var(--muted); font-family:'Lora',serif;">Jelajahi, cari, unduh, dan kelola draf perubahan semua berkas digital.</p>
    </div>

    <?php if ($role === 'admin'): ?>
        <a href="<?= base_url('admin/dokumen/create') ?>"
            class="organic-shape px-5 py-2.5 flex items-center space-x-2 shrink-0 cursor-pointer transition-all duration-200"
            style="background:var(--primary); color:#fffcf2; border:2px solid var(--txt); box-shadow: 3px 3px 0px var(--txt);"
            onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="font-kalam font-bold text-base">Unggah Dokumen</span>
        </a>
    <?php else: ?>
        <a href="<?= base_url('karyawan/izin/create') ?>"
            class="organic-shape px-5 py-2.5 flex items-center space-x-2 shrink-0 cursor-pointer transition-all duration-200"
            style="background:var(--primary); color:#fffcf2; border:2px solid var(--txt); box-shadow: 3px 3px 0px var(--txt);"
            onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            <span class="font-kalam font-bold text-base">Ajukan Izin Akses Berkas</span>
        </a>
    <?php endif; ?>
</div>

<!-- ── Search ── -->
<?php if (!empty($dokumen)): ?>
    <div id="searchPanel" class="search-panel">
        <!-- Input bar -->
        <div class="search-bar">
            <div class="search-icon-badge">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input id="searchInput" type="text" class="search-bar-input" placeholder="Cari judul, kategori, unit, deskripsi, atau ekstensi berkas…">
            
        </div>
        <!-- Filter row -->
        <div class="search-filter-row flex flex-wrap gap-y-3">
            <div class="flex flex-wrap items-center gap-2">

                <button class="sf-chip active mr-2" data-filter="" data-filter-ext="">Semua</button>
                <?php
                $exts = [];
                $kats = [];
                foreach ($dokumen as $d) {
                    $file = $d['file_dokumen'] ?? '';
                    $ex = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    if ($ex) $exts[$ex] = true;
                    if (!empty($d['nama_kategori'])) $kats[$d['nama_kategori']] = true;
                }
                foreach (array_keys($exts) as $ex):
                ?>
                    <button class="sf-chip mr-2" data-filter="<?= esc($ex) ?>" data-filter-ext="<?= esc($ex) ?>">
                        .<?= strtoupper($ex) ?>
                    </button>
                <?php endforeach; ?>
            </div>

           

            <div class="search-count-badge">
                <span class="scb-num" id="searchCount"><?= count($dokumen) ?></span>
                <span>dari <?= count($dokumen) ?> berkas</span>
            </div>
        </div>
    </div>
    <div id="searchEmpty" class="search-empty">
        <div class="search-empty-icon">
            <svg width="30" height="30" fill="none" stroke="var(--secondary)" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-xl font-bold font-kalam mb-1" style="color:var(--txt);">Tidak ada hasil</p>
        <p class="text-sm" style="color:var(--muted); font-family:'Lora',serif;">Coba kata kunci atau filter yang berbeda.</p>
    </div>
<?php endif; ?>

<!-- Flash Alerts -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="mb-5 p-3.5 rounded-xl flex items-center text-sm alert-ok organic-shape" style="background:rgba(132,169,140,0.15); color:var(--txt); border: 2px solid var(--primary); box-shadow: 2px 2px 0px var(--primary);">
        <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="var(--primary)" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="font-kalam font-bold"><?= session()->getFlashdata('success') ?></span>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="mb-5 p-3.5 rounded-xl flex items-center text-sm alert-err organic-shape" style="background:rgba(224,122,95,0.15); color:var(--txt); border: 2px solid var(--secondary); box-shadow: 2px 2px 0px var(--secondary);">
        <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="var(--secondary)" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="font-kalam font-bold"><?= session()->getFlashdata('error') ?></span>
    </div>
<?php endif; ?>

<!-- Documents Grid -->
<?php if (empty($dokumen)): ?>
    <div class="glass-card p-14 text-center" style="background-color: #f2e8cf;">
        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center organic-shape"
            style="background:rgba(132,169,140,0.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt);">
            <svg class="w-8 h-8" fill="none" stroke="var(--txt)" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
        <h4 class="text-xl font-bold mb-2 font-kalam" style="color:var(--txt);">Vault Masih Kosong</h4>
        <p class="text-sm" style="color:var(--muted); font-family:'Lora',serif;">Belum ada dokumen yang diunggah ke dalam sistem saat ini.</p>
    </div>

<?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 doc-grid">
        <?php
        $colors = ['#fffcf2', '#f2e8cf', '#d8e2dc', '#fae1dd'];
        $i = 0;
        foreach ($dokumen as $d):
            $bgCard = $colors[$i % count($colors)];
            $i++;

            $file = $d['file_dokumen'] ?? '';
            $ext  = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            if ($ext === 'pdf') {
                $extColor = 'var(--secondary)';
                $extBg = 'rgba(224,122,95,0.15)';
                $extBorder = 'var(--secondary)';
            } elseif (in_array($ext, ['doc', 'docx'])) {
                $extColor = 'var(--txt)';
                $extBg = 'rgba(61,64,91,0.15)';
                $extBorder = 'var(--txt)';
            } elseif (in_array($ext, ['xls', 'xlsx', 'csv'])) {
                $extColor = 'var(--primary)';
                $extBg = 'rgba(132,169,140,0.15)';
                $extBorder = 'var(--primary)';
            } else {
                $extColor = 'var(--txt)';
                $extBg = 'rgba(138,129,124,0.15)';
                $extBorder = 'var(--muted)';
            }

            $isLocked = false;
            $dipinjamOrangLain = false;

            if ($role === 'karyawan') {
                if (!empty($d['sedang_dipinjam_global']) && $d['sedang_dipinjam_global'] > 0 && empty($d['status_distribusi'])) {
                    // Ada yang pinjam, tapi bukan user ini
                    $isLocked = true;
                    $dipinjamOrangLain = true;
                } elseif (($d['status_izin'] ?? '') !== 'Disetujui' && empty($d['status_distribusi'])) {
                    $isLocked = true;
                }
            }
        ?>

            <div class="glass-card group flex flex-col justify-between relative overflow-hidden doc-card"
                style="background-color: <?= $bgCard ?>;"
                data-search="<?= esc(strtolower($d['judul'] . ' ' . ($d['nama_kategori'] ?? '') . ' ' . ($d['nama_unit'] ?? '') . ' ' . ($d['deskripsi'] ?? '') . ' ' . ($ext ?? ''))) ?>"
                data-ext="<?= esc(strtolower($ext)) ?>"
                data-kat="<?= esc(strtolower($d['nama_kategori'] ?? '')) ?>">


                <!-- Card Content -->
                <div class="p-6 pb-2">
                    <div class="flex items-center justify-between mb-5">
                        <span class="text-[10px] font-bold px-2.5 py-1 uppercase tracking-widest font-kalam organic-shape"
                            style="background:<?= $extBg ?>;border:2px solid <?= $extBorder ?>;color:<?= $extColor ?>;">
                            <?= !empty($ext) ? esc($ext) : 'RAW' ?>
                        </span>
                        <span class="text-xs" style="color:var(--muted); font-family:'Lora',serif;">
                            <?= esc(date('d M Y', strtotime($d['tanggal']))) ?>
                        </span>
                    </div>

                    <h4 class="text-lg font-bold mb-1 truncate transition-colors duration-200 font-kalam"
                        style="color:var(--txt);" title="<?= esc($d['judul']) ?>"
                        onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--txt)'">
                        <?= esc($d['judul']) ?>
                    </h4>
                    <p class="text-[11px] mb-0.5 truncate font-bold uppercase tracking-widest font-kalam" style="color:var(--secondary);">
                        <?= esc($d['nama_kategori'] ?? 'Kategori Dihapus') ?>
                    </p>
                    <p class="text-[10px] mb-3 truncate font-bold uppercase tracking-widest font-kalam" style="color:var(--muted); opacity: 0.8;">
                        <?= esc($d['nama_unit'] ?? 'Bagian Dihapus') ?>
                    </p>
                    <p class="text-sm leading-relaxed line-clamp-3" style="color:var(--muted); font-family:'Lora',serif;">
                        <?= esc($d['deskripsi'] ?: 'Tidak ada deskripsi tambahan.') ?>
                    </p>
                </div>

                <!-- Footer Actions -->
                <div class="px-6 p-5 pb-8 pt-5 flex items-center justify-between"
                    style="border-top:2px dashed rgba(61, 64, 91, 0.15);margin-top:auto;">
                    <div class="flex space-x-2">
                        <?php if ($role === 'admin'): ?>
                            <a href="<?= base_url('admin/dokumen/edit/' . $d['id']) ?>"
                                class="organic-shape px-4 py-1.5 mb-2 text-sm font-bold font-kalam cursor-pointer transition-all duration-200"
                                style="background:var(--surface); color:var(--txt); border:2px solid var(--txt);"
                                onmouseover="this.style.background='var(--primary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
                                onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)'; this.style.transform='translateY(0)';">
                                Edit
                            </a>
                            <a href="<?= base_url('admin/dokumen/delete/' . $d['id']) ?>"
                                onclick="return confirm('Yakin hapus dokumen ini?')"
                                class="organic-shape px-4 py-1.5 mb-2 text-sm font-bold font-kalam cursor-pointer transition-all duration-200"
                                style="background:var(--surface); color:var(--txt); border:2px solid var(--txt);"
                                onmouseover="this.style.background='var(--secondary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
                                onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)'; this.style.transform='translateY(0)';">
                                Hapus
                            </a>
                        <?php else: ?>
                            <?php if ($dipinjamOrangLain): ?>
                                <span class="px-3 py-1.5 organic-shape text-xs font-bold font-kalam text-center"
                                    style="background:rgba(224,122,95,0.15); color:var(--secondary); border:2px dashed var(--secondary);">
                                    Sedang Dipinjam Karyawan Lain
                                </span>
                            <?php elseif ($isLocked): ?>
                                <?php if (($d['status_izin'] ?? '') === 'Pending'): ?>
                                    <span class="px-3 py-1.5 organic-shape text-xs font-bold font-kalam text-center"
                                        style="background:var(--surface); color:var(--txt); border:2px solid var(--txt);">
                                        Menunggu Izin Akses
                                    </span>
                                <?php elseif (($d['status_izin'] ?? '') === 'Ditolak'): ?>
                                    <a href="<?= base_url('karyawan/izin/create') ?>"
                                        class="px-4 py-1.5 organic-shape text-sm font-bold font-kalam text-white transition-all"
                                        style="background:var(--secondary); border:2px solid var(--txt); box-shadow: 2px 2px 0px var(--txt);">
                                        Ajukan Izin Lagi
                                    </a>
                                <?php else: ?>
                                    <form action="<?= base_url('karyawan/izin/store') ?>" method="POST" class="inline-block">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="dokumen_id" value="<?= $d['id'] ?>">
                                        <input type="hidden" name="pesan" value="Meminta izin untuk mengakses, mengunduh, dan merevisi dokumen.">
                                        <button type="submit" class="px-4 py-1.5 organic-shape text-sm font-bold font-kalam transition-all cursor-pointer"
                                            style="background:var(--primary); color:#fffcf2; border:2px solid var(--txt); box-shadow: 2px 2px 0px var(--txt);"
                                            onmouseover="this.style.transform='translateY(-1px)';" onmouseout="this.style.transform='translateY(0)';">
                                            Minta Izin Akses
                                        </button>
                                    </form>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="<?= base_url('karyawan/dokumen/edit/' . $d['id']) ?>"
                                    class="organic-shape px-4 py-1.5 text-sm font-bold font-kalam cursor-pointer transition-all duration-200"
                                    style="background:var(--surface); color:var(--txt); border:2px solid var(--txt);"
                                    onmouseover="this.style.background='var(--primary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
                                    onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)'; this.style.transform='translateY(0)';">
                                    Ajukan Revisi
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($d['file_dokumen'])): ?>
                        <?php if ($role === 'admin' || !$isLocked): ?>
                            <a href="<?= base_url('uploads/' . $d['file_dokumen']) ?>" target="_blank"
                                class="organic-shape w-10 h-10 flex items-center justify-center cursor-pointer transition-all duration-200"
                                style="background:var(--surface); color:var(--txt); border:2px solid var(--txt);"
                                onmouseover="this.style.background='var(--primary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
                                onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)'; this.style.transform='translateY(0)';"
                                title="Unduh / Lihat File">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                        <?php else: ?>
                            <div class="organic-shape w-10 h-10 flex items-center justify-center"
                                style="background:rgba(224,122,95,0.1); color:var(--secondary); border:2px solid var(--secondary);"
                                title="Akses Terkunci - Butuh Izin Admin">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<script>
    (() => {
        gsap.fromTo('.page-intro', {
            y: -18,
            opacity: 0
        }, {
            y: 0,
            opacity: 1,
            duration: .5,
            ease: 'back.out(1.5)'
        });
        gsap.fromTo(['.alert-box', '.doc-card'], {
            y: -14,
            opacity: 0
        }, {
            y: 0,
            opacity: 1,
            duration: .45,
            stagger: .04,
            ease: 'back.out(1.5)',
            delay: .1
        });

        initSearch({
            panelId: 'searchPanel',
            inputId: 'searchInput',
            items: '.doc-card',
            emptyId: 'searchEmpty',
            countId: 'searchCount',
            filterAttrs: [{
                    attr: 'ext',
                    pillsSelector: '.sf-chip[data-filter-ext]'
                },
                {
                    attr: 'kat',
                    pillsSelector: '.sf-chip[data-filter-kat]'
                }
            ]
        });
    })();
</script>
<?= $this->endSection() ?>