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

    /* Prevent filter dropdowns from overflowing the viewport width on mobile */
    @media (max-width: 768px) {
        #filterKategori, #filterUnit, #filterIzin, #sortSelect {
            max-width: 135px;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }
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

<!-- ── Search ── -->
<?php if (!empty($dokumen)):
    $allKategori = [];
    $allUnit = [];
    foreach ($dokumen as $d) {
        if (!empty($d['nama_kategori'])) {
            $allKategori[$d['nama_kategori']] = true;
        }
        if (!empty($d['nama_unit'])) {
            $allUnit[$d['nama_unit']] = true;
        }
    }
    ksort($allKategori);
    ksort($allUnit);
?>
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

        <!-- Filter Kategori, Unit & Sorting -->
        <div class="search-filter-row flex flex-wrap items-center justify-between gap-4 border-t border-dashed pt-4" style="border-top-color: rgba(61,64,91,0.15); margin-top: 12px;">
            <div class="flex flex-wrap items-center gap-3">
                <!-- Dropdown Kategori -->
                <div class="flex items-center space-x-1.5">
                    <label for="filterKategori" class="text-xs font-bold font-kalam" style="color:var(--txt)">Kategori:</label>
                    <select id="filterKategori" class="organic-shape px-2.5 py-1.5 text-xs font-bold font-kalam cursor-pointer"
                        style="background:var(--surface); border:2px solid var(--txt); box-shadow: 1.5px 1.5px 0 var(--txt)">
                        <option value="">Semua Kategori</option>
                        <?php foreach (array_keys($allKategori) as $katName): ?>
                            <option value="<?= esc(strtolower($katName)) ?>"><?= esc($katName) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Dropdown Unit -->
                <div class="flex items-center space-x-1.5">
                    <label for="filterUnit" class="text-xs font-bold font-kalam" style="color:var(--txt)">Unit:</label>
                    <select id="filterUnit" class="organic-shape px-2.5 py-1.5 text-xs font-bold font-kalam cursor-pointer"
                        style="background:var(--surface); border:2px solid var(--txt); box-shadow: 1.5px 1.5px 0 var(--txt)">
                        <option value="">Semua Unit</option>
                        <?php foreach (array_keys($allUnit) as $unitName): ?>
                            <option value="<?= esc(strtolower($unitName)) ?>"><?= esc($unitName) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <?php if ($role === 'karyawan'): ?>
                    <!-- Dropdown Status Izin -->
                    <div class="flex items-center space-x-1.5">
                        <label for="filterIzin" class="text-xs font-bold font-kalam" style="color:var(--txt)">Status Izin:</label>
                        <select id="filterIzin" class="organic-shape px-2.5 py-1.5 text-xs font-bold font-kalam cursor-pointer"
                            style="background:var(--surface); border:2px solid var(--txt); box-shadow: 1.5px 1.5px 0 var(--txt)">
                            <option value="">Semua Status</option>
                            <option value="belum">Belum Diajukan</option>
                            <option value="pending">Diajukan (Menunggu)</option>
                            <option value="disetujui">Disetujui (Aktif)</option>
                            <option value="expired">Masa Pinjam Habis</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sorting dropdown -->
            <div class="flex items-center space-x-1.5">
                <label for="sortSelect" class="text-xs font-bold font-kalam" style="color:var(--txt)">Urutkan:</label>
                <select id="sortSelect" class="organic-shape px-2.5 py-1.5 text-xs font-bold font-kalam cursor-pointer"
                    style="background:var(--surface); border:2px solid var(--txt); box-shadow: 1.5px 1.5px 0 var(--txt)">
                    <option value="judul-asc">Judul (A-Z)</option>
                    <option value="judul-desc">Judul (Z-A)</option>
                    <option value="kategori-asc">Kategori (A-Z)</option>
                    <option value="kategori-desc">Kategori (Z-A)</option>
                    <option value="unit-asc">Unit (A-Z)</option>
                    <option value="unit-desc">Unit (Z-A)</option>
                    <option value="tanggal-desc">Terbaru Diunggah</option>
                    <option value="tanggal-asc">Terlama Diunggah</option>
                </select>
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
            $isExpired = false;

            if ($role === 'karyawan') {
                // Cek apakah dokumen sedang dipinjam oleh orang lain secara global
                if (($d['sedang_dipinjam_global'] ?? 0) > 0 && empty($d['status_distribusi'])) {
                    $dipinjamOrangLain = true;
                }

                // Cek apakah peminjaman sudah kedaluwarsa (lewat tanggal kembali)
                if (!empty($d['status_distribusi']) && strtolower($d['status_distribusi']) === 'dipinjam' && !empty($d['distribusi_tanggal_kembali']) && $d['distribusi_tanggal_kembali'] < date('Y-m-d')) {
                    $isExpired = true;
                }

                // Terkunci jika belum disetujui, atau tidak ada peminjaman aktif, atau peminjaman telah kedaluwarsa
                if (($d['status_izin'] ?? '') !== 'Disetujui' || empty($d['status_distribusi']) || $isExpired) {
                    $isLocked = true;
                }

                // KECUALI jika usulan revisi terakhir ditolak, maka harus tetap bisa diakses agar karyawan bisa merevisi ulang
                if (($d['status_revisi_terakhir'] ?? '') === 'Ditolak') {
                    $isLocked = false;
                }
            }
        ?>

            <div class="glass-card group flex flex-col justify-between relative overflow-hidden doc-card"
                style="background-color: <?= $bgCard ?>;"
                data-search="<?= esc(strtolower($d['judul'] . ' ' . ($d['nama_kategori'] ?? '') . ' ' . ($d['nama_unit'] ?? '') . ' ' . ($d['deskripsi'] ?? '') . ' ' . ($ext ?? ''))) ?>"
                data-judul="<?= esc(strtolower($d['judul'])) ?>"
                data-ext="<?= esc(strtolower($ext)) ?>"
                data-kat="<?= esc(strtolower($d['nama_kategori'] ?? '')) ?>"
                data-unit="<?= esc(strtolower($d['nama_unit'] ?? '')) ?>"
                data-tanggal="<?= esc($d['tanggal']) ?>"
                data-izin="<?= $isExpired ? 'expired' : esc(strtolower($d['status_izin'] ?? 'belum')) ?>">


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
                    <?php if ($role === 'karyawan' && ($d['status_revisi_terakhir'] ?? '') === 'Ditolak'): ?>
                        <div class="mt-3.5 p-3.5 rounded-xl text-xs" style="background:rgba(224,122,95,0.08); border:2px dashed rgba(224,122,95,0.35); color:var(--txt)">
                            <div class="flex items-center gap-1.5 font-bold uppercase tracking-wider text-[9px] mb-1" style="color:var(--secondary)">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                Usulan Revisi Ditolak
                            </div>
                            <span class="font-kalam text-[11px] block italic" style="color:var(--secondary)">"<?= esc($d['pesan_revisi_admin_terakhir'] ?: 'Tidak ada alasan penolakan khusus.') ?>"</span>
                        </div>
                    <?php endif; ?>
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
                            <div class="flex flex-col gap-2 w-full">
                                <?php if ($isLocked): ?>
                                    <?php if (($d['status_izin'] ?? '') === 'Pending'): ?>
                                        <button type="button" class="px-3 py-1.5 organic-shape text-xs font-bold font-kalam text-center cursor-pointer transition-all duration-200 btn-open-detail-modal"
                                            data-judul="<?= esc($d['judul']) ?>"
                                            data-status="Pending"
                                            data-pesan="<?= esc($d['izin_pesan'] ?? '') ?>"
                                            data-pesan-admin="<?= esc($d['izin_pesan_admin'] ?? '') ?>"
                                            data-tgl="<?= esc(!empty($d['izin_tgl']) ? date('d-m-Y H:i', strtotime($d['izin_tgl'])) : '-') ?>"
                                            style="background:var(--surface); color:var(--txt); border:2px solid var(--txt);"
                                            onmouseover="this.style.background='rgba(61,64,91,0.05)';"
                                            onmouseout="this.style.background='var(--surface)';">
                                            Menunggu Izin Akses (Detail)
                                        </button>
                                    <?php elseif (($d['status_izin'] ?? '') === 'Ditolak'): ?>
                                        <div class="flex flex-row items-center gap-4">
                                            <button type="button" class="px-3 py-1.5 organic-shape text-xs font-bold font-kalam text-center cursor-pointer transition-all duration-200 btn-open-detail-modal"
                                                data-judul="<?= esc($d['judul']) ?>"
                                                data-status="Ditolak"
                                                data-pesan="<?= esc($d['izin_pesan'] ?? '') ?>"
                                                data-pesan-admin="<?= esc($d['izin_pesan_admin'] ?? '') ?>"
                                                data-tgl="<?= esc(!empty($d['izin_tgl']) ? date('d-m-Y H:i', strtotime($d['izin_tgl'])) : '-') ?>"
                                                style="background:rgba(224,122,95,0.1); color:var(--secondary); border:2px solid var(--secondary);"
                                                onmouseover="this.style.background='var(--secondary)'; this.style.color='#fffcf2';"
                                                onmouseout="this.style.background='rgba(224,122,95,0.1)'; this.style.color='var(--secondary)';"
                                                >
                                                Detail Penolakan
                                            </button>
                                            <button type="button" class="px-4 py-1.5 organic-shape text-xs font-bold font-kalam text-white transition-all cursor-pointer btn-open-izin-modal"
                                                data-id="<?= $d['id'] ?>"
                                                data-judul="<?= esc($d['judul']) ?>"
                                                style="background:var(--secondary); border:2px solid var(--txt); box-shadow: 2px 2px 0px var(--txt);"
                                                onmouseover="this.style.transform='translateY(-1px)';" onmouseout="this.style.transform='translateY(0)';">
                                                Ajukan Izin Lagi
                                            </button>
                                        </div>
                                    <?php elseif ($isExpired): ?>
                                        <div class="flex flex-row items-center gap-4">
                                            <span class="px-3 py-1.5 organic-shape text-xs font-bold font-kalam text-center"
                                                style="background:rgba(224,122,95,0.15); color:var(--secondary); border:2px dashed var(--secondary);">
                                                Masa Pinjam Habis
                                            </span>
                                            <button type="button" class="px-4 py-1.5 organic-shape text-xs font-bold font-kalam text-white transition-all cursor-pointer btn-open-izin-modal"
                                                data-id="<?= $d['id'] ?>"
                                                data-judul="<?= esc($d['judul']) ?>"
                                                style="background:var(--secondary); border:2px solid var(--txt); box-shadow: 2px 2px 0px var(--txt);"
                                                onmouseover="this.style.transform='translateY(-1px)';" onmouseout="this.style.transform='translateY(0)';">
                                                Minta Izin Lagi
                                            </button>
                                        </div>
                                    <?php else: ?>
                                        <button type="button" class="px-4 py-1.5 organic-shape text-sm font-bold font-kalam transition-all cursor-pointer btn-open-izin-modal"
                                            data-id="<?= $d['id'] ?>"
                                            data-judul="<?= esc($d['judul']) ?>"
                                            style="background:var(--primary); color:#fffcf2; border:2px solid var(--txt); box-shadow: 2px 2px 0px var(--txt);"
                                            onmouseover="this.style.transform='translateY(-1px)';" onmouseout="this.style.transform='translateY(0)';">
                                            Minta Izin Akses
                                        </button>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="flex flex-wrap gap-2" style="gap: 12px;">
                                        <a href="<?= base_url('karyawan/dokumen/edit/' . $d['id']) ?>"
                                            class="organic-shape px-4 py-1.5 text-sm font-bold font-kalam cursor-pointer transition-all duration-200"
                                            style="background:var(--surface); color:var(--txt); border:2px solid var(--txt);"
                                            onmouseover="this.style.background='var(--primary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
                                            onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)'; this.style.transform='translateY(0)';"
                                            title="Ajukan usulan draf revisi untuk dokumen ini">
                                            Ajukan Revisi
                                        </a>
                                         <?php if (!empty($d['status_distribusi']) || ($d['status_revisi_terakhir'] ?? '') === 'Ditolak'): ?>
                                             <a href="<?= base_url('karyawan/distribusi/kembalikan/' . $d['id']) ?>"
                                                onclick="return confirm('Apakah Anda yakin ingin mengembalikan dokumen ini?')"
                                                class="organic-shape px-4 py-1.5 text-sm font-bold font-kalam cursor-pointer transition-all duration-200"
                                                style="background:rgba(224,122,95,0.1); color:var(--secondary); border:2px solid var(--secondary);"
                                                onmouseover="this.style.background='var(--secondary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
                                                onmouseout="this.style.background='rgba(224,122,95,0.1)'; this.style.color='var(--secondary)'; this.style.transform='translateY(0)';"
                                                title="Kembalikan dokumen tanpa mengajukan revisi">
                                                Kembalikan
                                             </a>
                                         <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($d['file_dokumen'])): ?>
                        <?php if ($role === 'admin' || !$isLocked): ?>
                            <a href="<?= base_url('uploads/' . $d['file_dokumen']) ?>" target="_blank"
                                class="organic-shape w-10 h-10 flex items-center justify-center cursor-pointer transition-all duration-200 btn-preview-file"
                                data-file="<?= base_url('uploads/' . $d['file_dokumen']) ?>"
                                data-title="<?= esc($d['judul']) ?>"
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

