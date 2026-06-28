<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 page-intro flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
    <div>
        <div class="flex items-center space-x-2 mb-1.5">
            <div class="w-1.5 h-5 organic-shape" style="background:var(--secondary)"></div>
            <span class="text-[11px] font-bold uppercase tracking-widest font-kalam" style="color:var(--muted)">Access Control</span>
        </div>
        <h1 class="text-3xl font-bold font-kalam mb-0.5" style="color:var(--txt)">Persetujuan Izin Akses</h1>
        <p class="text-sm mt-2" style="color:var(--muted)">Tinjau, setujui, atau tolak permintaan akses dokumen dari karyawan.</p>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="mb-5 p-3.5 flex items-center text-sm organic-shape" style="background:rgba(132,169,140,0.15); color:var(--txt); border: 2px solid var(--primary); box-shadow: 2px 2px 0px var(--primary)">
        <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="var(--primary)" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="font-kalam font-bold"><?= session()->getFlashdata('success') ?></span>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="mb-5 p-3.5 flex items-center text-sm organic-shape" style="background:rgba(224,122,95,0.15); color:var(--txt); border: 2px solid var(--secondary); box-shadow: 2px 2px 0px var(--secondary)">
        <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="var(--secondary)" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="font-kalam font-bold"><?= session()->getFlashdata('error') ?></span>
    </div>
<?php endif; ?>

<?php if (!empty($izin)): ?>
    <div id="searchPanel" class="search-panel">
        <div class="search-bar">
            <div class="search-icon-badge">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input id="searchInput" type="text" class="search-bar-input" placeholder="Cari nama karyawan atau dokumen…">
            <div class="search-kbd">⌘K</div>
            <button class="search-bar-clear" title="Hapus pencarian">
                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
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
            <button class="sf-chip" data-filter="selesai" data-filter-status="selesai">
                <span class="sf-dot" style="background:#6C757D;opacity:1"></span> Selesai
            </button>
            <div class="search-count-badge">
                <span class="scb-num" id="searchCount"><?= count($izin) ?></span>
                <span>dari <?= count($izin) ?></span>
            </div>
        </div>
    </div>
    <div id="searchEmpty" class="search-empty">
        <div class="search-empty-icon">
            <svg width="30" height="30" fill="none" stroke="var(--secondary)" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-xl font-bold font-kalam mb-1" style="color:var(--txt)">Tidak ada hasil</p>
        <p class="text-sm" style="color:var(--muted)">Coba kata kunci atau filter yang berbeda.</p>
    </div>
<?php endif; ?>

