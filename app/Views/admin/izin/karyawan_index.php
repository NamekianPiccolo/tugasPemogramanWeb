<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="mb-6 page-intro flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
    <div>
        <div class="flex items-center space-x-2 mb-1.5">
            <div class="w-1.5 h-5 organic-shape" style="background:var(--secondary)"></div>
            <span class="text-[11px] font-bold uppercase tracking-widest font-kalam" style="color:var(--muted)">Access Control</span>
        </div>
        <h1 class="text-3xl font-bold font-kalam mb-0.5" style="color:var(--txt)">Status Izin Akses Saya</h1>
        <p class="text-sm mt-2" style="color:var(--muted)">Pantau status pengajuan izin akses dokumen yang telah Anda ajukan.</p>
    </div>
    <a href="<?= base_url('karyawan/izin/create') ?>"
       class="organic-shape px-5 py-2.5 flex items-center space-x-2 shrink-0 cursor-pointer transition-all duration-200"
       style="background:var(--primary); color:#fffcf2; border:2px solid var(--txt); box-shadow: 3px 3px 0px var(--txt)"
       onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4"/></svg>
        <span class="font-kalam font-bold text-base">Ajukan Izin Baru</span>
    </a>
</div>

<!-- Flash Alerts -->
<?php if (session()->getFlashdata('success')): ?>
<div class="mb-5 p-3.5 flex items-center text-sm organic-shape alert-box" style="background:rgba(132,169,140,0.15); color:var(--txt); border: 2px solid var(--primary); box-shadow: 2px 2px 0px var(--primary)">
    <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="var(--primary)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <span class="font-kalam font-bold"><?= session()->getFlashdata('success') ?></span>
</div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
<div class="mb-5 p-3.5 flex items-center text-sm organic-shape alert-box" style="background:rgba(224,122,95,0.15); color:var(--txt); border: 2px solid var(--secondary); box-shadow: 2px 2px 0px var(--secondary)">
    <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="var(--secondary)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <span class="font-kalam font-bold"><?= session()->getFlashdata('error') ?></span>
</div>
<?php endif; ?>

<!-- ── Search ── -->
<?php if (!empty($izin)): ?>
<div id="searchPanel" class="search-panel">
    <!-- Input bar -->
    <div class="search-bar">
        <div class="search-icon-badge">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
        <input id="searchInput" type="text" class="search-bar-input" placeholder="Cari nama dokumen…">
        <div class="search-kbd">⌘K</div>
        <button class="search-bar-clear" title="Hapus pencarian">
            <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    <!-- Filter row -->
    <div class="search-filter-row">
        <span class="search-filter-label">Status:</span>
        <button class="sf-chip active" data-filter="" data-filter-status="">Semua</button>
        <button class="sf-chip" data-filter="pending" data-filter-status="pending">
            <span class="sf-dot" style="background:#F59E0B;opacity:1"></span> Pending
        </button>
        <button class="sf-chip" data-filter="disetujui" data-filter-status="disetujui">
            <span class="sf-dot" style="background:var(--primary);opacity:1"></span> Disetujui
        </button>
        <button class="sf-chip" data-filter="ditolak" data-filter-status="ditolak">
            <span class="sf-dot" style="background:var(--secondary);opacity:1"></span> Ditolak
        </button>
        <div class="search-count-badge">
            <span class="scb-num" id="searchCount"><?= count($izin) ?></span>
            <span>dari <?= count($izin) ?> pengajuan</span>
        </div>
    </div>
</div>
<div id="searchEmpty" class="search-empty">
    <div class="search-empty-icon">
        <svg width="30" height="30" fill="none" stroke="var(--secondary)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    </div>
    <p class="text-xl font-bold font-kalam mb-1" style="color:var(--txt)">Tidak ada hasil</p>
    <p class="text-sm" style="color:var(--muted)">Coba kata kunci atau filter yang berbeda.</p>
</div>
<?php endif; ?>

