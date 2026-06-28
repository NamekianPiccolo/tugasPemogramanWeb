<?= $this->extend('admin/layout') ?>



<?= $this->section('content') ?>

<!-- Page Header -->
<div class="mb-6 page-intro flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
    <div>
        <div class="flex items-center space-x-2 mb-1.5">
            <div class="w-1.5 h-5 organic-shape" style="background:var(--secondary)"></div>
            <span class="text-[11px] font-bold uppercase tracking-widest font-kalam" style="color:var(--muted)">Quality Control</span>
        </div>
        <h1 class="text-3xl font-bold font-kalam mb-0.5" style="color:var(--txt)">Tinjau Perubahan Dokumen</h1>
        <p class="text-sm mt-2" style="color:var(--muted)">Tinjau draf revisi dan pembaruan berkas dari karyawan sebelum disetujui masuk sistem utama.</p>
    </div>
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
<?php if (!empty($revisi)): ?>
<div id="searchPanel" class="search-panel">
    <!-- Input bar -->
    <div class="search-bar">
        <div class="search-icon-badge">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
        <input id="searchInput" type="text" class="search-bar-input" placeholder="Cari judul dokumen atau pengaju…">
       
    </div>
    <!-- Filter row -->
    <div class="search-filter-row">
       
        <button class="sf-chip active" data-filter="" data-filter-status="">Semua</button>
        <button class="sf-chip" data-filter="pending" data-filter-status="pending">
            Pending
        </button>
        <button class="sf-chip" data-filter="disetujui" data-filter-status="disetujui">
            Disetujui
        </button>
        <button class="sf-chip" data-filter="ditolak" data-filter-status="ditolak">
           Ditolak
        </button>
        <div class="search-count-badge">
            <span class="scb-num" id="searchCount"><?= count($revisi) ?></span>
            <span>dari <?= count($revisi) ?> revisi</span>
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
    <?php if (empty($revisi)): ?>
        <div class="glass-card p-14 text-center" style="background-color: #f2e8cf">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center organic-shape"
                 style="background:rgba(139,92,246,.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt)">
                <svg class="w-8 h-8" fill="none" stroke="var(--txt)" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </div>
            <h4 class="text-xl font-bold mb-2 font-kalam" style="color:var(--txt)">Belum Ada Pengajuan Revisi</h4>
            <p class="text-sm" style="color:var(--muted)">Belum ada draf perubahan berkas dari karyawan.</p>
        </div>
    <?php else: ?>
        <?php 
        $colors = ['#fffcf2', '#f2e8cf', '#d8e2dc', '#fae1dd'];
        $no = 1; 
        foreach ($revisi as $r): 
            $bgCard = $colors[($no-1) % count($colors)];
            
            $status = strtolower($r['status_revisi'] ?? 'pending');
            if ($status === 'disetujui') {
                $badgeBg = 'rgba(132,169,140,0.15)'; $badgeCol = 'var(--primary)';
            } elseif ($status === 'ditolak') {
                $badgeBg = 'rgba(224,122,95,0.15)'; $badgeCol = 'var(--secondary)';
            } else {
                $badgeBg = 'rgba(139,92,246,0.15)'; $badgeCol = '#8B5CF6';
            }
        ?>
        <div class="glass-card flex flex-col md:flex-row md:items-center justify-between p-5 anim-item organic-shape" 
             style="background-color: <?= $bgCard ?>"
             data-search="<?= esc(strtolower(($r['judul'] ?? '') . ' ' . ($r['judul_asli'] ?? '') . ' ' . ($r['nama_lengkap'] ?? ''))) ?>"
             data-status="<?= esc($status) ?>">
            
            <div class="flex-1 min-w-0 flex items-start md:items-center gap-5">
                <!-- Number / Icon -->
                <div class="w-12 h-12 flex items-center justify-center shrink-0 organic-shape"
                     style="background:rgba(139,92,246,0.15); border:2px solid var(--txt); box-shadow: 2px 2px 0px var(--txt)">
                    <span class="font-kalam font-bold text-lg" style="color:var(--txt)"><?= $no++ ?></span>
                </div>
                
                <!-- Details -->
                <div class="flex-1 min-w-0">
                    <h4 class="text-lg font-bold font-kalam truncate mb-1" style="color:var(--txt)" title="<?= esc($r['judul']) ?>">
                        <?= esc($r['judul']) ?>
                    </h4>
                    <p class="text-sm font-bold truncate mb-2" style="color:var(--muted)" title="<?= esc($r['judul_asli'] ?? '') ?>">
                        Revisi Dari: <span style="color:var(--txt)"><?= esc($r['judul_asli'] ?? 'Dokumen Dihapus') ?></span>
                    </p>
                    <div class="flex flex-wrap items-center gap-3 text-[10px] font-bold uppercase tracking-widest font-kalam" style="color:var(--dim)">
                        <span class="organic-shape px-2.5 py-1" style="background:rgba(61, 64, 91, 0.08); border:1px solid rgba(61, 64, 91, 0.2)">
                            Pengaju: <?= esc($r['nama_lengkap'] ?? 'Karyawan Dihapus') ?>
                        </span>
                        <span class="organic-shape px-2.5 py-1" style="background:rgba(61, 64, 91, 0.08); border:1px solid rgba(61, 64, 91, 0.2)">
                            Tanggal: <?= esc(date('d M Y H:i', strtotime($r['created_at']))) ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Actions & Status -->
            <div class="mt-5 md:mt-0 pt-4 md:pt-0 flex flex-row md:flex-col items-center md:items-end justify-between md:justify-center shrink-0 gap-3"
                 style="border-top:2px dashed rgba(61, 64, 91, 0.15); border-top-width: 2px">
                <span class="px-3 py-1.5 organic-shape text-[10px] font-bold font-kalam uppercase tracking-widest text-center"
                      style="background:<?= $badgeBg ?>; color:<?= $badgeCol ?>; border: 2px solid <?= $badgeCol ?>">
                    <?= esc($r['status_revisi']) ?>
                </span>
                
                <div class="flex space-x-2">
                    <button onclick='openCompareModal(<?= htmlspecialchars(json_encode($r), ENT_QUOTES, "UTF-8") ?>)'
                            class="organic-shape px-4 py-1.5 text-xs font-bold font-kalam text-center cursor-pointer transition-all duration-200"
                            style="background:var(--surface); color:var(--txt); border:2px solid var(--txt)"
                            onmouseover="this.style.background='var(--primary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
                            onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)'; this.style.transform='translateY(0)';">
                        Detail
                    </button>
                    <?php if ($status === 'pending'): ?>
                    <a href="<?= base_url('admin/revisi/approve/' . $r['id']) ?>"
                       class="organic-shape px-4 py-1.5 text-xs font-bold font-kalam text-center cursor-pointer transition-all duration-200"
                       style="background:var(--surface); color:var(--txt); border:2px solid var(--txt)"
                       onmouseover="this.style.background='var(--primary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
                       onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)'; this.style.transform='translateY(0)';">
                        Terapkan
                    </a>
                    <button onclick="openRejectModal(<?= $r['id'] ?>)"
                            class="organic-shape px-4 py-1.5 text-xs font-bold font-kalam text-center cursor-pointer transition-all duration-200"
                            style="background:var(--surface); color:var(--txt); border:2px solid var(--txt)"
                            onmouseover="this.style.background='var(--secondary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
                            onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)'; this.style.transform='translateY(0)';">
                        Tolak
                    </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Compare Modal -->
