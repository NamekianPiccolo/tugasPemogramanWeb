<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="mb-7 page-intro flex justify-between items-center">
    <div>
        <div class="flex items-center space-x-2 mb-1.5">
            <div class="w-1 h-4 rounded-full" style="background:linear-gradient(180deg,#8B5CF6,#EC4899);"></div>
            <span class="text-[9px] font-bold uppercase tracking-widest" style="color:rgba(139,92,246,.65);">Audit Trail</span>
        </div>
        <h1 class="text-xl font-bold grad-violet mb-0.5">Riwayat Aktivitas</h1>
        <p class="text-xs" style="color:var(--muted);">Log lengkap semua aktivitas yang terjadi dalam sistem arsip dokumen.</p>
    </div>
</div>

<!-- Timeline Container -->
<div class="relative list-container ml-2 md:ml-6 mt-4 pb-8" style="border-left: 3px dashed rgba(139, 92, 246, 0.3);">
    
    <?php if (empty($riwayat)): ?>
    <div class="ml-8 glass-card p-14 text-center organic-shape" style="background-color: #f2e8cf;">
        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center organic-shape"
             style="background:rgba(139,92,246,.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt);">
            <svg class="w-8 h-8" fill="none" stroke="var(--txt)" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h4 class="text-xl font-bold mb-2 font-kalam" style="color:var(--txt);">Belum Ada Riwayat</h4>
        <p class="text-sm" style="color:var(--muted); font-family:'Lora',serif;">Log aktivitas akan muncul setelah pengguna mulai menggunakan sistem.</p>
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
                $iconColor = '#10B981'; // green
            } elseif (strpos($aksi, 'hapus') !== false) {
                $iconColor = '#EF4444'; // red
            } elseif (strpos($aksi, 'ubah') !== false || strpos($aksi, 'edit') !== false || strpos($aksi, 'revisi') !== false) {
                $iconColor = '#F59E0B'; // yellow
            } else {
                $iconColor = '#8B5CF6'; // purple default
            }
        ?>
        <div class="mb-8 relative anim-item pl-8 md:pl-10">
            <!-- Timeline Node -->
            <div class="absolute -left-3.5 top-4 w-7 h-7 rounded-full organic-shape z-10 flex items-center justify-center"
                 style="background:<?= $iconColor ?>; border:2px solid var(--txt); box-shadow: 2px 2px 0px var(--txt);">
                <div class="w-2.5 h-2.5 rounded-full" style="background:#fffcf2; border:1px solid var(--txt);"></div>
            </div>

            <!-- Content Card -->
            <div class="glass-card organic-shape p-5 relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-4" 
                 style="background-color: <?= $bgCard ?>;">
                
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-3 mb-2">
                        <!-- User Initial Badge -->
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold text-white shrink-0 organic-shape"
                             style="background:linear-gradient(135deg,#7C3AED,#06B6D4); border:2px solid var(--txt);">
                            <?= strtoupper(substr($r['username'] ?? 'U', 0, 1)) ?>
                        </div>
                        
                        <div class="min-w-0">
                            <h4 class="text-sm font-bold font-kalam truncate" style="color:var(--txt);">
                                <?= esc($r['username'] ?? 'Sistem') ?>
                            </h4>
                            <p class="text-[10px] font-bold uppercase tracking-widest" style="color:var(--dim);">
                                <?= esc(date('d M Y, H:i', strtotime($r['created_at']))) ?> WIB
                            </p>
                        </div>
                    </div>

                    <h3 class="text-base font-bold font-kalam mb-1" style="color:var(--txt);">
                        <?= esc($r['aksi']) ?>
                    </h3>
                    
                    <p class="text-sm font-bold truncate mb-1" style="color:var(--muted); font-family:'Lora',serif;" title="<?= esc($r['judul'] ?? '') ?>">
                        Terkait: <span style="color:var(--txt);"><?= esc($r['judul'] ?? 'Dokumen Dihapus / Tidak Ada') ?></span>
                    </p>
                    <p class="text-xs italic" style="color:var(--dim); font-family:'Lora',serif;">
                        "<?= esc($r['keterangan']) ?>"
                    </p>
                </div>
                
                <!-- Right Side Badge -->
                <div class="shrink-0 md:self-end text-right">
                    <span class="organic-shape px-3 py-1.5 text-[10px] font-bold font-kalam uppercase tracking-widest inline-block"
                          style="background:rgba(255,255,255,0.4); border:1px solid rgba(61, 64, 91, 0.2); color:var(--dim);">
                        Audit Log
                    </span>
                </div>
                
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
(() => {
    gsap.fromTo('.page-intro', { y: -18, opacity: 0 }, { y: 0, opacity: 1, duration:.5, ease:'power3.out' });
    gsap.fromTo('.table-container', { y: -14, opacity: 0 }, { y: 0, opacity: 1, duration:.5, ease:'power3.out', delay:.12 });
    gsap.fromTo('.anim-item', { y: -10, opacity: 0 }, { y: 0, opacity: 1, duration:.35, stagger:.03, ease:'power2.out', delay:.2 });
})();
</script>
<?= $this->endSection() ?>