<!-- List Container -->
<div class="flex flex-col gap-5 list-container">
    <?php if (empty($izin)): ?>
        <div class="glass-card p-14 text-center" style="background-color: #f2e8cf">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center organic-shape" style="background:rgba(245,158,11,.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt)">
                <svg class="w-8 h-8" fill="none" stroke="var(--txt)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h4 class="text-xl font-bold mb-2 font-kalam" style="color:var(--txt)">Belum Ada Pengajuan</h4>
            <p class="text-sm" style="color:var(--muted)">Anda belum mengajukan izin akses dokumen apapun.</p>
        </div>
    <?php else: ?>
        <?php 
        $colors = ['#fffcf2', '#f2e8cf', '#d8e2dc', '#fae1dd'];
        $no=1; 
        foreach ($izin as $i): 
            $bgCard = $colors[($no-1) % count($colors)];
            $s = strtolower($i['status_izin'] ?? 'pending');
            if ($s === 'disetujui') { $badgeBg = 'rgba(132,169,140,0.15)'; $badgeCol = 'var(--primary)'; }
            elseif ($s === 'ditolak') { $badgeBg = 'rgba(224,122,95,0.15)'; $badgeCol = 'var(--secondary)'; }
            elseif ($s === 'selesai') { $badgeBg = 'rgba(108,117,125,0.15)'; $badgeCol = '#6C757D'; }
            else { $badgeBg = 'rgba(245,158,11,0.15)'; $badgeCol = '#F59E0B'; }
        ?>
        <div class="glass-card flex flex-col md:flex-row md:items-center justify-between p-5 anim-item organic-shape"
             style="background-color: <?= $bgCard ?>"
             data-search="<?= esc(strtolower(($i['judul'] ?? '') . ' ' . ($i['pesan'] ?? ''))) ?>"
             data-status="<?= esc($s) ?>">
            <div class="flex-1 min-w-0 flex items-start md:items-center gap-5">
                <div class="w-12 h-12 flex items-center justify-center shrink-0 organic-shape"
                     style="background:rgba(245,158,11,0.15); border:2px solid var(--txt); box-shadow: 2px 2px 0px var(--txt)">
                    <span class="font-kalam font-bold text-lg" style="color:var(--txt)"><?= $no++ ?></span>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-lg font-bold font-kalam truncate mb-1" style="color:var(--txt)"><?= esc($i['judul'] ?? 'Dokumen Dihapus') ?></h4>
                    <p class="text-xs mb-3 italic truncate max-w-xs sm:max-w-md md:max-w-lg" style="color:var(--dim)">"<?= esc($i['pesan'] ?: 'Tidak ada pesan.') ?>"</p>
                    <div class="flex flex-wrap items-center gap-3 text-[10px] font-bold uppercase tracking-widest font-kalam" style="color:var(--dim)">
                        <span class="organic-shape px-2.5 py-1" style="background:rgba(61,64,91,0.08); border:1px solid rgba(61,64,91,0.2)">Diajukan: <?= esc(date('d M Y H:i', strtotime($i['tgl_pengajuan']))) ?></span>
                        <?php 
                        $isRequestExpired = !empty($i['distribusi_tanggal_kembali']) && $i['distribusi_tanggal_kembali'] < date('Y-m-d');
                        if (strtolower($i['status_izin'] ?? '') === 'disetujui' && !empty($i['distribusi_tanggal_pinjam']) && !$isRequestExpired): 
                        ?>
                            <span class="organic-shape px-2.5 py-1" style="background:rgba(132,169,140,0.08); border:1px solid rgba(132,169,140,0.3); color:var(--primary)">Masa Pinjam: <?= esc(date('d M Y', strtotime($i['distribusi_tanggal_pinjam']))) ?> s/d <?= $i['distribusi_tanggal_kembali'] ? esc(date('d M Y', strtotime($i['distribusi_tanggal_kembali']))) : '—' ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="mt-5 md:mt-0 pt-4 md:pt-0 flex items-center justify-between md:justify-center shrink-0 border-t md:border-t-0 border-dashed border-[rgba(61,64,91,0.15)]" style="gap: 12px;">
                <button type="button" class="px-3 py-1.5 organic-shape text-[10px] font-bold font-kalam uppercase tracking-widest cursor-pointer transition-all duration-200 btn-open-detail-popup"
                        data-judul="<?= esc($i['judul'] ?? 'Dokumen Dihapus') ?>"
                        data-status="<?= esc($i['status_izin']) ?>"
                        data-pesan="<?= esc($i['pesan'] ?: 'Tidak ada pesan.') ?>"
                        data-pesan-admin="<?= esc($i['pesan_admin'] ?? '') ?>"
                        data-tgl="<?= esc(date('d M Y H:i', strtotime($i['tgl_pengajuan']))) ?>"
                        data-tgl-pinjam="<?= (!$isRequestExpired && !empty($i['distribusi_tanggal_pinjam'])) ? esc(date('d M Y', strtotime($i['distribusi_tanggal_pinjam']))) : '' ?>"
                        data-tgl-kembali="<?= (!$isRequestExpired && !empty($i['distribusi_tanggal_kembali'])) ? esc(date('d M Y', strtotime($i['distribusi_tanggal_kembali']))) : '' ?>"
                        style="background:var(--surface); color:var(--txt); border:2px solid var(--txt);"
                        onmouseover="this.style.background='var(--primary)'; this.style.color='#fffcf2';"
                        onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)';">
                    Detail
                </button>
                <span class="px-3 py-1.5 organic-shape text-[10px] font-bold font-kalam uppercase tracking-widest text-center"
                      style="background:<?= $badgeBg ?>; color:<?= $badgeCol ?>; border: 2px solid <?= $badgeCol ?>"><?= esc($i['status_izin']) ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Modal Detail Pengajuan -->
