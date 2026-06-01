<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="mb-7 page-intro">
    <div class="flex items-center space-x-2 mb-1.5">
        <div class="w-1 h-4 rounded-full" style="background:linear-gradient(180deg,#06B6D4,#EC4899);"></div>
        <span class="text-[9px] font-bold uppercase tracking-widest" style="color:rgba(6,182,212,.65);">Akses & Identitas</span>
    </div>
    <h1 class="text-xl font-bold grad-cyan mb-0.5">Edit Pengguna</h1>
    <p class="text-xs" style="color:var(--muted);">Perbarui informasi akun pengguna yang sudah ada. Kosongkan password jika tidak ingin mengubahnya.</p>
</div>

<?php if (isset($errors)): ?>
<div class="mb-5 p-4 rounded-xl alert-err alert-box">
    <p class="text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(248,113,113,.7);">Validasi Gagal</p>
    <ul class="space-y-1">
        <?php foreach ($errors as $e): ?>
        <li class="text-xs flex items-start space-x-1.5">
            <span style="color:#F87171;margin-top:1px;">•</span>
            <span><?= esc($e) ?></span>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<div class="glass-card p-7 max-w-xl form-card" style="border-radius:18px;">
    <form action="<?= base_url('admin/user/update/' . $user['id']) ?>" method="POST">
        <?= csrf_field() ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(6,182,212,.75);">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="<?= old('nama_lengkap', $user['nama_lengkap']) ?>"
                       class="glass-input w-full px-4 py-2.5 text-sm" required>
            </div>
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(139,92,246,.75);">Username</label>
                <input type="text" name="username" value="<?= old('username', $user['username']) ?>"
                       class="glass-input w-full px-4 py-2.5 text-sm" required>
            </div>
        </div>

        <div class="mb-5">
            <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(16,185,129,.75);">Email</label>
            <input type="email" name="email" value="<?= old('email', $user['email']) ?>"
                   class="glass-input w-full px-4 py-2.5 text-sm" required>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(245,158,11,.75);">Password Baru</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                       class="glass-input w-full px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest mb-2" style="color:rgba(236,72,153,.75);">Role</label>
                <select name="role" class="glass-input w-full px-4 py-2.5 text-sm" required>
                    <option value="admin"    <?= old('role', $user['role']) === 'admin'    ? 'selected' : '' ?>>Admin</option>
                    <option value="karyawan" <?= old('role', $user['role']) === 'karyawan' ? 'selected' : '' ?>>Karyawan</option>
                </select>
            </div>
        </div>

        <div class="flex space-x-3 mt-6">
            <button type="submit" class="btn-violet flex-1 py-2.5 rounded-xl text-xs font-bold cursor-pointer">
                Perbarui Akun
            </button>
            <a href="<?= base_url('admin/user') ?>"
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
