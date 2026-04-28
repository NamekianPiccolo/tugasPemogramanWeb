<?= view('Backend/Template/header') ?>
<?= view('Backend/Template/sidebar') ?>
 
<div class="mb-8">
    <h1 class="text-3xl font-bold text-white tracking-wide">Edit User</h1>
    <p class="text-gray-300 mt-2">Perbarui informasi untuk user <?= esc($user['username']) ?>.</p>
</div>
 
<?php if (session()->get('errors')) : ?>
    <div class="bg-red-500/20 border border-red-500/50 text-red-200 p-4 rounded-xl mb-6">
        <ul class="list-disc ml-4">
            <?php foreach (session()->get('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>
 
<div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-8 shadow-2xl max-w-2xl">
    <form action="<?= base_url('admin/user/update/' . $user['id']) ?>" method="POST">
        <?= csrf_field() ?>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-gray-300 text-sm font-semibold uppercase tracking-wider">Username</label>
                <input type="text" name="username" value="<?= old('username', $user['username']) ?>" class="w-full bg-white/5 border border-white/10 rounded-xl p-4 text-white outline-none focus:ring-2 focus:ring-brand-500 transition-all" required>
            </div>
            
            <div class="space-y-2">
                <label class="text-gray-300 text-sm font-semibold uppercase tracking-wider">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="<?= old('nama_lengkap', $user['nama_lengkap']) ?>" class="w-full bg-white/5 border border-white/10 rounded-xl p-4 text-white outline-none focus:ring-2 focus:ring-brand-500 transition-all" required>
            </div>
 
            <div class="space-y-2">
                <label class="text-gray-300 text-sm font-semibold uppercase tracking-wider">Email</label>
                <input type="email" name="email" value="<?= old('email', $user['email']) ?>" class="w-full bg-white/5 border border-white/10 rounded-xl p-4 text-white outline-none focus:ring-2 focus:ring-brand-500 transition-all" required>
            </div>
 
            <div class="space-y-2">
                <label class="text-gray-300 text-sm font-semibold uppercase tracking-wider">Role</label>
                <select name="role" class="w-full bg-white/5 border border-white/10 rounded-xl p-4 text-white outline-none focus:ring-2 focus:ring-brand-500 transition-all appearance-none">
                    <option value="karyawan" <?= old('role', $user['role']) === 'karyawan' ? 'selected' : '' ?> class="bg-gray-800">Karyawan</option>
                    <option value="admin" <?= old('role', $user['role']) === 'admin' ? 'selected' : '' ?> class="bg-gray-800">Admin</option>
                </select>
            </div>
 
            <div class="space-y-2 md:col-span-2">
                <label class="text-gray-300 text-sm font-semibold uppercase tracking-wider">Password (Biarkan kosong jika tidak diubah)</label>
                <input type="password" name="password" class="w-full bg-white/5 border border-white/10 rounded-xl p-4 text-white outline-none focus:ring-2 focus:ring-brand-500 transition-all">
            </div>
        </div>
 
        <div class="mt-8 flex gap-4">
            <button type="submit" class="bg-brand-500 hover:bg-brand-600 text-white font-bold py-4 px-8 rounded-xl transition duration-300 shadow-lg">
                Update User
            </button>
            <a href="<?= base_url('admin/user') ?>" class="bg-white/10 hover:bg-white/20 text-white font-bold py-4 px-8 rounded-xl transition duration-300 border border-white/10">
                Batal
            </a>
        </div>
    </form>
</div>
 
<?= view('Backend/Template/footer') ?>