<!-- Global Preview Modal -->
<div id="previewModal" style="display: none; position: fixed; inset: 0; background: rgba(61, 64, 91, 0.6); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); z-index: 9999; justify-content: center; align-items: center; padding: 20px;">
    <div class="organic-shape" style="background: var(--surface); width: 100%; max-width: 900px; height: 90vh; border: 3px solid var(--txt); box-shadow: 6px 6px 0px var(--txt); display: flex; flex-direction: column; overflow: hidden; animation: pop-in 0.3s cubic-bezier(0.34,1.56,0.64,1);">
        <!-- Modal Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-bottom: 2px solid var(--txt); background: #f2e8cf;">
            <h3 id="modalPreviewTitle" class="text-lg font-bold font-kalam m-0" style="color: var(--txt);">Pratinjau Dokumen</h3>
            <button type="button" id="closePreviewModal" class="organic-shape w-8 h-8 bg-white border-2 border-[var(--txt)] flex items-center justify-center text-gray-600 hover:bg-[var(--secondary)] hover:text-white transition-all cursor-pointer" title="Tutup">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <!-- Modal Content -->
        <div style="flex: 1; overflow: hidden; position: relative;">
            <!-- Iframe untuk PDF -->
            <iframe id="modalPdfFrame" src="" style="width: 100%; height: 100%; border: none; display: none;"></iframe>
            <!-- Div untuk DOCX -->
            <div id="modalDocxDiv" style="width: 100%; height: 100%; overflow: auto; background: white; padding: 20px; display: none;"></div>
        </div>
    </div>