<div class="flex flex-col gap-5">
    <?php if (empty($izin)): ?>
        <div class="glass-card p-14 text-center" style="background-color: #f2e8cf">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center organic-shape" style="background:rgba(245,158,11,.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt)">
                <svg class="w-8 h-8" fill="none" stroke="var(--txt)" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h4 class="text-xl font-bold mb-2 font-kalam" style="color:var(--txt)">Belum Ada Pengajuan Izin</h4>
            <p class="text-sm" style="color:var(--muted)">Belum ada permintaan akses dokumen yang masuk.</p>
        </div>
    <?php else: ?>
        <?php
        $colors = ['#fffcf2', '#f2e8cf', '#d8e2dc', '#fae1dd'];
        $no = 1;
        foreach ($izin as $i):
            $bgCard = $colors[($no - 1) % count($colors)];
            $status = strtolower($i['status_izin'] ?? 'pending');
            if ($status === 'disetujui') {
                $badgeBg = 'rgba(132,169,140,0.15)';
                $badgeCol = 'var(--primary)';
            } elseif ($status === 'ditolak') {
                $badgeBg = 'rgba(224,122,95,0.15)';
                $badgeCol = 'var(--secondary)';
            } elseif ($status === 'selesai') {
                $badgeBg = 'rgba(108,117,125,0.15)';
                $badgeCol = '#6C757D';
            } else {
                $badgeBg = 'rgba(245,158,11,0.15)';
                $badgeCol = '#F59E0B';
            }
        ?>
            <div class="glass-card flex flex-col md:flex-row md:items-center justify-between p-5 anim-item organic-shape"
                style="background-color: <?= $bgCard ?>"
                data-search="<?= esc(strtolower(($i['nama_lengkap'] ?? '') . ' ' . ($i['judul'] ?? '') . ' ' . ($i['pesan'] ?? ''))) ?>"
                data-status="<?= esc($status) ?>">
                <div class="flex-1 min-w-0 flex items-start md:items-center gap-5">
                    <div class="w-12 h-12 flex items-center justify-center shrink-0 organic-shape"
                        style="background:rgba(245,158,11,0.15); border:2px solid var(--txt); box-shadow: 2px 2px 0px var(--txt)">
                        <span class="font-kalam font-bold text-lg" style="color:var(--txt)"><?= $no++ ?></span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-lg font-bold font-kalam truncate mb-1" style="color:var(--txt)"><?= esc($i['nama_lengkap'] ?? 'Karyawan Dihapus') ?></h4>
                        <p class="text-sm font-bold truncate mb-1" style="color:var(--muted)">Dokumen: <span style="color:var(--txt)"><?= esc($i['judul'] ?? 'Dihapus') ?></span></p>
                        <p class="text-xs mb-3 italic truncate max-w-xs sm:max-w-md md:max-w-lg" style="color:var(--dim)">"<?= esc($i['pesan'] ?: 'Tidak ada alasan/pesan.') ?>"</p>
                        <span class="inline-block organic-shape px-2.5 py-1 text-[10px] font-bold uppercase tracking-widest font-kalam" style="background:rgba(61,64,91,0.08); border:1px solid rgba(61,64,91,0.2); color:var(--dim)">Diajukan: <?= esc(date('d M Y H:i', strtotime($i['tgl_pengajuan']))) ?></span>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 pt-4 md:pt-0 flex flex-row md:flex-col items-center md:items-end justify-between md:justify-center shrink-0 gap-3 border-t md:border-t-0 border-dashed border-[rgba(61,64,91,0.15)]">
                    <div class="flex items-center" style="gap: 12px;">
                        <button type="button" class="px-3 py-1.5 organic-shape text-[10px] font-bold font-kalam uppercase tracking-widest cursor-pointer transition-all duration-200 btn-open-admin-detail"
                                data-karyawan="<?= esc($i['nama_lengkap'] ?? 'Karyawan Dihapus') ?>"
                                data-judul="<?= esc($i['judul'] ?? 'Dihapus') ?>"
                                data-status="<?= esc($i['status_izin']) ?>"
                                data-pesan="<?= esc($i['pesan'] ?: 'Tidak ada alasan/pesan.') ?>"
                                data-pesan-admin="<?= esc($i['pesan_admin'] ?? '') ?>"
                                data-tgl="<?= esc(date('d M Y H:i', strtotime($i['tgl_pengajuan']))) ?>"
                                style="background:var(--surface); color:var(--txt); border:2px solid var(--txt);"
                                onmouseover="this.style.background='var(--primary)'; this.style.color='#fffcf2';"
                                onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)';">
                            Detail
                        </button>
                        <span class="px-3 py-1.5 organic-shape text-[10px] font-bold font-kalam uppercase tracking-widest text-center"
                            style="background:<?= $badgeBg ?>; color:<?= $badgeCol ?>; border: 2px solid <?= $badgeCol ?>"><?= esc($i['status_izin']) ?></span>
                    </div>
                    <?php if ($status !== 'disetujui' && $status !== 'ditolak' && $status !== 'selesai'): ?>
                        <div class="flex space-x-2">
                            <button type="button"
                                class="organic-shape px-4 py-1.5 text-xs font-bold font-kalam text-center cursor-pointer transition-all duration-200 btn-open-approve-modal"
                                data-id="<?= $i['id'] ?>"
                                data-karyawan="<?= esc($i['nama_lengkap'] ?? 'Karyawan Dihapus') ?>"
                                data-judul="<?= esc($i['judul'] ?? 'Dihapus') ?>"
                                style="background:var(--surface); color:var(--txt); border:2px solid var(--txt)"
                                onmouseover="this.style.background='var(--primary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
                                onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)'; this.style.transform='translateY(0)';">Setujui</button>
                            <button type="button"
                                class="organic-shape px-4 py-1.5 text-xs font-bold font-kalam text-center cursor-pointer transition-all duration-200 btn-open-reject-modal"
                                data-id="<?= $i['id'] ?>"
                                data-karyawan="<?= esc($i['nama_lengkap'] ?? 'Karyawan Dihapus') ?>"
                                data-judul="<?= esc($i['judul'] ?? 'Dihapus') ?>"
                                style="background:var(--surface); color:var(--txt); border:2px solid var(--txt)"
                                onmouseover="this.style.background='var(--secondary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
                                onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)'; this.style.transform='translateY(0)';">Tolak</button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Modal Detail Pengajuan Admin -->
