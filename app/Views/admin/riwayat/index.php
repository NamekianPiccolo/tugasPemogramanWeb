<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-6 page-intro flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
    <div>
        <div class="flex items-center space-x-2 mb-1.5">
            <div class="w-1.5 h-5 organic-shape" style="background:var(--primary)"></div>
            <span class="text-[11px] font-bold uppercase tracking-widest font-kalam" style="color:var(--muted)">Audit Trail</span>
        </div>
        <h1 class="text-3xl font-bold font-kalam mb-0.5" style="color:var(--txt)">Riwayat Aktivitas</h1>
        <p class="text-sm mt-2" style="color:var(--muted)">Log lengkap semua aktivitas yang terjadi dalam sistem arsip dokumen.</p>
    </div>
</div>

<!-- ── Search ── -->
<?php if (!empty($riwayat)): ?>
<div id="searchPanel" class="search-panel">
    <!-- Input bar -->
    <div class="search-bar">
        <div class="search-icon-badge">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
        <input id="searchInput" type="text" class="search-bar-input" placeholder="Cari aktivitas, dokumen, atau username…">
       
    </div>
    <!-- Filter row -->
    <div class="search-filter-row">
       
        <button class="sf-chip active" data-filter="" data-filter-aksi="">Semua</button>
        <button class="sf-chip" data-filter="tambah" data-filter-aksi="tambah">Tambah</button>
        <button class="sf-chip" data-filter="edit" data-filter-aksi="edit">Edit</button>
        <button class="sf-chip" data-filter="hapus" data-filter-aksi="hapus">Hapus</button>
        <button class="sf-chip" data-filter="login" data-filter-aksi="login">Login</button>
        <div class="search-count-badge">
            <span class="scb-num" id="searchCount"><?= count($riwayat) ?></span>
            <span>dari <?= count($riwayat) ?> log</span>
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

<!-- Timeline Container -->
<div class="relative list-container ml-2 md:ml-6 mt-4 pb-8" style="border-left: 3px dashed rgba(132, 169, 140, 0.5)">
    
    <?php if (empty($riwayat)): ?>
    <div class="ml-8 glass-card p-14 text-center organic-shape" style="background-color: #f2e8cf">
        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center organic-shape" style="background:rgba(132,169,140,.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt)">
            <svg class="w-8 h-8" fill="none" stroke="var(--txt)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h4 class="text-xl font-bold mb-2 font-kalam" style="color:var(--txt)">Belum Ada Riwayat</h4>
        <p class="text-sm" style="color:var(--muted)">Log aktivitas akan muncul setelah pengguna mulai menggunakan sistem.</p>
    </div>
    <?php else: ?>
    
        <?php 
        $colors = ['#fffcf2', '#f2e8cf', '#d8e2dc', '#fae1dd'];
        $i = 0;
        foreach ($riwayat as $r): 
            $bgCard = $colors[$i % count($colors)];
            $i++;
            
            $aksi = strtolower($r['aksi']);
            if (strpos($aksi, 'tambah') !== false || strpos($aksi, 'buat') !== false || strpos($aksi, 'upload') !== false) {
                $iconColor = 'var(--primary)'; $aksiTag = 'tambah';
            } elseif (strpos($aksi, 'hapus') !== false) {
                $iconColor = 'var(--secondary)'; $aksiTag = 'hapus';
            } elseif (strpos($aksi, 'ubah') !== false || strpos($aksi, 'edit') !== false || strpos($aksi, 'revisi') !== false) {
                $iconColor = '#F59E0B'; $aksiTag = 'edit';
            } elseif (strpos($aksi, 'login') !== false || strpos($aksi, 'logout') !== false) {
                $iconColor = '#8B5CF6'; $aksiTag = 'login';
            } else {
                $iconColor = '#8B5CF6'; $aksiTag = 'lainnya';
            }
        ?>
        <div class="mb-10 relative anim-item pl-8 md:pl-10"
             data-search="<?= esc(strtolower(($r['username'] ?? '') . ' ' . ($r['aksi'] ?? '') . ' ' . ($r['judul'] ?? '') . ' ' . ($r['keterangan'] ?? ''))) ?>"
             data-aksi="<?= esc($aksiTag) ?>">
            <!-- Timeline Node -->
           

            <!-- Content Card -->
            <div class="glass-card organic-shape p-5 relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-4 mb-3" 
                 style="background-color: <?= $bgCard ?>">
                
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold text-white shrink-0 organic-shape"
                             style="background:linear-gradient(135deg,var(--primary),var(--secondary)); border:2px solid var(--txt)">
                            <?= strtoupper(substr($r['username'] ?? 'U', 0, 1)) ?>
                        </div>
                        <div class="min-w-0">
                            <h4 class="text-sm font-bold font-kalam truncate" style="color:var(--txt)"><?= esc($r['username'] ?? 'Sistem') ?></h4>
                            <p class="text-[10px] font-bold uppercase tracking-widest" style="color:var(--dim)"><?= esc(date('d M Y, H:i', strtotime($r['created_at']))) ?> WIB</p>
                        </div>
                    </div>

                    <h3 class="text-base font-bold font-kalam mb-1" style="color:var(--txt)"><?= esc($r['aksi']) ?></h3>
                    <p class="text-sm font-bold truncate mb-1" style="color:var(--muted)">
                        Terkait: <span style="color:var(--txt)"><?= esc($r['judul'] ?? 'Dokumen Dihapus / Tidak Ada') ?></span>
                    </p>
                    <p class="text-xs italic" style="color:var(--dim)">"<?= esc($r['keterangan']) ?>"</p>
                </div>
                
                <!-- Right Side Badge -->
                
                
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
(() => {
    gsap.fromTo('.page-intro', { y: -18, opacity: 0 }, { y: 0, opacity: 1, duration:.5, ease:'back.out(1.5)' });
    gsap.fromTo('.anim-item', { y: -10, opacity: 0 }, { y: 0, opacity: 1, duration:.35, stagger:.03, ease:'back.out(1.5)', delay:.15 });

    initSearch({
        panelId: 'searchPanel',
        inputId: 'searchInput',
        items: '.anim-item',
        emptyId: 'searchEmpty',
        countId: 'searchCount',
        filterAttrs: [
            { attr: 'aksi', pillsSelector: '.sf-chip[data-filter-aksi]' }
        ]
    });
})();
</script>
<?= $this->endSection() ?>
