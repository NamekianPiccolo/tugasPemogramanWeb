<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<?php $role = session()->get('role') ?? 'admin'; ?>

<!-- Page Header -->
<div class="mb-6 page-intro flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
    <div>
        <div class="flex items-center space-x-2 mb-1.5">
            <div class="w-1.5 h-5 organic-shape" style="background:var(--primary)"></div>
            <span class="text-[11px] font-bold uppercase tracking-widest font-kalam" style="color:var(--muted)">Sirkulasi Berkas</span>
        </div>
        <h1 class="text-3xl font-bold font-kalam mb-0.5" style="color:var(--txt)">Distribusi & Peminjaman</h1>
        <p class="text-sm mt-2" style="color:var(--muted)">Pantau dan kelola riwayat peminjaman dokumen antar divisi.</p>
    </div>
    <a href="<?= base_url("$role/distribusi/create") ?>"
       class="organic-shape px-5 py-2.5 flex items-center space-x-2 shrink-0 cursor-pointer transition-all duration-200"
       style="background:var(--primary); color:#fffcf2; border:2px solid var(--txt); box-shadow: 3px 3px 0px var(--txt)"
       onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4"/></svg>
        <span class="font-kalam font-bold text-base">Catat Peminjaman</span>
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
<?php if (!empty($distribusi)): ?>
<div id="searchPanel" class="search-panel">
    <!-- Input bar -->
    <div class="search-bar">
        <div class="search-icon-badge">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
        <input id="searchInput" type="text" class="search-bar-input" placeholder="Cari nama peminjam atau dokumen…">
       
    </div>
    <!-- Filter row -->
    <div class="search-filter-row">
      
        <button class="sf-chip active" data-filter="" data-filter-status="">Semua</button>
        <button class="sf-chip" data-filter="dipinjam" data-filter-status="dipinjam">
             Dipinjam
        </button>
        <button class="sf-chip" data-filter="dikembalikan" data-filter-status="dikembalikan">
            Dikembalikan
        </button>
        <button class="sf-chip" data-filter="terlambat" data-filter-status="terlambat">
             Terlambat
        </button>
        <div class="search-count-badge">
            <span class="scb-num" id="searchCount"><?= count($distribusi) ?></span>
            <span>dari <?= count($distribusi) ?></span>
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
    <?php if (empty($distribusi)): ?>
        <div class="glass-card p-14 text-center" style="background-color: #f2e8cf">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center organic-shape" style="background:rgba(132,169,140,.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt)">
                <svg class="w-8 h-8" fill="none" stroke="var(--txt)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
            </div>
            <h4 class="text-xl font-bold mb-2 font-kalam" style="color:var(--txt)">Belum Ada Riwayat Distribusi</h4>
            <p class="text-sm" style="color:var(--muted)">Belum ada riwayat peminjaman dokumen terdaftar.</p>
        </div>
    <?php else: ?>
        <?php 
        $colors = ['#fffcf2', '#f2e8cf', '#d8e2dc', '#fae1dd'];
        $idx = 0;
        foreach ($distribusi as $d): 
            $bgCard = $colors[$idx % count($colors)];
            $idx++;
            $status = strtolower($d['status'] ?? 'dipinjam');
            // Jika status masih dipinjam dan tanggal kembali sudah terlewati hari ini, set status menjadi terlambat
            if ($status === 'dipinjam' && !empty($d['tanggal_kembali']) && $d['tanggal_kembali'] < date('Y-m-d')) {
                $status = 'terlambat';
            }

            if ($status === 'dikembalikan') { $badgeBg = 'rgba(132,169,140,0.15)'; $badgeCol = 'var(--primary)'; }
            elseif ($status === 'terlambat') { $badgeBg = 'rgba(224,122,95,0.15)'; $badgeCol = 'var(--secondary)'; }
            else { $badgeBg = 'rgba(245,158,11,0.15)'; $badgeCol = '#F59E0B'; }
        ?>
        <div class="glass-card flex flex-col md:flex-row md:items-center justify-between p-5 anim-item organic-shape"
             style="background-color: <?= $bgCard ?>"
             data-search="<?= esc(strtolower(($d['peminjam_nama'] ?? '') . ' ' . ($d['judul'] ?? ''))) ?>"
             data-status="<?= esc($status) ?>">
            <div class="flex-1 min-w-0 flex items-start md:items-center gap-5">
                <div class="w-12 h-12 flex items-center justify-center shrink-0 organic-shape"
                     style="background:rgba(132,169,140,0.15); border:2px solid var(--txt); box-shadow: 2px 2px 0px var(--txt)">
                    <span class="font-kalam font-bold text-lg" style="color:var(--txt)"><?= $idx ?></span>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-lg font-bold font-kalam truncate mb-1" style="color:var(--txt)"><?= esc($d['peminjam_nama']) ?></h4>
                    <p class="text-sm font-bold truncate mb-2" style="color:var(--muted)">
                        Dokumen: <span style="color:var(--txt)"><?= esc($d['judul'] ?? 'Dihapus') ?></span>
                    </p>
                    <div class="flex flex-wrap items-center gap-3 text-[10px] font-bold uppercase tracking-widest font-kalam" style="color:var(--dim)">
                        <span class="organic-shape px-2.5 py-1" style="background:rgba(61,64,91,0.08); border:1px solid rgba(61,64,91,0.2)">Pinjam: <?= esc(date('d M Y', strtotime($d['tanggal_pinjam']))) ?></span>
                        <span class="organic-shape px-2.5 py-1" style="background:rgba(61,64,91,0.08); border:1px solid rgba(61,64,91,0.2)">Kembali: <?= $d['tanggal_kembali'] ? esc(date('d M Y', strtotime($d['tanggal_kembali']))) : '—' ?></span>
                    </div>
                </div>
            </div>
            <div class="mt-5 md:mt-0 pt-4 md:pt-0 flex flex-row md:flex-col items-center md:items-end justify-between md:justify-center shrink-0 gap-3"
                 style="border-top:2px dashed rgba(61,64,91,0.15)">
                <span class="px-3 py-1.5 organic-shape text-[10px] font-bold font-kalam uppercase tracking-widest text-center"
                      style="background:<?= $badgeBg ?>; color:<?= $badgeCol ?>; border: 2px solid <?= $badgeCol ?>">
                    <?= esc(ucfirst($status)) ?>
                </span>
                <?php if ($role === 'admin'): ?>
                <a href="<?= base_url('admin/distribusi/delete/' . $d['id']) ?>"
                   onclick="return confirm('Hapus data distribusi ini?')"
                   class="organic-shape px-5 py-1.5 text-xs font-bold font-kalam text-center cursor-pointer transition-all duration-200"
                   style="background:var(--surface); color:var(--txt); border:2px solid var(--txt)"
                   onmouseover="this.style.background='var(--secondary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
                   onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)'; this.style.transform='translateY(0)';">Hapus</a>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
(() => {
    gsap.fromTo('.page-intro', { y: -18, opacity: 0 }, { y: 0, opacity: 1, duration: .5, ease: 'back.out(1.5)' });
    gsap.fromTo('.anim-item', { y: -10, opacity: 0 }, { y: 0, opacity: 1, duration: .35, stagger: .05, ease: 'back.out(1.5)', delay: .15 });

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
</script>
<?= $this->endSection() ?>