<div id="adminDetailModal" style="display: none; position: fixed; inset: 0; background: rgba(61, 64, 91, 0.6); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); z-index: 9999; justify-content: center; align-items: center; padding: 20px;">
    <div class="organic-shape" style="background: var(--surface); width: 100%; max-width: 500px; border: 3px solid var(--txt); box-shadow: 6px 6px 0px var(--txt); display: flex; flex-direction: column; overflow: hidden; animation: pop-in 0.3s cubic-bezier(0.34,1.56,0.64,1);">
        <!-- Modal Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-bottom: 2px solid var(--txt); background: #f2e8cf;">
            <h3 class="text-lg font-bold font-kalam m-0" style="color: var(--txt);">Detail Permohonan Izin</h3>
            <button type="button" id="closeAdminDetailModal" class="organic-shape w-8 h-8 bg-white flex items-center justify-center text-gray-600 transition-all cursor-pointer"
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
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1" style="color:var(--txt);">Nama Karyawan:</p>
                    <p id="adminDetailKaryawan" class="text-sm font-bold font-kalam" style="color:var(--muted);"></p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1" style="color:var(--txt);">Judul Berkas:</p>
                    <p id="adminDetailTitle" class="text-sm font-bold font-kalam" style="color:var(--muted);"></p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1" style="color:var(--txt);">Status:</p>
                    <span id="adminDetailStatus" class="inline-block px-3 py-1.5 organic-shape text-xs font-bold font-kalam"></span>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1" style="color:var(--txt);">Tanggal Pengajuan:</p>
                    <p id="adminDetailDate" class="text-xs font-bold font-kalam" style="color:var(--muted);"></p>
                </div>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1.5" style="color:var(--txt);">Alasan Mengakses:</p>
                <p id="adminDetailMessage" class="text-sm font-kalam p-3 rounded italic" style="background:rgba(61,64,91,0.04); border:1.5px solid var(--txt); color:var(--txt); line-height: 1.5; word-break: break-word; white-space: pre-wrap;"></p>
            </div>
            <div id="adminDetailRejectionBlock" style="display: none;">
                <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1.5" style="color:var(--txt);">Alasan Penolakan (Admin):</p>
                <p id="adminDetailRejection" class="text-sm font-kalam p-3 rounded italic" style="background:rgba(224,122,95,0.04); border:1.5px solid var(--secondary); color:var(--secondary); line-height: 1.5; word-break: break-word; white-space: pre-wrap;"></p>
            </div>
            <div class="flex justify-end mt-2">
                <button type="button" id="closeAdminDetailBtn" class="organic-shape px-5 py-2 text-sm font-bold font-kalam cursor-pointer text-white"
                        style="background:var(--primary); border:2px solid var(--txt); box-shadow: 2px 2px 0 var(--txt);">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Setujui Izin Akses (Admin) -->
