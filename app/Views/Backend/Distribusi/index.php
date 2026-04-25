<?= view('Backend/Template/header') ?>
<?= view('Backend/Template/sidebar') ?>

<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white tracking-wide">Distribusi & Peminjaman</h1>
        <p class="text-gray-300 mt-2">Pantau sirkulasi peminjaman dokumen arsip.</p>
    </div>
    <a href="<?= base_url('admin/distribusi/create') ?>" class="bg-brand-500 hover:bg-brand-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-brand-500/30 transition-all">
        <i class="fas fa-plus mr-2"></i> Catat Distribusi Baru
    </a>
</div>

<div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-black/20 text-gray-300 text-sm uppercase tracking-wider border-b border-white/10">
                    <th class="px-6 py-4 font-semibold w-16 text-center">No</th>
                    <th class="px-6 py-4 font-semibold">Judul Dokumen</th>
                    <th class="px-6 py-4 font-semibold">Peminjam / Tujuan</th>
                    <th class="px-6 py-4 font-semibold">Tanggal Pinjam</th>
                    <th class="px-6 py-4 font-semibold">Tanggal Kembali</th>
                    <th class="px-6 py-4 font-semibold text-center">Status</th>
                    <th class="px-6 py-4 font-semibold w-48 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-white divide-y divide-white/10">
                <?php $no = 1; foreach ($distribusi as $d) : ?>
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 text-center"><?= $no++ ?></td>
                    <td class="px-6 py-4 font-medium"><?= esc($d['judul']) ?></td>
                    <td class="px-6 py-4"><?= esc($d['peminjam']) ?></td>
                    <td class="px-6 py-4 text-gray-300"><?= esc($d['tanggal_pinjam']) ?></td>
                    <td class="px-6 py-4 text-gray-300"><?= esc($d['tanggal_kembali']) ?: '-' ?></td>
                    <td class="px-6 py-4 text-center">
                        <?php if($d['status'] == 'Dipinjam'): ?>
                            <span class="bg-yellow-500/20 text-yellow-300 px-3 py-1 rounded-full text-xs font-semibold border border-yellow-500/30 whitespace-nowrap">Dipinjam</span>
                        <?php elseif($d['status'] == 'Selesai'): ?>
                            <span class="bg-blue-500/20 text-blue-300 px-3 py-1 rounded-full text-xs font-semibold border border-blue-500/30 whitespace-nowrap">Selesai</span>
                        <?php else: ?>
                            <span class="bg-brand-500/20 text-brand-300 px-3 py-1 rounded-full text-xs font-semibold border border-brand-500/30 whitespace-nowrap"><?= esc($d['status']) ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-center flex justify-center gap-2">
                        <a href="<?= base_url('admin/distribusi/edit/' . $d['id']) ?>" class="bg-yellow-500/20 text-yellow-400 hover:bg-yellow-500 hover:text-white px-3 py-1.5 rounded-lg transition-colors border border-yellow-500/30">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="<?= base_url('admin/distribusi/delete/' . $d['id']) ?>" class="bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded-lg transition-colors border border-red-500/30" onclick="return confirm('Hapus data distribusi ini?');">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($distribusi)): ?>
                <tr><td colspan="7" class="px-6 py-8 text-center text-gray-400 italic">Belum ada data distribusi/peminjaman.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= view('Backend/Template/footer') ?>