<div id="detailPopupModal" style="display: none; position: fixed; inset: 0; background: rgba(61, 64, 91, 0.6); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); z-index: 9999; justify-content: center; align-items: center; padding: 20px;">
    <div class="organic-shape" style="background: var(--surface); width: 100%; max-width: 500px; border: 3px solid var(--txt); box-shadow: 6px 6px 0px var(--txt); display: flex; flex-direction: column; overflow: hidden; animation: pop-in 0.3s cubic-bezier(0.34,1.56,0.64,1);">
        <!-- Modal Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-bottom: 2px solid var(--txt); background: #f2e8cf;">
            <h3 class="text-lg font-bold font-kalam m-0" style="color: var(--txt);">Detail Pengajuan Akses</h3>
            <button type="button" id="closeDetailPopupModal" class="organic-shape w-8 h-8 bg-white flex items-center justify-center text-gray-600 transition-all cursor-pointer"
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
                <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1" style="color:var(--txt);">Nama Dokumen:</p>
                <p id="detailPopupTitle" class="text-sm font-bold font-kalam" style="color:var(--muted);"></p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1" style="color:var(--txt);">Status Izin:</p>
                    <span id="detailPopupStatus" class="inline-block px-3 py-1.5 organic-shape text-xs font-bold font-kalam"></span>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1" style="color:var(--txt);">Tanggal Pengajuan:</p>
                    <p id="detailPopupDate" class="text-xs font-bold font-kalam" style="color:var(--muted);"></p>
                </div>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1.5" style="color:var(--txt);">Pesan Alasan Akses:</p>
                <p id="detailPopupMessage" class="text-sm font-kalam p-3 rounded italic" style="background:rgba(61,64,91,0.04); border:1.5px solid var(--txt); color:var(--txt); line-height: 1.5; word-break: break-word; white-space: pre-wrap;"></p>
            </div>
            <div id="detailPopupBorrowBlock" style="display: none;" class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1" style="color:var(--txt);">Tanggal Pinjam:</p>
                    <p id="detailPopupBorrowStart" class="text-xs font-bold font-kalam" style="color:var(--muted);"></p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1" style="color:var(--txt);">Tanggal Kembali:</p>
                    <p id="detailPopupBorrowEnd" class="text-xs font-bold font-kalam" style="color:var(--muted);"></p>
                </div>
            </div>
            <div id="detailPopupRejectionBlock" style="display: none;">
                <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1.5" style="color:var(--txt);">Catatan Penolakan Admin:</p>
                <p id="detailPopupRejection" class="text-sm font-kalam p-3 rounded italic" style="background:rgba(224,122,95,0.04); border:1.5px solid var(--secondary); color:var(--secondary); line-height: 1.5; word-break: break-word; white-space: pre-wrap;"></p>
            </div>
            <div class="flex justify-end mt-2">
                <button type="button" id="closeDetailPopupBtn" class="organic-shape px-5 py-2 text-sm font-bold font-kalam cursor-pointer text-white"
                        style="background:var(--primary); border:2px solid var(--txt); box-shadow: 2px 2px 0 var(--txt);">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