<div id="adminApproveModal" style="display: none; position: fixed; inset: 0; background: rgba(61, 64, 91, 0.6); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); z-index: 9999; justify-content: center; align-items: center; padding: 20px;">
    <div class="organic-shape" style="background: var(--surface); width: 100%; max-width: 500px; border: 3px solid var(--txt); box-shadow: 6px 6px 0px var(--txt); display: flex; flex-direction: column; overflow: hidden; animation: pop-in 0.3s cubic-bezier(0.34,1.56,0.64,1);">
        <!-- Modal Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-bottom: 2px solid var(--txt); background: #f2e8cf;">
            <h3 class="text-lg font-bold font-kalam m-0" style="color: var(--txt);">Setujui Permohonan Izin</h3>
            <button type="button" id="closeAdminApproveModal" class="organic-shape w-8 h-8 bg-white flex items-center justify-center text-gray-600 transition-all cursor-pointer"
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
        <form action="" method="POST" id="adminApproveForm"
              data-confirm-title="Setujui Permohonan"
              data-confirm-text="Apakah Anda yakin ingin menyetujui permohonan izin akses ini?"
              data-confirm-btn="Setujui">
            <?= csrf_field() ?>
            <div class="p-6 flex flex-col gap-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1" style="color:var(--txt);">Karyawan:</p>
                        <p id="adminApproveKaryawan" class="text-sm font-bold font-kalam" style="color:var(--muted);"></p>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1" style="color:var(--txt);">Nama Berkas:</p>
                        <p id="adminApproveTitle" class="text-sm font-bold font-kalam" style="color:var(--muted);"></p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="adminApproveTglPinjam" class="text-xs font-bold uppercase tracking-wider font-kalam mb-1 block" style="color:var(--txt);">Tanggal Pinjam:</label>
                        <input type="date" name="tanggal_pinjam" id="adminApproveTglPinjam" required class="w-full organic-shape p-2 text-sm font-bold font-kalam focus:ring-0 focus:outline-none" style="background:#fffcf2; border:2px solid var(--txt); color:var(--txt);">
                    </div>
                    <div>
                        <label for="adminApproveTglKembali" class="text-xs font-bold uppercase tracking-wider font-kalam mb-1 block" style="color:var(--txt);">Tanggal Kembali:</label>
                        <input type="date" name="tanggal_kembali" id="adminApproveTglKembali" required class="w-full organic-shape p-2 text-sm font-bold font-kalam focus:ring-0 focus:outline-none" style="background:#fffcf2; border:2px solid var(--txt); color:var(--txt);">
                    </div>
                </div>
                <div class="flex justify-end gap-3.5 mt-2">
                    <button type="button" id="cancelAdminApproveBtn" class="organic-shape px-4 py-2 text-sm font-bold font-kalam cursor-pointer"
                            style="background:var(--surface); color:var(--txt); border:2px solid var(--txt);">Batal</button>
                    <button type="submit" class="organic-shape px-5 py-2 text-sm font-bold font-kalam cursor-pointer text-white"
                            style="background:var(--primary); border:2px solid var(--txt); box-shadow: 2px 2px 0 var(--txt);">Setujui & Distribusikan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Tolak Izin Akses (Admin) -->
