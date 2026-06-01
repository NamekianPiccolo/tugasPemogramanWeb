<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<!-- Page Header -->
<div class="mb-7 page-intro flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
    <div>
        <div class="flex items-center space-x-2 mb-1.5">
            <div class="w-1.5 h-5 organic-shape" style="background:var(--primary);"></div>
            <span class="text-[11px] font-bold uppercase tracking-widest font-kalam" style="color:var(--muted);">Akses & Identitas</span>
        </div>
        <h1 class="text-3xl font-bold font-kalam mb-0.5" style="color:var(--txt);">Manajemen User</h1>
        <p class="text-sm mt-2" style="color:var(--muted); font-family:'Lora',serif;">Kelola akun pengguna sistem — admin maupun karyawan.</p>
    </div>
    
    <a href="<?= base_url('admin/user/create') ?>"
       class="organic-shape px-5 py-2.5 flex items-center space-x-2 shrink-0 cursor-pointer transition-all duration-200"
       style="background:var(--primary); color:#fffcf2; border:2px solid var(--txt); box-shadow: 3px 3px 0px var(--txt);"
       onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
        </svg>
        <span class="font-kalam font-bold text-base">Tambah User</span>
    </a>
</div>

<!-- Flash Alerts -->
<?php if (session()->getFlashdata('success')): ?>
<div class="mb-5 p-3.5 rounded-xl flex items-center text-sm alert-ok organic-shape" style="background:rgba(132,169,140,0.15); color:var(--txt); border: 2px solid var(--primary); box-shadow: 2px 2px 0px var(--primary);">
    <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="var(--primary)" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span class="font-kalam font-bold"><?= session()->getFlashdata('success') ?></span>
</div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
<div class="mb-5 p-3.5 rounded-xl flex items-center text-sm alert-err organic-shape" style="background:rgba(224,122,95,0.15); color:var(--txt); border: 2px solid var(--secondary); box-shadow: 2px 2px 0px var(--secondary);">
    <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="var(--secondary)" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span class="font-kalam font-bold"><?= session()->getFlashdata('error') ?></span>
</div>
<?php endif; ?>

<!-- User Grid -->
<?php if (empty($users)): ?>
    <div class="glass-card p-14 text-center" style="background-color: #f2e8cf;">
        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center organic-shape"
             style="background:rgba(132,169,140,0.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt);">
            <svg class="w-8 h-8" fill="none" stroke="var(--txt)" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </div>
        <h4 class="text-xl font-bold mb-2 font-kalam" style="color:var(--txt);">Belum Ada User</h4>
        <p class="text-sm" style="color:var(--muted); font-family:'Lora',serif;">Tambahkan pengguna pertama untuk memulai.</p>
    </div>
<?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 user-grid">
        <?php 
        $colors = ['#fffcf2', '#f2e8cf', '#d8e2dc', '#fae1dd'];
        $i = 0;
        foreach ($users as $u): 
            $bgCard = $colors[$i % count($colors)];
            $i++;
            $isAdmin = ($u['role'] === 'admin');
        ?>
        
        <div class="glass-card group flex flex-col relative overflow-hidden user-card" style="background-color: <?= $bgCard ?>;">
            
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 flex items-center justify-center text-xl font-bold font-kalam text-white shrink-0 organic-shape"
                         style="background: <?= $isAdmin ? 'var(--secondary)' : 'var(--primary)' ?>; border: 2px solid var(--txt); box-shadow: 2px 2px 0px var(--txt);">
                        <?= strtoupper(substr($u['nama_lengkap'] ?? 'U', 0, 2)) ?>
                    </div>
                    <?php if ($isAdmin): ?>
                    <span class="text-[10px] font-bold px-3 py-1.5 uppercase tracking-widest font-kalam organic-shape"
                          style="background:rgba(224,122,95,0.15); border:2px solid var(--secondary); color:var(--secondary);">
                        Admin
                    </span>
                    <?php else: ?>
                    <span class="text-[10px] font-bold px-3 py-1.5 uppercase tracking-widest font-kalam organic-shape"
                          style="background:rgba(132,169,140,0.15); border:2px solid var(--primary); color:var(--primary);">
                        Karyawan
                    </span>
                    <?php endif; ?>
                </div>

                <h4 class="text-xl font-bold mb-1 truncate transition-colors duration-200 font-kalam"
                    style="color:var(--txt);" title="<?= esc($u['nama_lengkap']) ?>">
                    <?= esc($u['nama_lengkap']) ?>
                </h4>
                <p class="text-sm mb-3 truncate font-bold font-kalam" style="color:var(--muted);">
                    @<?= esc($u['username']) ?>
                </p>
                <div class="flex items-center space-x-2 text-sm" style="color:var(--muted); font-family:'Lora',serif;">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="truncate"><?= esc($u['email']) ?></span>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-6 pb-8 pt-4 flex space-x-2 mt-auto" style="border-top:2px dashed rgba(61, 64, 91, 0.15);">
                <a href="<?= base_url('admin/user/edit/' . $u['id']) ?>"
                   class="organic-shape flex-1 text-center py-2 mb-2 text-sm font-bold font-kalam cursor-pointer transition-all duration-200"
                   style="background:var(--surface); color:var(--txt); border:2px solid var(--txt);"
                   onmouseover="this.style.background='var(--primary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
                   onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)'; this.style.transform='translateY(0)';">
                    Edit
                </a>
                <a href="<?= base_url('admin/user/delete/' . $u['id']) ?>"
                   onclick="return confirm('Yakin hapus user ini?')"
                   class="organic-shape flex-1 text-center py-2 mb-2 text-sm font-bold font-kalam cursor-pointer transition-all duration-200"
                   style="background:var(--surface); color:var(--txt); border:2px solid var(--txt);"
                   onmouseover="this.style.background='var(--secondary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
                   onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)'; this.style.transform='translateY(0)';">
                    Hapus
                </a>
            </div>

        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<script>
(() => {
    gsap.fromTo('.page-intro', { y: -18, opacity: 0 }, { y: 0, opacity: 1, duration: .5, ease: 'back.out(1.5)' });
    gsap.fromTo(['.alert-box', '.user-card'], { y: -14, opacity: 0 }, { y: 0, opacity: 1, duration: .45, stagger: .04, ease: 'back.out(1.5)', delay: .1 });
})();
</script>
<?= $this->endSection() ?>
