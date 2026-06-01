<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="mb-7 page-intro">
    <div class="flex items-center space-x-2 mb-1.5">
        <div class="w-1 h-4 rounded-full" style="background:linear-gradient(180deg,#8B5CF6,#06B6D4);"></div>
        <span class="text-[9px] font-bold uppercase tracking-widest" style="color:rgba(139,92,246,.65);">Vault Digital</span>
    </div>
    <h1 class="text-xl font-bold grad-violet mb-0.5">Edit Dokumen</h1>
    <p class="text-xs" style="color:var(--muted);">Perbarui metadata atau file dokumen yang sudah ada dalam sistem arsip.</p>
</div>

<?php if (session()->getFlashdata('error')): ?>
<div class="mb-5 p-3.5 rounded-xl flex items-center text-xs alert-err alert-box">
    <svg class="w-4 h-4 mr-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span class="font-semibold"><?= session()->getFlashdata('error') ?></span>
</div>
<?php endif; ?>

<div class="glass-card p-7 max-w-2xl form-card" style="border-radius:18px;">
    <?php $role = session()->get('role') ?? 'admin'; ?>
    <form action="<?= base_url("$role/dokumen/update/" . $dokumen['id']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="file_lama" value="<?= esc($dokumen['file_dokumen']) ?>">
        <input type="hidden" name="dokumen_id" value="<?= esc($dokumen['id']) ?>">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
            <div class="sm:col-span-2">
                <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(139,92,246,.75);">Judul Dokumen</label>
                <input type="text" name="judul" value="<?= old('judul', $dokumen['judul']) ?>"
                       class="glass-input w-full px-4 py-2.5 text-sm" required>
            </div>

            <?php if ($role === 'admin'): ?>
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(6,182,212,.75);">Kategori</label>
                <select name="kategori_id" class="glass-input w-full px-4 py-2.5 text-sm">
                    <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id'] ?>" <?= $dokumen['kategori_id'] == $k['id'] ? 'selected' : '' ?>><?= esc($k['nama_kategori']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(16,185,129,.75);">Unit Kerja</label>
                <select name="unit_id" class="glass-input w-full px-4 py-2.5 text-sm">
                    <?php foreach ($unit as $u): ?>
                    <option value="<?= $u['id'] ?>" <?= $dokumen['unit_id'] == $u['id'] ? 'selected' : '' ?>><?= esc($u['nama_unit']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(245,158,11,.75);">Tanggal Dokumen</label>
                <input type="date" name="tanggal" value="<?= old('tanggal', $dokumen['tanggal']) ?>"
                       class="glass-input w-full px-4 py-2.5 text-sm">
            </div>
            <?php else: ?>
            <input type="hidden" name="kategori_id" value="<?= esc($dokumen['kategori_id']) ?>">
            <input type="hidden" name="unit_id" value="<?= esc($dokumen['unit_id']) ?>">
            <input type="hidden" name="tanggal" value="<?= esc($dokumen['tanggal']) ?>">
            <?php endif; ?>
        </div>

        <div class="mb-5">
            <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(236,72,153,.75);">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="glass-input w-full px-4 py-2.5 text-sm" style="resize:none;"><?= old('deskripsi', $dokumen['deskripsi']) ?></textarea>
        </div>

        <div class="mb-6">
            <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(139,92,246,.75);">Ganti File Dokumen</label>
            <?php if (!empty($dokumen['file_dokumen'])): ?>
            <div class="mb-2 flex items-center space-x-2 text-xs" style="color:rgba(16,185,129,.7);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>File saat ini: <strong><?= esc($dokumen['file_dokumen']) ?></strong></span>
            </div>
            <?php endif; ?>
            <div class="p-4 rounded-xl" style="background:rgba(255,255,255,.8);border:1px dashed rgba(139,92,246,.3);border-radius:10px;">
                <input type="file" name="file_dokumen" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv"
                       class="text-xs" style="color:var(--muted);">
                <p class="text-[10px] mt-2" style="color:var(--dim);">Kosongkan jika tidak ingin mengganti file.</p>
            </div>
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="btn-violet flex-1 py-2.5 rounded-xl text-xs font-bold cursor-pointer">
                Perbarui Dokumen
            </button>
            <a href="<?= base_url("$role/dokumen") ?>"
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