<div id="adminRejectModal" style="display: none; position: fixed; inset: 0; background: rgba(61, 64, 91, 0.6); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); z-index: 9999; justify-content: center; align-items: center; padding: 20px;">
    <div class="organic-shape" style="background: var(--surface); width: 100%; max-width: 500px; border: 3px solid var(--txt); box-shadow: 6px 6px 0px var(--txt); display: flex; flex-direction: column; overflow: hidden; animation: pop-in 0.3s cubic-bezier(0.34,1.56,0.64,1);">
        <!-- Modal Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-bottom: 2px solid var(--txt); background: #f2e8cf;">
            <h3 class="text-lg font-bold font-kalam m-0" style="color: var(--txt);">Tolak Permohonan Izin</h3>
            <button type="button" id="closeAdminRejectModal" class="organic-shape w-8 h-8 bg-white flex items-center justify-center text-gray-600 transition-all cursor-pointer"
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
        <form action="" method="POST" id="adminRejectForm"
              data-confirm-title="Tolak Permohonan"
              data-confirm-text="Apakah Anda yakin ingin menolak permohonan izin akses ini?"
              data-confirm-btn="Tolak">
            <?= csrf_field() ?>
            <div class="p-6 flex flex-col gap-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1" style="color:var(--txt);">Karyawan:</p>
                        <p id="adminRejectKaryawan" class="text-sm font-bold font-kalam" style="color:var(--muted);"></p>
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider font-kalam mb-1" style="color:var(--txt);">Nama Berkas:</p>
                        <p id="adminRejectTitle" class="text-sm font-bold font-kalam" style="color:var(--muted);"></p>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="adminRejectPesan" class="text-xs font-bold uppercase tracking-wider font-kalam m-0" style="color:var(--txt);">Alasan Penolakan / Catatan Admin:</label>
                        <span id="adminRejectPesanCounter" class="text-[10px] font-bold font-kalam" style="color:var(--muted)">0 / 200 karakter</span>
                    </div>
                    <textarea name="pesan_admin" id="adminRejectPesan" required rows="4" maxlength="200" class="w-full organic-shape p-3 text-sm font-bold font-kalam focus:ring-0 focus:outline-none"
                              style="background:#fffcf2; border:2px solid var(--txt); color:var(--txt);"
                              placeholder="Tulis alasan penolakan di sini agar karyawan mengetahui alasannya..."></textarea>
                </div>
                <div class="flex justify-end gap-3.5 mt-2">
                    <button type="button" id="cancelAdminRejectBtn" class="organic-shape px-4 py-2 text-sm font-bold font-kalam cursor-pointer"
                            style="background:var(--surface); color:var(--txt); border:2px solid var(--txt);">Batal</button>
                    <button type="submit" class="organic-shape px-5 py-2 text-sm font-bold font-kalam cursor-pointer text-white"
                            style="background:var(--secondary); border:2px solid var(--txt); box-shadow: 2px 2px 0 var(--txt);">Tolak Permohonan</button>
                </div>
            </div>
        </form>
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
        gsap.fromTo('.anim-item', {
            y: -10,
            opacity: 0
        }, {
            y: 0,
            opacity: 1,
            duration: .35,
            stagger: .04,
            ease: 'back.out(1.5)',
            delay: .15
        });
        initSearch({
            panelId: 'searchPanel',
            inputId: 'searchInput',
            items: '.anim-item',
            emptyId: 'searchEmpty',
            countId: 'searchCount',
            filterAttrs: [{
                attr: 'status',
                pillsSelector: '.sf-chip[data-filter-status]'
            }]
        });

        // Logika Admin Detail Modal
        const adminDetailModal = document.getElementById('adminDetailModal');
        const adminDetailKaryawan = document.getElementById('adminDetailKaryawan');
        const adminDetailTitle = document.getElementById('adminDetailTitle');
        const adminDetailStatus = document.getElementById('adminDetailStatus');
        const adminDetailDate = document.getElementById('adminDetailDate');
        const adminDetailMessage = document.getElementById('adminDetailMessage');
        const closeAdminDetailModalBtn = document.getElementById('closeAdminDetailModal');
        const closeAdminDetailBtn = document.getElementById('closeAdminDetailBtn');

        document.querySelectorAll('.btn-open-admin-detail').forEach(btn => {
            btn.addEventListener('click', () => {
                const karyawan = btn.dataset.karyawan;
                const judul = btn.dataset.judul;
                const status = btn.dataset.status;
                const pesan = btn.dataset.pesan;
                const pesanAdmin = btn.dataset.pesanAdmin;
                const tgl = btn.dataset.tgl;

                if (adminDetailKaryawan) adminDetailKaryawan.textContent = karyawan;
                if (adminDetailTitle) adminDetailTitle.textContent = judul;
                if (adminDetailDate) adminDetailDate.textContent = tgl;
                if (adminDetailMessage) adminDetailMessage.textContent = pesan;
                
                const rejectBlock = document.getElementById('adminDetailRejectionBlock');
                const rejectText = document.getElementById('adminDetailRejection');
                if (rejectBlock && rejectText) {
                    if (status.toLowerCase() === 'ditolak') {
                        rejectText.textContent = pesanAdmin || 'Permohonan ditolak oleh Administrator.';
                        rejectBlock.style.display = 'block';
                    } else {
                        rejectBlock.style.display = 'none';
                    }
                }

                if (adminDetailStatus) {
                    adminDetailStatus.textContent = status;
                    adminDetailStatus.className = 'inline-block px-3 py-1.5 organic-shape text-xs font-bold font-kalam';
                    
                    const s = status.toLowerCase();
                    if (s === 'pending') {
                        adminDetailStatus.style.background = '#fef3c7'; // Soft yellow
                        adminDetailStatus.style.color = '#92400e';
                        adminDetailStatus.style.border = '1.5px solid #92400e';
                    } else if (s === 'ditolak') {
                        adminDetailStatus.style.background = '#fee2e2'; // Soft red
                        adminDetailStatus.style.color = '#991b1b';
                        adminDetailStatus.style.border = '1.5px solid #991b1b';
                    } else {
                        adminDetailStatus.style.background = '#d1fae5'; // Soft green
                        adminDetailStatus.style.color = '#065f46';
                        adminDetailStatus.style.border = '1.5px solid #065f46';
                    }
                }

                if (adminDetailModal) adminDetailModal.style.display = 'flex';
            });
        });

        const closeAdminDetail = () => {
            if (adminDetailModal) adminDetailModal.style.display = 'none';
        };

        if (closeAdminDetailModalBtn) closeAdminDetailModalBtn.addEventListener('click', closeAdminDetail);
        if (closeAdminDetailBtn) closeAdminDetailBtn.addEventListener('click', closeAdminDetail);

        window.addEventListener('click', e => {
            if (e.target === adminDetailModal) {
                closeAdminDetail();
            }
        });

        // Logika Admin Reject Modal
        const adminRejectModal = document.getElementById('adminRejectModal');
        const adminRejectForm = document.getElementById('adminRejectForm');
        const adminRejectKaryawan = document.getElementById('adminRejectKaryawan');
        const adminRejectTitle = document.getElementById('adminRejectTitle');
        const adminRejectPesan = document.getElementById('adminRejectPesan');
        const adminRejectPesanCounter = document.getElementById('adminRejectPesanCounter');
        const closeAdminRejectModalBtn = document.getElementById('closeAdminRejectModal');
        const cancelAdminRejectBtn = document.getElementById('cancelAdminRejectBtn');

        document.querySelectorAll('.btn-open-reject-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                const reqId = btn.dataset.id;
                const karyawan = btn.dataset.karyawan;
                const judul = btn.dataset.judul;

                if (adminRejectForm) {
                    adminRejectForm.action = `<?= base_url('admin/izin/reject') ?>/${reqId}`;
                }
                if (adminRejectKaryawan) adminRejectKaryawan.textContent = karyawan;
                if (adminRejectTitle) adminRejectTitle.textContent = judul;
                if (adminRejectPesan) {
                    adminRejectPesan.value = '';
                    if (adminRejectPesanCounter) adminRejectPesanCounter.textContent = '0 / 200 karakter';
                }

                if (adminRejectModal) adminRejectModal.style.display = 'flex';
            });
        });

        if (adminRejectPesan) {
            adminRejectPesan.addEventListener('input', () => {
                const count = adminRejectPesan.value.length;
                if (adminRejectPesanCounter) adminRejectPesanCounter.textContent = `${count} / 200 karakter`;
            });
        }

        const closeAdminReject = () => {
            if (adminRejectModal) adminRejectModal.style.display = 'none';
        };

        if (closeAdminRejectModalBtn) closeAdminRejectModalBtn.addEventListener('click', closeAdminReject);
        if (cancelAdminRejectBtn) cancelAdminRejectBtn.addEventListener('click', closeAdminReject);

        window.addEventListener('click', e => {
            if (e.target === adminRejectModal) {
                closeAdminReject();
            }
        });

        // Logika Admin Approve Modal
        const adminApproveModal = document.getElementById('adminApproveModal');
        const adminApproveForm = document.getElementById('adminApproveForm');
        const adminApproveKaryawan = document.getElementById('adminApproveKaryawan');
        const adminApproveTitle = document.getElementById('adminApproveTitle');
        const adminApproveTglPinjam = document.getElementById('adminApproveTglPinjam');
        const adminApproveTglKembali = document.getElementById('adminApproveTglKembali');
        const closeAdminApproveModalBtn = document.getElementById('closeAdminApproveModal');
        const cancelAdminApproveBtn = document.getElementById('cancelAdminApproveBtn');

        document.querySelectorAll('.btn-open-approve-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                const reqId = btn.dataset.id;
                const karyawan = btn.dataset.karyawan;
                const judul = btn.dataset.judul;

                if (adminApproveForm) {
                    adminApproveForm.action = `<?= base_url('admin/izin/approve') ?>/${reqId}`;
                }
                if (adminApproveKaryawan) adminApproveKaryawan.textContent = karyawan;
                if (adminApproveTitle) adminApproveTitle.textContent = judul;

                // Default: tanggal pinjam hari ini, tanggal kembali hari ini + 7 hari
                const today = new Date().toISOString().split('T')[0];
                const nextWeek = new Date();
                nextWeek.setDate(nextWeek.getDate() + 7);
                const nextWeekStr = nextWeek.toISOString().split('T')[0];

                if (adminApproveTglPinjam) {
                    adminApproveTglPinjam.value = today;
                    adminApproveTglPinjam.min = today; // Tanggal pinjam minimal hari ini
                }
                if (adminApproveTglKembali) {
                    adminApproveTglKembali.value = nextWeekStr;
                    adminApproveTglKembali.min = today; // Tanggal kembali minimal hari ini
                }

                if (adminApproveModal) adminApproveModal.style.display = 'flex';
            });
        });

        // Update tanggal kembali min value dynamically when tanggal pinjam changes
        if (adminApproveTglPinjam && adminApproveTglKembali) {
            adminApproveTglPinjam.addEventListener('change', () => {
                const pinjamVal = adminApproveTglPinjam.value;
                adminApproveTglKembali.min = pinjamVal;
                
                // Jika tanggal kembali lebih kecil dari tanggal pinjam yang baru, sesuaikan nilainya
                if (adminApproveTglKembali.value < pinjamVal) {
                    adminApproveTglKembali.value = pinjamVal;
                }
            });
        }

        // Perlindungan tambahan saat form disubmit
        if (adminApproveForm && adminApproveTglPinjam && adminApproveTglKembali) {
            adminApproveForm.addEventListener('submit', (e) => {
                const pinjamVal = adminApproveTglPinjam.value;
                const kembaliVal = adminApproveTglKembali.value;
                const today = new Date().toISOString().split('T')[0];

                if (pinjamVal < today) {
                    alert('Tanggal pinjam tidak boleh kurang dari hari ini.');
                    e.preventDefault();
                    return false;
                }
                if (kembaliVal < pinjamVal) {
                    alert('Tanggal kembali tidak boleh kurang dari tanggal pinjam.');
                    e.preventDefault();
                    return false;
                }
            });
        }

        const closeAdminApprove = () => {
            if (adminApproveModal) adminApproveModal.style.display = 'none';
        };

        if (closeAdminApproveModalBtn) closeAdminApproveModalBtn.addEventListener('click', closeAdminApprove);
        if (cancelAdminApproveBtn) cancelAdminApproveBtn.addEventListener('click', closeAdminApprove);

        window.addEventListener('click', e => {
            if (e.target === adminApproveModal) {
                closeAdminApprove();
            }
        });
    })();
</script>
<?= $this->endSection() ?>