<div id="compareModal" style="display:none;position:fixed;top:0;left:280px;right:0;bottom:0;z-index:99999;backdrop-filter:blur(8px);background:rgba(255,255,255,.7);align-items:center;justify-content:center">
    <div class="glass-card w-full max-w-5xl mx-4 relative" style="border-radius:20px;max-height:90vh;overflow:hidden;display:flex;flex-direction:column">
        <div class="ca ca-tl"></div><div class="ca ca-tr"></div><div class="ca ca-bl"></div><div class="ca ca-br"></div>

        <div class="p-6 shrink-0" style="border-bottom:1px solid rgba(139,92,246,.12)">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-bold grad-violet">Detail Perbandingan Revisi</h3>
                <button onclick="closeCompareModal()" class="w-7 h-7 rounded-lg flex items-center justify-center cursor-pointer btn-outline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6 overflow-y-auto" id="compareContent" style="flex:1"></div>
        <div class="p-6 shrink-0 flex justify-end gap-3" id="compareFooter" style="border-top:1px solid rgba(139,92,246,.12); background:#fffcf2; display:none;"></div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" style="display:none;position:fixed;top:0;left:280px;right:0;bottom:0;z-index:99999;backdrop-filter:blur(8px);background:rgba(255,255,255,.7);align-items:center;justify-content:center">
    <div class="glass-card w-full max-w-md mx-4 relative" style="border-radius:20px">
        <div class="ca ca-tl"></div><div class="ca ca-tr"></div><div class="ca ca-bl"></div><div class="ca ca-br"></div>

        <div class="p-6">
            <h3 class="text-sm font-bold mb-4" style="color:#F87171">Tolak Pengajuan Revisi</h3>
            <form id="rejectForm" method="POST">
                <?= csrf_field() ?>
                <div class="mb-4">
                    <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(239,68,68,.7)">Alasan Penolakan</label>
                    <textarea name="pesan_admin" rows="3" placeholder="Masukkan alasan penolakan..."
                              class="glass-input w-full px-3 py-2 text-xs" style="resize:none;border-radius:10px"></textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="closeRejectModal()"
                            class="btn-outline flex-1 py-2 rounded-xl text-xs font-bold cursor-pointer">Batal</button>
                    <button type="submit"
                            class="btn-danger flex-1 py-2 rounded-xl text-xs font-bold cursor-pointer"
                            style="background:rgba(239,68,68,.15)">Konfirmasi Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
