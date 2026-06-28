<?= $this->extend('admin/layout') ?>



<?= $this->section('content') ?>

<!-- Page Header -->
<div class="mb-6 page-intro flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
    <div>
        <div class="flex items-center space-x-2 mb-1.5">
            <div class="w-1.5 h-5 organic-shape" style="background:var(--secondary)"></div>
            <span class="text-[11px] font-bold uppercase tracking-widest font-kalam" style="color:var(--muted)">Sistem Klasifikasi</span>
        </div>
        <h1 class="text-3xl font-bold font-kalam mb-0.5" style="color:var(--txt)">Kategori Dokumen</h1>
        <p class="text-sm mt-2" style="color:var(--muted)">Kelola kategori pengelompokkan berkas agar arsip Anda terorganisir dengan rapi.</p>
    </div>
    <a href="<?= base_url('admin/kategori/create') ?>"
       class="organic-shape px-5 py-2.5 flex items-center space-x-2 shrink-0 cursor-pointer transition-all duration-200"
       style="background:var(--primary); color:#fffcf2; border:2px solid var(--txt); box-shadow: 3px 3px 0px var(--txt)"
       onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4"/></svg>
        <span class="font-kalam font-bold text-base">Tambah Kategori</span>
    </a>
</div>

<!-- Flash Alerts -->
<?php if (session()->getFlashdata('success')): ?>
<div class="mb-5 p-3.5 flex items-center text-sm alert-ok organic-shape" style="background:rgba(132,169,140,0.15); color:var(--txt); border: 2px solid var(--primary); box-shadow: 2px 2px 0px var(--primary)">
    <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="var(--primary)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <span class="font-kalam font-bold"><?= session()->getFlashdata('success') ?></span>
</div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
<div class="mb-5 p-3.5 flex items-center text-sm alert-err organic-shape" style="background:rgba(224,122,95,0.15); color:var(--txt); border: 2px solid var(--secondary); box-shadow: 2px 2px 0px var(--secondary)">
    <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="var(--secondary)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <span class="font-kalam font-bold"><?= session()->getFlashdata('error') ?></span>
</div>
<?php endif; ?>

<!-- Stats Row -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-7 stats-row">
    <div class="glass-card p-5 flex items-center justify-between stat-card" style="background-color: #d8e2dc">
        <div>
            <p class="text-[11px] font-bold uppercase tracking-widest mb-1 font-kalam" style="color:var(--txt)">Total Kategori</p>
            <h3 class="text-4xl font-extrabold font-kalam" style="color:var(--txt)"><?= count($kategori) ?></h3>
            <p class="text-xs mt-1" style="color:var(--muted)">Terdaftar dalam sistem</p>
        </div>
        <div class="w-12 h-12 flex items-center justify-center shrink-0 organic-shape" style="background:rgba(132,169,140,0.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt)">
            <svg class="w-6 h-6" fill="none" stroke="var(--txt)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
        </div>
    </div>
    <div class="glass-card p-5 flex items-center justify-between stat-card" style="background-color: #f2e8cf">
        <div>
            <p class="text-[11px] font-bold uppercase tracking-widest mb-1 font-kalam" style="color:var(--txt)">Status Pengelompokan</p>
            <h3 class="text-lg font-bold mb-1 font-kalam" style="color:var(--txt)">Klasifikasi Terorganisir</h3>
            <p class="text-xs leading-snug" style="color:var(--muted)">Folder digital berbasis nama unik.</p>
        </div>
        <div class="w-12 h-12 flex items-center justify-center shrink-0 organic-shape" style="background:rgba(224,122,95,0.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt)">
            <svg class="w-6 h-6" fill="none" stroke="var(--txt)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
    </div>
    <div class="glass-card p-5 flex items-center justify-between stat-card" style="background-color: #fae1dd">
        <div>
            <p class="text-[11px] font-bold uppercase tracking-widest mb-1 font-kalam" style="color:var(--txt)">Standard Operating</p>
            <h3 class="text-lg font-bold mb-1 font-kalam" style="color:var(--txt)">SOP Pengarsipan</h3>
            <p class="text-xs leading-snug" style="color:var(--muted)">Setiap berkas wajib dalam satu kategori.</p>
        </div>
        <div class="w-12 h-12 flex items-center justify-center shrink-0 organic-shape" style="background:rgba(224,122,95,0.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt)">
            <svg class="w-6 h-6" fill="none" stroke="var(--txt)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
        </div>
    </div>
</div>

<!-- ── Search ── -->
<?php if (!empty($kategori)): ?>
<div id="searchPanel" class="search-panel">
    <!-- Input bar -->
    <div class="search-bar">
        <div class="search-icon-badge">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
        <input id="searchInput" type="text" class="search-bar-input" placeholder="Cari nama kategori…">
        
       
    </div>
    <!-- Filter row -->
    <div class="search-filter-row" style="display: flex; justify-content: space-between; align-items: center; width: 100%; flex-wrap: wrap; gap: 8px;">
        
        <div class="search-count-badge">
            <span class="scb-num" id="searchCount"><?= count($kategori) ?></span>
            <span>dari <?= count($kategori) ?> kategori</span>
        </div>

        <!-- Sorting options -->
        <div style="display: flex; align-items: center; gap: 6px;">
            <span class="search-filter-label">Urutkan:</span>
            <select id="sortSelect" class="sf-chip" style="outline: none; padding: 4px 12px; cursor: pointer; font-size: 12px; background-color: var(--surface);">
                <option value="nama" <?= ($sort ?? '') === 'nama' ? 'selected' : '' ?>>Nama (A-Z)</option>
                <option value="nama_desc" <?= ($sort ?? '') === 'nama_desc' ? 'selected' : '' ?>>Nama (Z-A)</option>
                <option value="tanggal_baru" <?= ($sort ?? '') === 'tanggal_baru' ? 'selected' : '' ?>>Terbaru Dibuat</option>
                <option value="tanggal_lama" <?= ($sort ?? '') === 'tanggal_lama' ? 'selected' : '' ?>>Terlama Dibuat</option>
            </select>
        </div>
    </div>
