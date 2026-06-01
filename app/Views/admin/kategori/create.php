<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="mb-7 page-intro">
    <div class="flex items-center space-x-2 mb-1.5">
        <div class="w-1 h-4 rounded-full" style="background:linear-gradient(180deg,#06B6D4,#10B981);"></div>
        <span class="text-[9px] font-bold uppercase tracking-widest" style="color:rgba(6,182,212,.65);">Sistem Klasifikasi</span>
    </div>
    <h1 class="text-xl font-bold grad-cyan mb-0.5">Tambah Kategori</h1>
    <p class="text-xs" style="color:var(--muted);">Buat kategori baru untuk mengorganisir dokumen dalam sistem arsip.</p>
</div>

<div class="glass-card p-7 max-w-lg" style="border-radius:18px;">
    <form action="<?= base_url('admin/kategori/store') ?>" method="POST">
        <?= csrf_field() ?>
        <div class="mb-6">
            <label for="nama_kategori" class="block text-[10px] font-bold uppercase tracking-widest mb-2"
                   style="color:rgba(6,182,212,.75);">Nama Kategori</label>
            <input type="text" id="nama_kategori" name="nama_kategori"
                   value="<?= old('nama_kategori') ?>"
                   placeholder="Contoh: Dokumen Keuangan, SOP Operasional..."
                   class="glass-input w-full px-4 py-2.5 text-sm" required>
        </div>
        <div class="flex space-x-3">
            <button type="submit" class="btn-violet flex-1 py-2.5 rounded-xl text-xs font-bold cursor-pointer">
                Simpan Kategori
            </button>
            <a href="<?= base_url('admin/kategori') ?>"
               class="btn-outline flex-1 py-2.5 rounded-xl text-xs font-bold text-center cursor-pointer">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
(() => { gsap.fromTo(['.page-intro','.glass-card'], { y: -18, opacity: 0 }, { y: 0, opacity: 1, duration:.5, stagger:.08, ease:'power3.out' }); })();
</script>
<?= $this->endSection() ?>
