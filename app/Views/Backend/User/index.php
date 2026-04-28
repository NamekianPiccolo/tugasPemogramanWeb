<?= view('Backend/Template/header') ?>
<?= view('Backend/Template/sidebar') ?>
 
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-white tracking-wide">Kelola User</h1>
        <p class="text-gray-300 mt-2">Daftar pengguna sistem dan perannya.</p>
    </div>
    <a href="<?= base_url('admin/user/create') ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl transition duration-300 shadow-lg">
        <i class="fas fa-plus mr-2"></i> Tambah User
    </a>
</div>
 
<?php if (session()->getFlashdata('success')) : ?>
    <div class="bg-green-500/20 border border-green-500/50 text-green-200 p-4 rounded-xl mb-6">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
 
<div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl overflow-hidden shadow-2xl">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-white/5 border-b border-white/10">
                <th class="p-4 text-gray-300 font-semibold uppercase text-xs tracking-wider">Username</th>
                <th class="p-4 text-gray-300 font-semibold uppercase text-xs tracking-wider">Nama Lengkap</th>
                <th class="p-4 text-gray-300 font-semibold uppercase text-xs tracking-wider">Email</th>
                <th class="p-4 text-gray-300 font-semibold uppercase text-xs tracking-wider">Role</th>
                <th class="p-4 text-gray-300 font-semibold uppercase text-xs tracking-wider text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            <?php foreach ($users as $u) : ?>
                <tr class="hover:bg-white/5 transition duration-200">
                    <td class="p-4 text-white font-medium"><?= esc($u['username']) ?></td>
                    <td class="p-4 text-gray-300"><?= esc($u['nama_lengkap']) ?></td>
                    <td class="p-4 text-gray-300"><?= esc($u['email']) ?></td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold <?= $u['role'] === 'admin' ? 'bg-purple-500/20 text-purple-400 border border-purple-500/30' : 'bg-brand-500/20 text-brand-400 border border-brand-500/30' ?>">
                            <?= strtoupper($u['role']) ?>
                        </span>
                    </td>
                    <td class="p-4 text-right">
                        <a href="<?= base_url('admin/user/edit/' . $u['id']) ?>" class="text-orange-400 hover:text-orange-300 mr-3 transition duration-200">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= base_url('admin/user/delete/' . $u['id']) ?>" class="text-red-400 hover:text-red-300 transition duration-200" onclick="return confirm('Apakah Anda yakin?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
 
<?= view('Backend/Template/footer') ?>