</div>

<!-- Modal Minta Izin Akses (Custom Message) -->
<div id="izinModal" style="display: none; position: fixed; inset: 0; background: rgba(61, 64, 91, 0.6); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); z-index: 9999; justify-content: center; align-items: center; padding: 20px;">
    <div class="organic-shape" style="background: var(--surface); width: 100%; max-width: 500px; border: 3px solid var(--txt); box-shadow: 6px 6px 0px var(--txt); display: flex; flex-direction: column; overflow: hidden; animation: pop-in 0.3s cubic-bezier(0.34,1.56,0.64,1);">
        <!-- Modal Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-bottom: 2px solid var(--txt); background: #f2e8cf;">
            <h3 class="text-lg font-bold font-kalam m-0" style="color: var(--txt);">Permohonan Akses Dokumen</h3>
            <button type="button" id="closeIzinModal" class="organic-shape w-8 h-8 bg-white flex items-center justify-center text-gray-600 transition-all cursor-pointer"
                style="border: 2px solid var(--txt);"
                onmouseover="this.style.background='var(--secondary)'; this.style.color='white';"
                onmouseout="this.style.background='white'; this.style.color='#4b5563';"
                title="Tutup">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <!-- Modal Form -->
        <form action="<?= base_url('karyawan/izin/store') ?>" method="POST" id="izinForm"
            data-confirm-title="Kirim Permohonan"
            data-confirm-text="Apakah Anda yakin ingin mengirim permohonan izin akses untuk dokumen ini?"
            data-confirm-btn="Kirim">
            <?= csrf_field() ?>
            <input type="hidden" name="dokumen_id" id="izinDokumenId">
            <div class="p-6 flex flex-col gap-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-2" style="color:var(--txt);">Judul Dokumen:</p>
                    <p id="izinDokumenTitle" class="text-sm font-bold font-kalam p-3 rounded" style="background:rgba(61,64,91,0.04); border:1.5px solid var(--txt); color:var(--txt);"></p>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="izinPesan" class="text-xs font-bold uppercase tracking-wider font-kalam m-0" style="color:var(--txt);">Alasan Mengakses Berkas / Pesan ke Admin:</label>
                        <span id="izinPesanCounter" class="text-[10px] font-bold font-kalam" style="color:var(--muted)">0 / 200 karakter</span>
                    </div>
                    <textarea name="pesan" id="izinPesan" required rows="4" maxlength="200" class="w-full organic-shape p-3 text-sm font-bold font-kalam focus:ring-0 focus:outline-none"
                        style="background:#fffcf2; border:2px solid var(--txt); color:var(--txt);"
                        placeholder="Tulis alasan Anda di sini (misalnya: untuk audit internal, pembaruan draf, dll.)..."></textarea>
                </div>
                <div class="flex justify-end gap-3.5 mt-2">
                    <button type="button" id="cancelIzinBtn" class="organic-shape px-4 py-2 text-sm font-bold font-kalam cursor-pointer"
                        style="background:var(--surface); color:var(--txt); border:2px solid var(--txt);">Batal</button>
                    <button type="submit" class="organic-shape px-5 py-2 text-sm font-bold font-kalam cursor-pointer text-white"
                        style="background:var(--primary); border:2px solid var(--txt); box-shadow: 2px 2px 0 var(--txt);">Kirim Permohonan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Detail Izin Akses -->
