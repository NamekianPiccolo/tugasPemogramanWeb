<?php
// Shared form template helper
// Views: admin/unit/create.php
?>
<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="mb-7 page-intro">
    <div class="flex items-center space-x-2 mb-1.5">
        <div class="w-1 h-4 rounded-full" style="background:linear-gradient(180deg,#8B5CF6,#10B981);"></div>
        <span class="text-[9px] font-bold uppercase tracking-widest" style="color:rgba(139,92,246,.65);">Struktur Organisasi</span>
    </div>
    <h1 class="text-xl font-bold grad-violet mb-0.5">Tambah Unit Kerja</h1>
    <p class="text-xs" style="color:var(--muted);">Daftarkan unit kerja atau divisi baru ke dalam sistem arsip dokumen.</p>
</div>

<div class="glass-card p-7 max-w-lg form-card" style="border-radius:18px;">
    <form action="<?= base_url('admin/unit/store') ?>" method="POST">
        <?= csrf_field() ?>
        <div class="mb-6">
            <label for="nama_unit" class="block text-[10px] font-bold uppercase tracking-widest mb-2"
                   style="color:rgba(139,92,246,.75);">Nama Unit / Divisi</label>
            <input type="text" id="nama_unit" name="nama_unit"
                   value="<?= old('nama_unit') ?>"
                   placeholder="Contoh: Departemen Keuangan, Divisi IT..."
                   class="glass-input w-full px-4 py-2.5 text-sm" required>
        </div>
        <div class="flex space-x-3">
            <button type="submit" class="btn-violet flex-1 py-2.5 rounded-xl text-xs font-bold cursor-pointer">
                Simpan Unit
            </button>
            <a href="<?= base_url('admin/unit') ?>"
               class="btn-outline flex-1 py-2.5 rounded-xl text-xs font-bold text-center cursor-pointer">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
(() => { gsap.fromTo(['.page-intro','.form-card'], { y: -18, opacity: 0 }, { y: 0, opacity: 1, duration:.5, stagger:.08, ease:'power3.out' }); })();
</script>
<?= $this->endSection() ?>
