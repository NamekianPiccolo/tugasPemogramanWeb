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
    <!-- Tombol Cetak Laporan (Hanya muncul untuk Admin) -->
    <div class="shrink-0">
        <a id="btnPrint" href="<?= base_url('admin/riwayat/print') ?>" target="_blank" class="btn-violet px-4 py-2 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            <span>Cetak Laporan</span>
        </a>
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
    <div class="search-filter-row flex items-center justify-end flex-wrap gap-4 w-full" style="padding-top: 10px; padding-bottom: 10px;">
        <div class="flex items-center gap-4 flex-wrap">
            <div class="flex items-center space-x-1.5">
                <label for="filterTanggal" class="text-xs font-bold font-kalam" style="color:var(--txt)">Pilih Tanggal:</label>
                <input type="date" id="filterTanggal" class="organic-shape px-2.5 py-1.5 text-xs font-bold font-kalam cursor-pointer"
                    style="background:var(--surface); border:2px solid var(--txt); box-shadow: 1.5px 1.5px 0 var(--txt)">
            </div>
            <div class="flex items-center space-x-1.5">
                <label for="sortSelect" class="text-xs font-bold font-kalam" style="color:var(--txt)">Urutkan:</label>
                <select id="sortSelect" class="organic-shape px-2.5 py-1.5 text-xs font-bold font-kalam cursor-pointer"
                    style="background:var(--surface); border:2px solid var(--txt); box-shadow: 1.5px 1.5px 0 var(--txt)">
                    <option value="desc">Terbaru</option>
                    <option value="asc">Terlama</option>
                </select>
            </div>
            <div class="search-count-badge">
                <span class="scb-num" id="searchCount"><?= count($riwayat) ?></span>
                <span>dari <?= count($riwayat) ?> log</span>
            </div>
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
             data-aksi="<?= esc($aksiTag) ?>"
             data-timestamp="<?= strtotime($r['created_at']) ?>"
             data-date="<?= date('Y-m-d', strtotime($r['created_at'])) ?>">
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

    const searchInput = document.getElementById('searchInput');
    const filterTanggal = document.getElementById('filterTanggal');
    const sortSelect = document.getElementById('sortSelect');
    const countEl = document.getElementById('searchCount');
    const emptyEl = document.getElementById('searchEmpty');
    const container = document.querySelector('.list-container');

    const btnPrint = document.getElementById('btnPrint');
    function updatePrintUrl() {
        if (!btnPrint) return;
        const q = searchInput ? searchInput.value.trim() : '';
        const selectedDate = filterTanggal ? filterTanggal.value : '';
        const order = sortSelect ? sortSelect.value : 'desc';

        if (!btnPrint.dataset.baseUrl) {
            btnPrint.dataset.baseUrl = btnPrint.href;
        }

        const url = new URL(btnPrint.dataset.baseUrl);
        const params = new URLSearchParams(url.search);

        if (q) {
            params.set('search', q);
        } else {
            params.delete('search');
        }
        if (selectedDate) {
            params.set('tanggal', selectedDate);
        } else {
            params.delete('tanggal');
        }
        if (order) {
            params.set('sort', order);
        } else {
            params.delete('sort');
        }

        url.search = params.toString();
        btnPrint.href = url.toString();
    }

    function runFilter() {
        const q = searchInput.value.toLowerCase().trim();
        const selectedDate = filterTanggal ? filterTanggal.value : '';
        let visible = 0;

        document.querySelectorAll('.anim-item').forEach(card => {
            const textMatch = (card.dataset.search || '').includes(q);
            const dateMatch = !selectedDate || card.dataset.date === selectedDate;

            const show = textMatch && dateMatch;
            if (show && card.style.display === 'none') {
                card.style.display = '';
                gsap.fromTo(card, { opacity:0, y:8 }, { opacity:1, y:0, duration:0.2, ease:'power2.out' });
            } else if (!show) {
                card.style.display = 'none';
            }
            if (show) visible++;
        });

        if (countEl) countEl.textContent = visible;
        if (emptyEl) {
            emptyEl.classList.toggle('visible', visible === 0);
        }
        updatePrintUrl();
    }

    if (searchInput) {
        searchInput.addEventListener('input', runFilter);
    }
    if (filterTanggal) {
        filterTanggal.addEventListener('change', runFilter);
    }

    if (sortSelect && container) {
        sortSelect.addEventListener('change', () => {
            const items = Array.from(container.querySelectorAll('.anim-item'));
            const order = sortSelect.value;
            
            items.sort((a, b) => {
                const timeA = parseInt(a.dataset.timestamp || 0);
                const timeB = parseInt(b.dataset.timestamp || 0);
                return order === 'asc' ? timeA - timeB : timeB - timeA;
            });
            
            items.forEach(item => container.appendChild(item));
            
            gsap.fromTo(items.filter(item => item.style.display !== 'none'), 
                { y: -10, opacity: 0 }, 
                { y: 0, opacity: 1, duration: 0.3, stagger: 0.02, ease: 'power2.out' }
            );
            updatePrintUrl();
        });
    }

    updatePrintUrl();
})();
</script>
<?= $this->endSection() ?>