(() => {
    gsap.fromTo('.page-intro', { y: -18, opacity: 0 }, { y: 0, opacity: 1, duration:.5, ease:'back.out(1.5)' });
    gsap.fromTo('.anim-item', { y: -10, opacity: 0 }, { y: 0, opacity: 1, duration:.35, stagger:.04, ease:'back.out(1.5)', delay:.15 });

    initSearch({
        panelId: 'searchPanel',
        inputId: 'searchInput',
        items: '.anim-item',
        emptyId: 'searchEmpty',
        countId: 'searchCount',
        filterAttrs: [
            { attr: 'status', pillsSelector: '.sf-chip[data-filter-status]' }
        ]
    });

    // Logika Detail Popup Modal
    const detailPopupModal = document.getElementById('detailPopupModal');
    const detailPopupTitle = document.getElementById('detailPopupTitle');
    const detailPopupStatus = document.getElementById('detailPopupStatus');
    const detailPopupDate = document.getElementById('detailPopupDate');
    const detailPopupMessage = document.getElementById('detailPopupMessage');
    const closeDetailPopupModalBtn = document.getElementById('closeDetailPopupModal');
    const closeDetailPopupBtn = document.getElementById('closeDetailPopupBtn');

    document.querySelectorAll('.btn-open-detail-popup').forEach(btn => {
        btn.addEventListener('click', () => {
            const docJudul = btn.dataset.judul;
            const docStatus = btn.dataset.status;
            const docPesan = btn.dataset.pesan;
            const pesanAdmin = btn.dataset.pesanAdmin;
            const docTgl = btn.dataset.tgl;
            const tglPinjam = btn.dataset.tglPinjam;
            const tglKembali = btn.dataset.tglKembali;

            if (detailPopupTitle) detailPopupTitle.textContent = docJudul;
            
            const borrowBlock = document.getElementById('detailPopupBorrowBlock');
            const borrowStart = document.getElementById('detailPopupBorrowStart');
            const borrowEnd = document.getElementById('detailPopupBorrowEnd');
            if (borrowBlock && borrowStart && borrowEnd) {
                if (tglPinjam) {
                    borrowStart.textContent = tglPinjam;
                    borrowEnd.textContent = tglKembali || '—';
                    borrowBlock.style.display = 'grid';
                } else {
                    borrowBlock.style.display = 'none';
                }
            }
            if (detailPopupDate) detailPopupDate.textContent = docTgl;
            if (detailPopupMessage) detailPopupMessage.textContent = docPesan;
            
            const rejectBlock = document.getElementById('detailPopupRejectionBlock');
            const rejectText = document.getElementById('detailPopupRejection');
            if (rejectBlock && rejectText) {
                if (docStatus.toLowerCase() === 'ditolak') {
                    rejectText.textContent = pesanAdmin || 'Permohonan ditolak oleh Administrator.';
                    rejectBlock.style.display = 'block';
                } else {
                    rejectBlock.style.display = 'none';
                }
            }
            
            if (detailPopupStatus) {
                detailPopupStatus.textContent = docStatus;
                detailPopupStatus.className = 'inline-block px-3 py-1.5 organic-shape text-xs font-bold font-kalam';
                
                const s = docStatus.toLowerCase();
                if (s === 'pending') {
                    detailPopupStatus.style.background = '#fef3c7'; // Soft yellow
                    detailPopupStatus.style.color = '#92400e';
                    detailPopupStatus.style.border = '1.5px solid #92400e';
                } else if (s === 'ditolak') {
                    detailPopupStatus.style.background = '#fee2e2'; // Soft red
                    detailPopupStatus.style.color = '#991b1b';
                    detailPopupStatus.style.border = '1.5px solid #991b1b';
                } else {
                    detailPopupStatus.style.background = '#d1fae5'; // Soft green
                    detailPopupStatus.style.color = '#065f46';
                    detailPopupStatus.style.border = '1.5px solid #065f46';
                }
            }

            if (detailPopupModal) detailPopupModal.style.display = 'flex';
        });
    });

    const closeDetailPopup = () => {
        if (detailPopupModal) detailPopupModal.style.display = 'none';
    };

    if (closeDetailPopupModalBtn) closeDetailPopupModalBtn.addEventListener('click', closeDetailPopup);
    if (closeDetailPopupBtn) closeDetailPopupBtn.addEventListener('click', closeDetailPopup);

    window.addEventListener('click', e => {
        if (e.target === detailPopupModal) {
            closeDetailPopup();
        }
    });
})();
</script>
<?= $this->endSection() ?>