<div id="detailIzinModal" style="display: none; position: fixed; inset: 0; background: rgba(61, 64, 91, 0.6); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); z-index: 9999; justify-content: center; align-items: center; padding: 20px;">
    <div class="organic-shape" style="background: var(--surface); width: 100%; max-width: 500px; border: 3px solid var(--txt); box-shadow: 6px 6px 0px var(--txt); display: flex; flex-direction: column; overflow: hidden; animation: pop-in 0.3s cubic-bezier(0.34,1.56,0.64,1);">
        <!-- Modal Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-bottom: 2px solid var(--txt); background: #f2e8cf;">
            <h3 class="text-lg font-bold font-kalam m-0" style="color: var(--txt);">Detail Permohonan Izin</h3>
            <button type="button" id="closeDetailIzinModal" class="organic-shape w-8 h-8 bg-white flex items-center justify-center text-gray-600 transition-all cursor-pointer"
                    style="border: 2px solid var(--txt);"
                    onmouseover="this.style.background='var(--secondary)'; this.style.color='white';"
                    onmouseout="this.style.background='white'; this.style.color='#4b5563';"
                    title="Tutup">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <!-- Modal Content -->
        <div class="p-6 flex flex-col gap-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1" style="color:var(--txt);">Judul Dokumen:</p>
                <p id="detailDocTitle" class="text-sm font-bold font-kalam" style="color:var(--muted);"></p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1" style="color:var(--txt);">Status:</p>
                    <span id="detailDocStatus" class="inline-block px-3 py-1.5 organic-shape text-xs font-bold font-kalam"></span>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1" style="color:var(--txt);">Tanggal Pengajuan:</p>
                    <p id="detailDocDate" class="text-xs font-bold font-kalam" style="color:var(--muted);"></p>
                </div>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1.5" style="color:var(--txt);">Alasan / Pesan yang Dikirim:</p>
                <p id="detailDocMessage" class="text-sm font-kalam p-3 rounded italic" style="background:rgba(61,64,91,0.04); border:1.5px solid var(--txt); color:var(--txt); line-height: 1.5; word-break: break-word; white-space: pre-wrap;"></p>
            </div>
            <div id="detailDocRejectionBlock" style="display: none;">
                <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1.5" style="color:var(--txt);">Catatan Penolakan Admin:</p>
                <p id="detailDocRejection" class="text-sm font-kalam p-3 rounded italic" style="background:rgba(224,122,95,0.04); border:1.5px solid var(--secondary); color:var(--secondary); line-height: 1.5; word-break: break-word; white-space: pre-wrap;"></p>
            </div>
            <div class="flex justify-end mt-2">
                <button type="button" id="closeDetailIzinBtn" class="organic-shape px-5 py-2 text-sm font-bold font-kalam cursor-pointer text-white"
                        style="background:var(--primary); border:2px solid var(--txt); box-shadow: 2px 2px 0 var(--txt);">Tutup</button>
            </div>
        </div>
    </div>
