<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="mb-7 page-intro">
    <div class="flex items-center space-x-2 mb-1.5">
        <div class="w-1 h-4 rounded-full" style="background:linear-gradient(180deg,#F59E0B,#EC4899);"></div>
        <span class="text-[9px] font-bold uppercase tracking-widest" style="color:rgba(245,158,11,.65);">Access Control</span>
    </div>
    <h1 class="text-xl font-bold grad-warm mb-0.5">Ajukan Izin Akses Berkas</h1>
    <p class="text-xs" style="color:var(--muted);">Pilih dokumen yang ingin diakses dan berikan alasan pengajuan izin Anda.</p>
</div>

<?php if (session()->getFlashdata('error')): ?>
<div class="mb-5 p-3.5 rounded-xl flex items-center text-xs alert-err alert-box">
    <svg class="w-4 h-4 mr-2.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span class="font-semibold"><?= session()->getFlashdata('error') ?></span>
</div>
<?php endif; ?>

<div class="glass-card p-7 max-w-lg form-card" style="border-radius:18px;">
    <form action="<?= base_url('karyawan/izin/store') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="mb-5">
            <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(245,158,11,.75);">Pilih Dokumen</label>
            <select name="dokumen_id" class="glass-input w-full px-4 py-2.5 text-sm" required>
                <option value="">-- Pilih Dokumen yang Ingin Diakses --</option>
                <?php foreach ($dokumen as $d): ?>
                <option value="<?= $d['id'] ?>"><?= esc($d['judul']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(236,72,153,.75);">Alasan / Pesan Pengajuan</label>
            <textarea name="pesan" rows="4" placeholder="Jelaskan alasan Anda membutuhkan akses ke dokumen ini..."
                      class="glass-input w-full px-4 py-2.5 text-sm" style="resize:none;"></textarea>
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="btn-violet flex-1 py-2.5 rounded-xl text-xs font-bold cursor-pointer">
                Kirim Pengajuan
            </button>
            <a href="<?= base_url('karyawan/izin') ?>"
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
