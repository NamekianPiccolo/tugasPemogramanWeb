<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="mb-7 page-intro">
    <div class="flex items-center space-x-2 mb-1.5">
        <div class="w-1 h-4 rounded-full" style="background:linear-gradient(180deg,#F59E0B,#EC4899);"></div>
        <span class="text-[9px] font-bold uppercase tracking-widest" style="color:rgba(245,158,11,.65);">Access Control</span>
    </div>
    <h1 class="text-xl font-bold grad-warm mb-0.5">Status Izin Akses Saya</h1>
    <p class="text-xs" style="color:var(--muted);">Pantau status pengajuan izin akses dokumen yang telah Anda ajukan.</p>
</div>

<?php if (session()->getFlashdata('success')): ?>
<div class="mb-5 p-3.5 rounded-xl flex items-center text-xs alert-ok alert-box">
    <svg class="w-4 h-4 mr-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span class="font-semibold"><?= session()->getFlashdata('success') ?></span>
</div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
<div class="mb-5 p-3.5 rounded-xl flex items-center text-xs alert-err alert-box">
    <svg class="w-4 h-4 mr-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span class="font-semibold"><?= session()->getFlashdata('error') ?></span>
</div>
<?php endif; ?>

<!-- List Container -->
<div class="flex flex-col gap-5 list-container">
    <?php if (empty($izin)): ?>
        <div class="glass-card p-14 text-center" style="background-color: #f2e8cf;">
            <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center organic-shape"
                 style="background:rgba(245,158,11,.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt);">
                <svg class="w-8 h-8" fill="none" stroke="var(--txt)" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h4 class="text-xl font-bold mb-2 font-kalam" style="color:var(--txt);">Belum Ada Pengajuan</h4>
            <p class="text-sm" style="color:var(--muted); font-family:'Lora',serif;">Anda belum mengajukan izin akses dokumen apapun.</p>
        </div>
    <?php else: ?>
        <?php 
        $colors = ['#fffcf2', '#f2e8cf', '#d8e2dc', '#fae1dd'];
        $no=1; 
        foreach ($izin as $i): 
            $bgCard = $colors[($no-1) % count($colors)];
            
            $s = strtolower($i['status_izin'] ?? 'pending');
            if ($s === 'disetujui') {
                $badgeBg = 'rgba(132,169,140,0.15)'; $badgeCol = 'var(--primary)';
            } elseif ($s === 'ditolak') {
                $badgeBg = 'rgba(224,122,95,0.15)'; $badgeCol = 'var(--secondary)';
            } else {
                $badgeBg = 'rgba(245,158,11,0.15)'; $badgeCol = '#F59E0B';
            }
        ?>
        <div class="glass-card flex flex-col md:flex-row md:items-center justify-between p-5 anim-item organic-shape" 
             style="background-color: <?= $bgCard ?>;">
            
            <div class="flex-1 min-w-0 flex items-start md:items-center gap-5">
                <!-- Number / Icon -->
                <div class="w-12 h-12 flex items-center justify-center shrink-0 organic-shape"
                     style="background:rgba(245,158,11,0.15); border:2px solid var(--txt); box-shadow: 2px 2px 0px var(--txt);">
                    <span class="font-kalam font-bold text-lg" style="color:var(--txt);"><?= $no++ ?></span>
                </div>
                
                <!-- Details -->
                <div class="flex-1 min-w-0">
                    <h4 class="text-lg font-bold font-kalam truncate mb-1" style="color:var(--txt);" title="<?= esc($i['judul'] ?? '') ?>">
                        <?= esc($i['judul'] ?? 'Dokumen Dihapus') ?>
                    </h4>
                    <p class="text-xs mb-3 italic" style="color:var(--dim); font-family:'Lora',serif;">
                        "<?= esc($i['pesan'] ?: 'Tidak ada pesan.') ?>"
                    </p>
                    <div class="flex flex-wrap items-center gap-3 text-[10px] font-bold uppercase tracking-widest font-kalam" style="color:var(--dim);">
                        <span class="organic-shape px-2.5 py-1" style="background:rgba(61, 64, 91, 0.08); border:1px solid rgba(61, 64, 91, 0.2);">
                            Diajukan: <?= esc(date('d M Y H:i', strtotime($i['tgl_pengajuan']))) ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Actions & Status -->
            <div class="mt-5 md:mt-0 pt-4 md:pt-0 flex items-center justify-between md:justify-center shrink-0 gap-3"
                 style="border-top:2px dashed rgba(61, 64, 91, 0.15); border-top-width: 2px;">
                <span class="px-3 py-1.5 organic-shape text-[10px] font-bold font-kalam uppercase tracking-widest text-center"
                      style="background:<?= $badgeBg ?>; color:<?= $badgeCol ?>; border: 2px solid <?= $badgeCol ?>;">
                    <?= esc($i['status_izin']) ?>
                </span>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="mt-4 flex justify-end">
    <a href="<?= base_url('karyawan/izin/create') ?>"
       class="btn-violet px-4 py-2.5 rounded-xl text-xs font-bold flex items-center space-x-2 cursor-pointer">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4"/>
        </svg>
        <span>Ajukan Izin Baru</span>
    </a>
</div>

<script>
(() => {
    gsap.fromTo('.page-intro', { y: -18, opacity: 0 }, { y: 0, opacity: 1, duration:.5, ease:'power3.out' });
    gsap.fromTo('.table-container', { y: -14, opacity: 0 }, { y: 0, opacity: 1, duration:.5, ease:'power3.out', delay:.12 });
    gsap.fromTo('.anim-item', { y: -10, opacity: 0 }, { y: 0, opacity: 1, duration:.35, stagger:.04, ease:'power2.out', delay:.2 });
})();
</script>
<?= $this->endSection() ?>
