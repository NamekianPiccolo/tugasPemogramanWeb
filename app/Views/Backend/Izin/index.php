<?= view('Backend/Template/header') ?>
<?= view('Backend/Template/sidebar') ?>
 
<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white tracking-wide">Izin Akses Dokumen</h1>
        <p class="text-gray-300 mt-2">Daftar pengajuan izin akses dokumen rahasia.</p>
    </div>
    <a href="<?= base_url('karyawan/izin/create') ?>" class="bg-brand-500 hover:bg-brand-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg shadow-brand-500/30 transition-all">
        <i class="fas fa-plus mr-2"></i> Ajukan Izin
    </a>
</div>
 
<div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-black/20 text-gray-300 text-sm uppercase tracking-wider border-b border-white/10">
                    <th class="px-6 py-4 font-semibold w-16 text-center">No</th>
                    <th class="px-6 py-4 font-semibold">Dokumen</th>
                    <th class="px-6 py-4 font-semibold">Status</th>
                    <th class="px-6 py-4 font-semibold">Tgl Pengajuan</th>
                    <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-white divide-y divide-white/10">
                <?php $no = 1; foreach ($izin as $i) : ?>
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 text-center"><?= $no++ ?></td>
                    <td class="px-6 py-4 font-medium"><?= esc($i['judul']) ?></td>
                    <td class="px-6 py-4">
                        <?php if($i['status_izin'] === 'Pending'): ?>
                            <span class="bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-full text-xs border border-yellow-500/30">Pending</span>
                        <?php elseif($i['status_izin'] === 'Disetujui'): ?>
                            <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-xs border border-green-500/30">Disetujui</span>
                        <?php else: ?>
                            <span class="bg-red-500/20 text-red-400 px-3 py-1 rounded-full text-xs border border-red-500/30">Ditolak</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-gray-300"><?= date('d M Y H:i', strtotime($i['tgl_pengajuan'])) ?></td>
                    <td class="px-6 py-4 text-center">
                        <button class="text-gray-500 hover:text-white transition-colors">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($izin)): ?>
                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400 italic">Belum ada pengajuan izin.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
 
<?= view('Backend/Template/footer') ?>
