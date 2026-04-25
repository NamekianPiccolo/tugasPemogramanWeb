<?= view('Backend/Template/header') ?>
<?= view('Backend/Template/sidebar') ?>

<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white tracking-wide">Data Unit / Bagian</h1>
        <p class="text-gray-300 mt-2">Kelola unit kerja yang ada di sistem arsip Anda.</p>
    </div>
    <a href="<?= base_url('admin/unit/create') ?>" class="bg-brand-500 hover:bg-brand-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-brand-500/30 transition-all">
        <i class="fas fa-plus mr-2"></i> Tambah Unit
    </a>
</div>

<div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-black/20 text-gray-300 text-sm uppercase tracking-wider border-b border-white/10">
                    <th class="px-6 py-4 font-semibold w-16 text-center">No</th>
                    <th class="px-6 py-4 font-semibold">Nama Unit / Bagian</th>
                    <th class="px-6 py-4 font-semibold w-48 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-white divide-y divide-white/10">
                <?php $no = 1; foreach ($unit as $u) : ?>
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 text-center"><?= $no++ ?></td>
                    <td class="px-6 py-4 font-medium"><?= esc($u['nama_unit']) ?></td>
                    <td class="px-6 py-4 text-center flex justify-center gap-2">
                        <a href="<?= base_url('admin/unit/edit/' . $u['id']) ?>" class="bg-yellow-500/20 text-yellow-400 hover:bg-yellow-500 hover:text-white px-3 py-1.5 rounded-lg transition-colors border border-yellow-500/30">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="<?= base_url('admin/unit/delete/' . $u['id']) ?>" class="bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded-lg transition-colors border border-red-500/30" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($unit)): ?>
                <tr><td colspan="3" class="px-6 py-8 text-center text-gray-400 italic">Belum ada data unit.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= view('Backend/Template/footer') ?>
