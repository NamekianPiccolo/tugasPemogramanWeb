<?= view('Backend/Template/header') ?>
<?= view('Backend/Template/sidebar') ?>

<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white tracking-wide">Data Kategori Dokumen</h1>
        <p class="text-gray-300 mt-2">Kelola jenis-jenis dokumen yang ada di sistem Anda.</p>
    </div>
    <a href="<?= base_url('admin/kategori/create') ?>" class="bg-brand-500 hover:bg-brand-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-brand-500/30 transition-all">
        <i class="fas fa-plus mr-2"></i> Tambah Kategori
    </a>
</div>

<div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-black/20 text-gray-300 text-sm uppercase tracking-wider border-b border-white/10">
                    <th class="px-6 py-4 font-semibold w-16 text-center">No</th>
                    <th class="px-6 py-4 font-semibold">Nama Kategori</th>
                    <th class="px-6 py-4 font-semibold w-48 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-white divide-y divide-white/10">
                <?php $no = 1; foreach ($kategori as $k) : ?>
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 text-center"><?= $no++ ?></td>
                    <td class="px-6 py-4 font-medium"><?= esc($k['nama_kategori']) ?></td>
                    <td class="px-6 py-4 text-center flex justify-center gap-2">
                        <a href="<?= base_url('admin/kategori/edit/' . $k['id']) ?>" class="bg-yellow-500/20 text-yellow-400 hover:bg-yellow-500 hover:text-white px-3 py-1.5 rounded-lg transition-colors border border-yellow-500/30">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="<?= base_url('admin/kategori/delete/' . $k['id']) ?>" class="bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded-lg transition-colors border border-red-500/30" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($kategori)): ?>
                <tr><td colspan="3" class="px-6 py-8 text-center text-gray-400 italic">Belum ada data kategori.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= view('Backend/Template/footer') ?>