</div>

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

        const searchInput = document.getElementById('searchInput');
        const filterKategori = document.getElementById('filterKategori');
        const filterUnit = document.getElementById('filterUnit');
        const filterIzin = document.getElementById('filterIzin');
        const sortSelect = document.getElementById('sortSelect');
        const docGrid = document.querySelector('.doc-grid');
        const cards = Array.from(document.querySelectorAll('.doc-card'));
        const extChips = document.querySelectorAll('.sf-chip[data-filter-ext]');
        const countEl = document.getElementById('searchCount');
        const emptyEl = document.getElementById('searchEmpty');

        let activeExt = '';

        const runFilterAndSort = () => {
            const q = searchInput ? searchInput.value.toLowerCase().trim() : '';
            const selectedKat = filterKategori ? filterKategori.value : '';
            const selectedUnit = filterUnit ? filterUnit.value : '';
            const selectedIzin = filterIzin ? filterIzin.value : '';

            let visibleCount = 0;

            // 1. Filtering
            cards.forEach(card => {
                const searchTxt = card.dataset.search || '';
                const textMatch = searchTxt.includes(q);

                const extMatch = !activeExt || card.dataset.ext === activeExt;
                const katMatch = !selectedKat || card.dataset.kat === selectedKat;
                const unitMatch = !selectedUnit || card.dataset.unit === selectedUnit;
                const izinMatch = !selectedIzin || card.dataset.izin === selectedIzin;

                const show = textMatch && extMatch && katMatch && unitMatch && izinMatch;

                if (show) {
                    if (card.style.display === 'none') {
                        card.style.display = '';
                        gsap.fromTo(card, {
                            opacity: 0,
                            y: 8
                        }, {
                            opacity: 1,
                            y: 0,
                            duration: 0.2,
                            ease: 'power2.out'
                        });
                    }
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (countEl) {
                countEl.textContent = visibleCount;
            }
            if (emptyEl) {
                emptyEl.classList.toggle('visible', visibleCount === 0);
            }

            // 2. Sorting
            const sortBy = sortSelect ? sortSelect.value : 'judul-asc';

            cards.sort((a, b) => {
                let valA, valB;
                if (sortBy.startsWith('judul')) {
                    valA = a.dataset.judul || '';
                    valB = b.dataset.judul || '';
                } else if (sortBy.startsWith('kategori')) {
                    valA = a.dataset.kat || '';
                    valB = b.dataset.kat || '';
                } else if (sortBy.startsWith('unit')) {
                    valA = a.dataset.unit || '';
                    valB = b.dataset.unit || '';
                } else if (sortBy.startsWith('tanggal')) {
                    valA = a.dataset.tanggal || '';
                    valB = b.dataset.tanggal || '';
                }

                if (sortBy.endsWith('-asc')) {
                    return valA.localeCompare(valB);
                } else {
                    return valB.localeCompare(valA);
                }
            });

            // Re-append in sorted order to container
            if (docGrid) {
                cards.forEach(card => docGrid.appendChild(card));
            }
        };

        // Event listeners
        if (searchInput) searchInput.addEventListener('input', runFilterAndSort);
        if (filterKategori) filterKategori.addEventListener('change', runFilterAndSort);
        if (filterUnit) filterUnit.addEventListener('change', runFilterAndSort);
        if (filterIzin) filterIzin.addEventListener('change', runFilterAndSort);
        if (sortSelect) sortSelect.addEventListener('change', runFilterAndSort);

        // Extension chips
        extChips.forEach(chip => {
            chip.addEventListener('click', () => {
                extChips.forEach(c => c.classList.remove('active'));
                chip.classList.add('active');
                activeExt = chip.dataset.filter || '';
                runFilterAndSort();
            });
        });

        // Initialize sorting (default: judul-asc)
        runFilterAndSort();

        // Logika Preview Modal
        const modal = document.getElementById('previewModal');
        const modalPdfFrame = document.getElementById('modalPdfFrame');
        const modalDocxDiv = document.getElementById('modalDocxDiv');
        const modalTitle = document.getElementById('modalPreviewTitle');
        const closeBtn = document.getElementById('closePreviewModal');

        document.querySelectorAll('.btn-preview-file').forEach(btn => {
            btn.addEventListener('click', e => {
                const fileUrl = btn.dataset.file;
                const fileTitle = btn.dataset.title;
                const isPdf = fileUrl.toLowerCase().endsWith('.pdf');
                const isDocx = fileUrl.toLowerCase().endsWith('.docx');

                if (isPdf || isDocx) {
                    e.preventDefault();
                    modalTitle.textContent = `Pratinjau: ${fileTitle}`;

                    // Reset modal content
                    modalPdfFrame.src = '';
                    modalPdfFrame.style.display = 'none';
                    modalDocxDiv.innerHTML = '';
                    modalDocxDiv.style.display = 'none';

                    modal.style.display = 'flex';

                    if (isPdf) {
                        modalPdfFrame.src = fileUrl;
                        modalPdfFrame.style.display = 'block';
                    } else if (isDocx) {
                        modalDocxDiv.style.display = 'block';
                        modalDocxDiv.innerHTML = '<p class="text-xs text-gray-500 font-bold p-4 text-center">Mengunduh pratinjau dokumen...</p>';

                        fetch(fileUrl)
                            .then(res => res.blob())
                            .then(blob => {
                                if (typeof docx !== 'undefined') {
                                    docx.renderAsync(blob, modalDocxDiv)
                                        .catch(err => {
                                            modalDocxDiv.innerHTML = '<p class="text-xs text-red-500 font-bold p-4 text-center">Gagal merender DOCX: ' + err.message + '</p>';
                                        });
                                } else {
                                    modalDocxDiv.innerHTML = '<p class="text-xs text-amber-600 font-bold p-4 text-center">Gagal memuat sistem pratinjau Word dari CDN.</p>';
                                }
                            })
                            .catch(err => {
                                modalDocxDiv.innerHTML = '<p class="text-xs text-red-500 font-bold p-4 text-center">Gagal mengambil file: ' + err.message + '</p>';
                            });
                    }
                }
            });
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                modal.style.display = 'none';
                modalPdfFrame.src = '';
                modalDocxDiv.innerHTML = '';
            });
        }

        window.addEventListener('click', e => {
            if (e.target === modal) {
                modal.style.display = 'none';
                modalPdfFrame.src = '';
                modalDocxDiv.innerHTML = '';
            }
        });

        // Logika Izin Modal
        const izinModal = document.getElementById('izinModal');
        const izinDokumenIdInput = document.getElementById('izinDokumenId');
        const izinDokumenTitle = document.getElementById('izinDokumenTitle');
        const closeIzinModalBtn = document.getElementById('closeIzinModal');
        const cancelIzinBtn = document.getElementById('cancelIzinBtn');
        const izinPesan = document.getElementById('izinPesan');

        document.querySelectorAll('.btn-open-izin-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                const docId = btn.dataset.id;
                const docJudul = btn.dataset.judul;

                if (izinDokumenIdInput) izinDokumenIdInput.value = docId;
                if (izinDokumenTitle) izinDokumenTitle.textContent = docJudul;
                if (izinPesan) {
                    izinPesan.value = '';
                    // Set default helper placeholder
                    izinPesan.placeholder = "Tulis alasan Anda di sini (misalnya: untuk audit internal, pembaruan draf, dll.)...";
                    const counter = document.getElementById('izinPesanCounter');
                    if (counter) counter.textContent = '0 / 200 karakter';
                }

                if (izinModal) izinModal.style.display = 'flex';
            });
        });

        if (izinPesan) {
            izinPesan.addEventListener('input', () => {
                const count = izinPesan.value.length;
                const counter = document.getElementById('izinPesanCounter');
                if (counter) counter.textContent = `${count} / 200 karakter`;
            });
        }

        const closeIzinModal = () => {
            if (izinModal) izinModal.style.display = 'none';
        };

        if (closeIzinModalBtn) closeIzinModalBtn.addEventListener('click', closeIzinModal);
        if (cancelIzinBtn) cancelIzinBtn.addEventListener('click', closeIzinModal);

        window.addEventListener('click', e => {
            if (e.target === izinModal) {
                closeIzinModal();
            }
        });

        // Logika Detail Izin Modal
        const detailIzinModal = document.getElementById('detailIzinModal');
        const detailDocTitle = document.getElementById('detailDocTitle');
        const detailDocStatus = document.getElementById('detailDocStatus');
        const detailDocDate = document.getElementById('detailDocDate');
        const detailDocMessage = document.getElementById('detailDocMessage');
        const closeDetailIzinModalBtn = document.getElementById('closeDetailIzinModal');
        const closeDetailIzinBtn = document.getElementById('closeDetailIzinBtn');

        document.querySelectorAll('.btn-open-detail-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                const docJudul = btn.dataset.judul;
                const docStatus = btn.dataset.status;
                const docPesan = btn.dataset.pesan;
                const pesanAdmin = btn.dataset.pesanAdmin;
                const docTgl = btn.dataset.tgl;

                if (detailDocTitle) detailDocTitle.textContent = docJudul;
                if (detailDocDate) detailDocDate.textContent = docTgl;
                if (detailDocMessage) detailDocMessage.textContent = docPesan || 'Tidak ada pesan khusus.';
                
                const rejectBlock = document.getElementById('detailDocRejectionBlock');
                const rejectText = document.getElementById('detailDocRejection');
                if (rejectBlock && rejectText) {
                    if (docStatus.toLowerCase() === 'ditolak') {
                        rejectText.textContent = pesanAdmin || 'Permohonan ditolak oleh Administrator.';
                        rejectBlock.style.display = 'block';
                    } else {
                        rejectBlock.style.display = 'none';
                    }
                }

                if (detailDocStatus) {
                    detailDocStatus.textContent = docStatus === 'Pending' ? 'Menunggu Persetujuan' : docStatus;
                    detailDocStatus.className = 'inline-block px-3 py-1.5 organic-shape text-xs font-bold font-kalam';
                    
                    if (docStatus === 'Pending') {
                        detailDocStatus.style.background = '#fef3c7'; // Soft yellow
                        detailDocStatus.style.color = '#92400e';
                        detailDocStatus.style.border = '1.5px solid #92400e';
                    } else if (docStatus === 'Ditolak') {
                        detailDocStatus.style.background = '#fee2e2'; // Soft red
                        detailDocStatus.style.color = '#991b1b';
                        detailDocStatus.style.border = '1.5px solid #991b1b';
                    } else {
                        detailDocStatus.style.background = '#d1fae5'; // Soft green
                        detailDocStatus.style.color = '#065f46';
                        detailDocStatus.style.border = '1.5px solid #065f46';
                    }
                }

                if (detailIzinModal) detailIzinModal.style.display = 'flex';
            });
        });

        const closeDetailIzinModal = () => {
            if (detailIzinModal) detailIzinModal.style.display = 'none';
        };

        if (closeDetailIzinModalBtn) closeDetailIzinModalBtn.addEventListener('click', closeDetailIzinModal);
        if (closeDetailIzinBtn) closeDetailIzinBtn.addEventListener('click', closeDetailIzinModal);

        window.addEventListener('click', e => {
            if (e.target === detailIzinModal) {
                closeDetailIzinModal();
            }
        });
    })();
</script>
<?= $this->endSection() ?>