<?= view('Backend/Template/header') ?>
<?= view('Backend/Template/sidebar') ?>
 
<div class="mb-8">
    <h1 class="text-3xl font-bold text-white tracking-wide">Persetujuan Izin Akses</h1>
    <p class="text-gray-300 mt-2">Kelola pengajuan izin akses dokumen dari karyawan.</p>
</div>
 
<?php if (session()->getFlashdata('success')) : ?>
    <div class="bg-green-500/10 border border-green-500/20 text-green-400 p-4 rounded-xl mb-6 flex items-center gap-3 text-sm font-medium">
        <i class="fas fa-check-circle text-lg"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
 
<div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-black/20 text-gray-300 text-sm uppercase tracking-wider border-b border-white/10">
                    <th class="px-6 py-4 font-semibold w-16 text-center">No</th>
                    <th class="px-6 py-4 font-semibold">Karyawan</th>
                    <th class="px-6 py-4 font-semibold">Dokumen</th>
                    <th class="px-6 py-4 font-semibold">Alasan / Pesan</th>
                    <th class="px-6 py-4 font-semibold">Status</th>
                    <th class="px-6 py-4 font-semibold w-48 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-white divide-y divide-white/10">
                <?php $no = 1; foreach ($izin as $i) : ?>
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 text-center"><?= $no++ ?></td>
                    <td class="px-6 py-4">
                        <div class="font-bold"><?= esc($i['nama_lengkap']) ?></div>
                        <div class="text-xs text-gray-400"><?= date('d M Y H:i', strtotime($i['tgl_pengajuan'])) ?></div>
                    </td>
                    <td class="px-6 py-4 font-medium text-brand-400"><?= esc($i['judul']) ?></td>
                    <td class="px-6 py-4 text-sm text-gray-300 italic">"<?= esc($i['pesan']) ?>"</td>
                    <td class="px-6 py-4">
                        <?php if($i['status_izin'] === 'Pending'): ?>
                            <span class="bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-full text-xs border border-yellow-500/30">Pending</span>
                        <?php elseif($i['status_izin'] === 'Disetujui'): ?>
                            <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-xs border border-green-500/30">Disetujui</span>
                        <?php else: ?>
                            <span class="bg-red-500/20 text-red-400 px-3 py-1 rounded-full text-xs border border-red-500/30">Ditolak</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <?php if($i['status_izin'] === 'Pending'): ?>
                            <div class="flex justify-center gap-2">
                                <a href="<?= base_url('admin/izin/approve/' . $i['id']) ?>" class="bg-green-500/20 text-green-400 hover:bg-green-500 hover:text-white px-3 py-1.5 rounded-lg transition-colors border border-green-500/30" title="Setujui">
                                    <i class="fas fa-check"></i>
                                </a>
                                <a href="<?= base_url('admin/izin/reject/' . $i['id']) ?>" class="bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded-lg transition-colors border border-red-500/30" title="Tolak">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        <?php else: ?>
                            <span class="text-xs text-gray-500">Selesai</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($izin)): ?>
                <tr><td colspan="6" class="px-6 py-8 text-center text-gray-400 italic">Belum ada pengajuan izin dari karyawan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
 
<?= view('Backend/Template/footer') ?>