(() => {
    gsap.fromTo('.page-intro', { y: -18, opacity: 0 }, { y: 0, opacity: 1, duration: .5, ease: 'back.out(1.5)' });
    gsap.fromTo('.anim-item', { y: -10, opacity: 0 }, { y: 0, opacity: 1, duration: .35, stagger: .04, ease: 'back.out(1.5)', delay: .15 });

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
})();

function openCompareModal(data) {
    const m = document.getElementById('compareModal');
    const c = document.getElementById('compareContent');
    c.innerHTML = `
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="p-4 rounded-xl flex flex-col justify-between" style="background:rgba(239,68,68,.06);border:1px solid rgba(239,68,68,.2)">
                <div>
                    <p class="text-[9px] font-bold uppercase tracking-widest mb-2" style="color:rgba(248,113,113,.7)">Versi Asli</p>
                    <p class="text-sm font-bold mb-1" style="color:var(--txt)">${data.judul_asli ?? '-'}</p>
                    <p class="text-xs mb-3" style="color:var(--muted)">${data.deskripsi_asli ?? 'Tidak ada deskripsi.'}</p>
                </div>
                ${data.file_asli ? `
                <a href="<?= base_url('uploads/') ?>${data.file_asli}" target="_blank" class="mt-3 inline-flex items-center gap-1.5 text-xs font-bold font-kalam hover:underline mb-2" style="color:var(--secondary)">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh File Asli
                </a>
                <div id="preview-asli-container" class="mt-2 overflow-hidden rounded-lg border border-red-200" style="height: 380px; display: none;">
                    <iframe id="iframe-asli" src="" style="width:100%; height:100%; border:none; display:none;"></iframe>
                    <div id="docx-asli" style="width:100%; height:100%; overflow:auto; background:white; padding:10px; display:none;"></div>
                </div>` : '<p class="text-[10px] text-gray-400 mt-3 font-kalam">Tidak ada file asli</p>'}
            </div>
            <div class="p-4 rounded-xl flex flex-col justify-between" style="background:rgba(16,185,129,.06);border:1px solid rgba(16,185,129,.2)">
                <div>
                    <p class="text-[9px] font-bold uppercase tracking-widest mb-2" style="color:rgba(52,211,153,.7)">Revisi Diajukan</p>
                    <p class="text-sm font-bold mb-1" style="color:var(--txt)">${data.judul ?? '-'}</p>
                    <p class="text-xs mb-3" style="color:var(--muted)">${data.deskripsi ?? 'Tidak ada deskripsi.'}</p>
                </div>
                ${data.file_dokumen ? `
                <a href="<?= base_url('uploads/') ?>${data.file_dokumen}" target="_blank" class="mt-3 inline-flex items-center gap-1.5 text-xs font-bold font-kalam hover:underline mb-2" style="color:var(--primary)">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh File Revisi
                </a>
                <div id="preview-revisi-container" class="mt-2 overflow-hidden rounded-lg border border-green-200" style="height: 380px; display: none;">
                    <iframe id="iframe-revisi" src="" style="width:100%; height:100%; border:none; display:none;"></iframe>
                    <div id="docx-revisi" style="width:100%; height:100%; overflow:auto; background:white; padding:10px; display:none;"></div>
                </div>` : '<p class="text-[10px] text-gray-400 mt-3 font-kalam">Tidak ada file revisi</p>'}
            </div>
        </div>
        <div class="p-4 rounded-xl" style="background:rgba(139,92,246,.06); border:1px solid rgba(139,92,246,.15); margin-top: 24px;">
            <p class="text-[11px] font-bold uppercase tracking-widest mb-1.5" style="color:#8B5CF6">Pengaju</p>
            <p style="color:var(--txt); font-size:14px; font-weight:700;">${data.nama_lengkap ?? '-'} <span style="font-weight:500; color:var(--muted); font-size:12px; margin-left: 4px;">— ${data.created_at ?? '-'}</span></p>
        </div>
        <div class="p-4 rounded-xl" style="background:rgba(245,158,11,.08); border:1px solid rgba(245,158,11,.25); margin-top: 20px;">
            <p class="text-[11px] font-bold uppercase tracking-widest mb-1.5" style="color:#D97706">Pesan / Catatan Revisi Karyawan</p>
            <p style="color:var(--txt); font-style: italic; font-family:'Lora',serif; font-size:15px; line-height:1.6; white-space:pre-wrap;">"${data.pesan_revisi ? data.pesan_revisi : 'Tidak ada catatan perubahan.'}"</p>
        </div>`;

    m.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    gsap.fromTo(m.firstElementChild, { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: .4, ease: 'expo.out' });

    // Render original file preview if exists
    if (data.file_asli) {
        const fileUrl = `<?= base_url('uploads/') ?>${data.file_asli}`;
        const isPdf = fileUrl.toLowerCase().endsWith('.pdf');
        const isDocx = fileUrl.toLowerCase().endsWith('.docx');
        const container = document.getElementById('preview-asli-container');
        const iframe = document.getElementById('iframe-asli');
        const docxDiv = document.getElementById('docx-asli');
        
        if (isPdf) {
            container.style.display = 'block';
            iframe.src = fileUrl;
            iframe.style.display = 'block';
        } else if (isDocx) {
            container.style.display = 'block';
            docxDiv.style.display = 'block';
            docxDiv.innerHTML = '<p class="text-[10px] text-gray-500 font-bold p-4 text-center">Memuat Word...</p>';
            fetch(fileUrl)
                .then(res => res.blob())
                .then(blob => {
                    if (typeof docx !== 'undefined') {
                        docx.renderAsync(blob, docxDiv).catch(err => {
                            docxDiv.innerHTML = '<p class="text-[10px] text-red-500 text-center p-2">Error: ' + err.message + '</p>';
                        });
                    } else {
                        docxDiv.innerHTML = '<p class="text-[10px] text-amber-600 text-center p-2">No renderer</p>';
                    }
                })
                .catch(err => {
                    docxDiv.innerHTML = '<p class="text-[10px] text-red-500 text-center p-2">Gagal memuat berkas</p>';
                });
        }
    }

    // Render revised file preview if exists
    if (data.file_dokumen) {
        const fileUrl = `<?= base_url('uploads/') ?>${data.file_dokumen}`;
        const isPdf = fileUrl.toLowerCase().endsWith('.pdf');
        const isDocx = fileUrl.toLowerCase().endsWith('.docx');
        const container = document.getElementById('preview-revisi-container');
        const iframe = document.getElementById('iframe-revisi');
        const docxDiv = document.getElementById('docx-revisi');
        
        if (isPdf) {
            container.style.display = 'block';
            iframe.src = fileUrl;
            iframe.style.display = 'block';
        } else if (isDocx) {
            container.style.display = 'block';
            docxDiv.style.display = 'block';
            docxDiv.innerHTML = '<p class="text-[10px] text-gray-500 font-bold p-4 text-center">Memuat Word...</p>';
            fetch(fileUrl)
                .then(res => res.blob())
                .then(blob => {
                    if (typeof docx !== 'undefined') {
                        docx.renderAsync(blob, docxDiv).catch(err => {
                            docxDiv.innerHTML = '<p class="text-[10px] text-red-500 text-center p-2">Error: ' + err.message + '</p>';
                        });
                    } else {
                        docxDiv.innerHTML = '<p class="text-[10px] text-amber-600 text-center p-2">No renderer</p>';
                    }
                })
                .catch(err => {
                    docxDiv.innerHTML = '<p class="text-[10px] text-red-500 text-center p-2">Gagal memuat berkas</p>';
                });
        }
    }

    // Render footer action buttons if status is pending
    const footer = document.getElementById('compareFooter');
    if (data.status_revisi.toLowerCase() === 'pending') {
        footer.style.display = 'flex';
        footer.innerHTML = `
            <button onclick="closeCompareModal()" class="organic-shape px-5 py-2 text-xs font-bold font-kalam text-center cursor-pointer transition-all duration-200" style="background:var(--surface); color:var(--txt); border:2px solid var(--txt)">
                Batal
            </button>
            <button onclick="openRejectModal(${data.id}); closeCompareModal();" class="organic-shape px-5 py-2 text-xs font-bold font-kalam text-center cursor-pointer transition-all duration-200 text-white" style="background:var(--secondary); border:2px solid var(--txt); box-shadow: 2px 2px 0px var(--txt)">
                Tolak
            </button>
            <a href="<?= base_url('admin/revisi/approve/') ?>${data.id}" class="organic-shape px-5 py-2 text-xs font-bold font-kalam text-center cursor-pointer transition-all duration-200 text-white flex items-center justify-center" style="background:var(--primary); border:2px solid var(--txt); box-shadow: 2px 2px 0px var(--txt)">
                Terapkan
            </a>
        `;
    } else {
        footer.style.display = 'none';
        footer.innerHTML = '';
    }
}
function closeCompareModal() {
    gsap.to('#compareModal', { opacity: 0, duration: .25, ease:'power2.in', onComplete: () => {
        document.getElementById('compareModal').style.display='none';
        document.body.style.overflow = '';
        gsap.set('#compareModal', {opacity:1});
        document.getElementById('compareContent').innerHTML = ''; // Clear contents
        document.getElementById('compareFooter').innerHTML = ''; // Clear footer
        document.getElementById('compareFooter').style.display = 'none';
    }});
}
function openRejectModal(id) {
    document.getElementById('rejectForm').action = `<?= base_url('admin/revisi/reject/') ?>${id}`;
    const m = document.getElementById('rejectModal');
    m.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    gsap.fromTo(m.firstElementChild, { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: .4, ease: 'expo.out' });
}
function closeRejectModal() {
    gsap.to('#rejectModal', { opacity: 0, duration: .25, ease:'power2.in', onComplete: () => {
        document.getElementById('rejectModal').style.display='none';
        document.body.style.overflow = '';
        gsap.set('#rejectModal', {opacity:1});
    }});
}
</script>
<?= $this->endSection() ?>
