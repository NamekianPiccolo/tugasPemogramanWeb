<?= view('Backend/Template/header') ?>
<?= view('Backend/Template/sidebar') ?>

<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white tracking-wide">Data Dokumen Arsip</h1>
        <p class="text-gray-300 mt-2">Kelola dan telusuri seluruh dokumen digital Anda.</p>
    </div>
    <?php if (session()->get('role') === 'admin') : ?>
    <a href="<?= base_url('admin/dokumen/create') ?>" class="bg-brand-500 hover:bg-brand-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-brand-500/30 transition-all">
        <i class="fas fa-upload mr-2"></i> Upload Dokumen
    </a>
    <?php endif; ?>
</div>

<div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-black/20 text-gray-300 text-sm uppercase tracking-wider border-b border-white/10">
                    <th class="px-6 py-4 font-semibold w-16 text-center">No</th>
                    <th class="px-6 py-4 font-semibold">Judul Dokumen</th>
                    <th class="px-6 py-4 font-semibold">Tanggal</th>
                    <th class="px-6 py-4 font-semibold">Kategori</th>
                    <th class="px-6 py-4 font-semibold">Unit / Bagian</th>
                    <th class="px-6 py-4 font-semibold text-center">File</th>
                    <th class="px-6 py-4 font-semibold w-48 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-white divide-y divide-white/10">
                <?php $no = 1; foreach ($dokumen as $d) : ?>
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 text-center"><?= $no++ ?></td>
                    <td class="px-6 py-4 font-medium"><?= esc($d['judul']) ?></td>
                    <td class="px-6 py-4 text-gray-300"><?= esc($d['tanggal']) ?></td>
                    <td class="px-6 py-4"><span class="bg-blue-500/20 text-blue-300 px-3 py-1 rounded-full text-sm border border-blue-500/30"><?= esc($d['nama_kategori']) ?></span></td>
                    <td class="px-6 py-4"><span class="bg-purple-500/20 text-purple-300 px-3 py-1 rounded-full text-sm border border-purple-500/30"><?= esc($d['nama_unit']) ?></span></td>
                    <td class="px-6 py-4 text-center">
                        <?php if($d['file_dokumen']): ?>
                            <a href="<?= base_url('uploads/' . $d['file_dokumen']) ?>" target="_blank" class="text-teal-400 hover:text-teal-300 hover:underline">
                                <i class="fas fa-file-pdf text-xl"></i>
                            </a>
                        <?php else: ?>
                            <span class="text-gray-500 text-sm">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <?php if (session()->get('role') === 'admin') : ?>
                                <a href="<?= base_url('admin/dokumen/edit/' . $d['id']) ?>" class="bg-yellow-500/20 text-yellow-400 hover:bg-yellow-500 hover:text-white px-3 py-1.5 rounded-lg transition-colors border border-yellow-500/30">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('admin/dokumen/delete/' . $d['id']) ?>" class="bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded-lg transition-colors border border-red-500/30" onclick="return confirm('Yakin ingin menghapus dokumen ini beserta filenya?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            <?php elseif (isset($d['status_izin']) && $d['status_izin'] === 'Disetujui') : ?>
                                <a href="<?= base_url('karyawan/dokumen/edit/' . $d['id']) ?>" class="bg-yellow-500/20 text-yellow-400 hover:bg-yellow-500 hover:text-white px-3 py-1.5 rounded-lg transition-colors border border-yellow-500/30" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('karyawan/distribusi/create?dokumen=' . $d['id']) ?>" class="bg-blue-500/20 text-blue-400 hover:bg-blue-500 hover:text-white px-3 py-1.5 rounded-lg transition-colors border border-blue-500/30" title="Kirim">
                                    <i class="fas fa-paper-plane"></i>
                                </a>
                            <?php else : ?>
                                <span class="text-xs text-gray-500">No Access</span>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($dokumen)): ?>
                <tr><td colspan="7" class="px-6 py-8 text-center text-gray-400 italic">Belum ada data dokumen.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= view('Backend/Template/footer') ?>