</div>
<div id="searchEmpty" class="search-empty">
    <div class="search-empty-icon">
        <svg width="30" height="30" fill="none" stroke="var(--secondary)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    </div>
    <p class="text-xl font-bold font-kalam mb-1" style="color:var(--txt)">Tidak ada hasil</p>
    <p class="text-sm" style="color:var(--muted)">Coba kata kunci yang berbeda.</p>
</div>
<?php endif; ?>


<!-- Category Grid -->
<?php if (empty($kategori)): ?>
<div class="glass-card p-14 text-center" style="background-color: #f2e8cf">
    <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center organic-shape" style="background:rgba(132,169,140,0.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt)">
        <svg class="w-8 h-8" fill="none" stroke="var(--txt)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
    </div>
    <h4 class="text-xl font-bold mb-2 font-kalam" style="color:var(--txt)">Belum Ada Kategori</h4>
    <p class="text-sm" style="color:var(--muted)">Buat kategori pertama untuk mulai mengorganisir dokumen.</p>
</div>
<?php else: ?>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 kat-grid">
    <?php foreach ($kategori as $k): ?>
    <div class="glass-card organic-shape organic-shadow kat-card flex flex-col justify-between" style="background-color: #fffcf2"
         data-search="<?= esc(strtolower($k['nama_kategori'])) ?>"
         data-name="<?= esc(strtolower($k['nama_kategori'])) ?>"
         data-created="<?= !empty($k['created_at']) ? strtotime($k['created_at']) : 0 ?>">
        <div class="p-5 pb-3">
            <div class="w-12 h-12 mb-4 flex items-center justify-center organic-shape" style="background:rgba(132,169,140,0.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt)">
                <svg class="w-6 h-6" fill="none" stroke="var(--txt)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <h4 class="text-lg font-bold mb-1 truncate font-kalam" style="color:var(--txt)" title="<?= esc($k['nama_kategori']) ?>"><?= esc($k['nama_kategori']) ?></h4>
            <p class="text-[10px]" style="color:var(--muted); font-family:'Lora',serif;">
                Dibuat: <?= !empty($k['created_at']) ? esc(date('d M Y', strtotime($k['created_at']))) : '—' ?>
            </p>
        </div>
        <div class="px-5 pb-6 pt-4 flex space-x-2" style="border-top:2px dashed rgba(61,64,91,0.15);margin-top:auto">
            <a href="<?= base_url('admin/kategori/edit/' . $k['id']) ?>"
               class="organic-shape flex-1 py-2 mb-3 text-sm font-bold font-kalam text-center cursor-pointer transition-all duration-200"
               style="background:var(--surface); color:var(--txt); border:2px solid var(--txt)"
               onmouseover="this.style.background='var(--primary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
               onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)'; this.style.transform='translateY(0)';">Edit</a>
            <a href="<?= base_url('admin/kategori/delete/' . $k['id']) ?>"
               onclick="return confirm('Hapus kategori ini?')"
               class="organic-shape flex-1 py-2 mb-3 text-sm font-bold font-kalam text-center cursor-pointer transition-all duration-200"
               style="background:var(--surface); color:var(--txt); border:2px solid var(--txt)"
               onmouseover="this.style.background='var(--secondary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
               onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)'; this.style.transform='translateY(0)';">Hapus</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<script>
(() => {
    gsap.fromTo('.page-intro', { y: -18, opacity: 0 }, { y: 0, opacity: 1, duration: .5, ease: 'back.out(1.5)' });
    gsap.fromTo('.stat-card', { y: -16, opacity: 0 }, { y: 0, opacity: 1, duration: .45, stagger: .07, ease: 'back.out(1.5)', delay: .1 });
    gsap.fromTo('.kat-card', { y: -14, opacity: 0 }, { y: 0, opacity: 1, duration: .4, stagger: .05, ease: 'back.out(1.5)', delay: .25 });
    initSearch({ panelId:'searchPanel', inputId:'searchInput', items:'.kat-card', emptyId:'searchEmpty', countId:'searchCount' });

    const sortSelect = document.getElementById('sortSelect');
    const grid = document.querySelector('.kat-grid');
    
    if (sortSelect && grid) {
        sortSelect.addEventListener('change', function() {
            const sortBy = this.value;
            const cards = Array.from(grid.querySelectorAll('.kat-card'));
            
            cards.sort((a, b) => {
                if (sortBy === 'nama') {
                    const nameA = a.getAttribute('data-name');
                    const nameB = b.getAttribute('data-name');
                    return nameA.localeCompare(nameB);
                } else if (sortBy === 'nama_desc') {
                    const nameA = a.getAttribute('data-name');
                    const nameB = b.getAttribute('data-name');
                    return nameB.localeCompare(nameA);
                } else if (sortBy === 'tanggal_baru') {
                    const dateA = parseInt(a.getAttribute('data-created')) || 0;
                    const dateB = parseInt(b.getAttribute('data-created')) || 0;
                    return dateB - dateA;
                } else if (sortBy === 'tanggal_lama') {
                    const dateA = parseInt(a.getAttribute('data-created')) || 0;
                    const dateB = parseInt(b.getAttribute('data-created')) || 0;
                    return dateA - dateB;
                }
                return 0;
            });
            
            grid.innerHTML = '';
            cards.forEach(card => grid.appendChild(card));
        });
    }
})();
</script>
<?= $this->endSection() ?>
