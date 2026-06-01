<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="mb-7 page-intro flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
    <div>
        <div class="flex items-center space-x-2 mb-1.5">
            <div class="w-1.5 h-5 organic-shape" style="background:var(--primary);"></div>
            <span class="text-[11px] font-bold uppercase tracking-widest font-kalam" style="color:var(--muted);">Struktur Organisasi</span>
        </div>
        <h1 class="text-3xl font-bold font-kalam mb-0.5" style="color:var(--txt);">Unit Kerja</h1>
        <p class="text-sm mt-2" style="color:var(--muted); font-family:'Lora',serif;">Kelola daftar unit kerja atau divisi yang terdaftar dalam sistem arsip.</p>
    </div>
    <a href="<?= base_url('admin/unit/create') ?>"
       class="btn-violet px-5 py-2.5 flex items-center space-x-2 shrink-0 cursor-pointer">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4"/>
        </svg>
        <span>Tambah Unit</span>
    </a>
</div>

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

<?php if (empty($unit)): ?>
    <div class="glass-card p-14 text-center table-container" style="background-color: #f2e8cf;">
        <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center organic-shape"
             style="background:rgba(224,122,95,0.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt);">
            <svg class="w-8 h-8" fill="none" stroke="var(--txt)" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                      d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
            </svg>
        </div>
        <h4 class="text-xl font-bold mb-2 font-kalam" style="color:var(--txt);">Belum Ada Unit Kerja</h4>
        <p class="text-sm" style="color:var(--muted); font-family:'Lora',serif;">Tambahkan unit atau divisi pertama untuk memulai mengatur organisasi.</p>
    </div>
<?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 table-container">
        <?php foreach ($unit as $u): ?>
        <div class="glass-card p-5 anim-item flex flex-col justify-between" style="background-color: #fffcf2;">
            <div>
                <div class="w-12 h-12 mb-4 flex items-center justify-center organic-shape"
                     style="background:rgba(132,169,140,0.15);border:2px solid var(--txt);box-shadow: 2px 2px 0px var(--txt);">
                    <svg class="w-6 h-6" fill="none" stroke="var(--txt)" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold font-kalam mb-2" style="color:var(--txt);"><?= esc($u['nama_unit']) ?></h3>
            </div>
            
            <div class="mt-6 pb-8 px-5 pt-4 flex items-center justify-end space-x-2" style="border-top: 2px dashed rgba(61, 64, 91, 0.15);margin-top:auto;">
                <a href="<?= base_url('admin/unit/edit/' . $u['id']) ?>"
                   class="organic-shape px-5 py-2 mb-2 text-sm font-bold font-kalam cursor-pointer transition-all duration-200"
                   style="background:var(--surface); color:var(--txt); border:2px solid var(--txt);"
                   onmouseover="this.style.background='var(--primary)'; this.style.color='#fffcf2'; this.style.transform='translateY(-1px)';"
                   onmouseout="this.style.background='var(--surface)'; this.style.color='var(--txt)'; this.style.transform='translateY(0)';">
                    Edit
                </a>
                <a href="<?= base_url('admin/unit/delete/' . $u['id']) ?>"
                   onclick="return confirm('Hapus unit ini?')"
                   class="organic-shape px-5 py-2 mb-2 text-sm font-bold font-kalam cursor-pointer transition-all duration-200"
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
    gsap.fromTo('.page-intro', { y: -18, opacity: 0 }, { y: 0, opacity: 1, duration:.5, ease:'back.out(1.5)' });
    gsap.fromTo('.table-container', { y: -14, opacity: 0 }, { y: 0, opacity: 1, duration:.5, ease:'back.out(1.5)', delay:.12 });
    gsap.fromTo('.anim-item', { y: -10, opacity: 0 }, { y: 0, opacity: 1, duration:.4, stagger:.05, ease:'back.out(1.5)', delay:.2 });
})();
</script>
<?= $this->endSection() ?>
