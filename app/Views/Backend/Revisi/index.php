<?= view('Backend/Template/header') ?>
<?= view('Backend/Template/sidebar') ?>
 
<div class="mb-8">
    <h1 class="text-3xl font-bold text-white tracking-wide">Review Perubahan Dokumen</h1>
    <p class="text-gray-300 mt-2">Tinjau draf perubahan dokumen yang diajukan oleh karyawan sebelum diterapkan ke sistem.</p>
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
                    <th class="px-6 py-4 font-semibold">Pengirim</th>
                    <th class="px-6 py-4 font-semibold">Dokumen Asli</th>
                    <th class="px-6 py-4 font-semibold">Perubahan Judul</th>
                    <th class="px-6 py-4 font-semibold">Status</th>
                    <th class="px-6 py-4 font-semibold w-48 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-white divide-y divide-white/10">
                <?php $no = 1; foreach ($revisi as $r) : ?>
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 text-center"><?= $no++ ?></td>
                    <td class="px-6 py-4">
                        <div class="font-bold"><?= esc($r['nama_lengkap']) ?></div>
                        <div class="text-xs text-gray-400"><?= date('d M Y H:i', strtotime($r['created_at'])) ?></div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-400 italic"><?= esc($r['judul_asli']) ?></td>
                    <td class="px-6 py-4 font-medium text-brand-400"><?= esc($r['judul']) ?></td>
                    <td class="px-6 py-4">
                        <?php if($r['status_revisi'] === 'Pending'): ?>
                            <span class="bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-full text-xs border border-yellow-500/30">Menunggu Review</span>
                        <?php elseif($r['status_revisi'] === 'Disetujui'): ?>
                            <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-xs border border-green-500/30">Diterapkan</span>
                        <?php else: ?>
                            <span class="bg-red-500/20 text-red-400 px-3 py-1 rounded-full text-xs border border-red-500/30">Ditolak</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <?php if($r['status_revisi'] === 'Pending'): ?>
                            <div class="flex justify-center gap-2">
                                <a href="<?= base_url('admin/revisi/approve/' . $r['id']) ?>" class="bg-green-500/20 text-green-400 hover:bg-green-500 hover:text-white px-3 py-1.5 rounded-lg transition-colors border border-green-500/30" title="Setujui & Terapkan" onclick="return confirm('Apakah Anda yakin ingin menerapkan perubahan ini ke dokumen utama?')">
                                    <i class="fas fa-check"></i> Terapkan
                                </a>
                                <button onclick="rejectRevisi(<?= $r['id'] ?>)" class="bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded-lg transition-colors border border-red-500/30" title="Tolak">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        <?php else: ?>
                            <span class="text-xs text-gray-500">Selesai</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($revisi)): ?>
                <tr><td colspan="6" class="px-6 py-8 text-center text-gray-400 italic">Belum ada draf perubahan untuk ditinjau.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
 
<!-- Modal Reject -->
<div id="modalReject" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-[#0f172a] border border-white/10 rounded-3xl p-8 w-full max-w-md shadow-2xl">
        <h3 class="text-xl font-bold text-white mb-4">Tolak Perubahan</h3>
        <form id="formReject" method="POST">
            <div class="mb-6">
                <label class="block text-gray-400 text-sm mb-2">Alasan Penolakan</label>
                <textarea name="pesan_admin" rows="3" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-brand-500" placeholder="Berikan alasan mengapa perubahan ini ditolak..." required></textarea>
            </div>
            <div class="flex gap-4">
                <button type="button" onclick="closeModal()" class="flex-1 px-6 py-3 rounded-xl bg-white/5 text-white hover:bg-white/10 transition-all font-medium">Batal</button>
                <button type="submit" class="flex-1 px-6 py-3 rounded-xl bg-red-500 hover:bg-red-600 text-white transition-all font-bold">Kirim Penolakan</button>
            </div>
        </form>
    </div>
</div>
 
<script>
function rejectRevisi(id) {
    document.getElementById('formReject').action = "<?= base_url('admin/revisi/reject/') ?>/" + id;
    document.getElementById('modalReject').classList.remove('hidden');
}
function closeModal() {
    document.getElementById('modalReject').classList.add('hidden');
}
</script>
 
<?= view('Backend/Template/footer') ?>
