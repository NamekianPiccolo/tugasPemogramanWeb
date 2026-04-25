<?= view('Backend/Template/header') ?>
<?= view('Backend/Template/sidebar') ?>

<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white tracking-wide">Riwayat Akses Dokumen</h1>
        <p class="text-gray-300 mt-2">Daftar aktivitas dan riwayat unggahan pada sistem.</p>
    </div>
</div>

<div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-black/20 text-gray-300 text-sm uppercase tracking-wider border-b border-white/10">
                    <th class="px-6 py-4 font-semibold w-16 text-center">No</th>
                    <th class="px-6 py-4 font-semibold">Waktu</th>
                    <th class="px-6 py-4 font-semibold">User</th>
                    <th class="px-6 py-4 font-semibold">Dokumen</th>
                    <th class="px-6 py-4 font-semibold">Aksi</th>
                    <th class="px-6 py-4 font-semibold">Keterangan</th>
                </tr>
            </thead>
            <tbody class="text-white divide-y divide-white/10">
                <?php $no = 1; foreach ($riwayat as $r) : ?>
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 text-center"><?= $no++ ?></td>
                    <td class="px-6 py-4 text-gray-300"><?= esc($r['created_at']) ?></td>
                    <td class="px-6 py-4 font-medium"><?= esc($r['username']) ?></td>
                    <td class="px-6 py-4"><?= esc($r['judul']) ?></td>
                    <td class="px-6 py-4">
                        <span class="bg-teal-500/20 text-teal-300 px-3 py-1 rounded-full text-xs font-semibold border border-teal-500/30 whitespace-nowrap">
                            <?= esc($r['aksi']) ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-300 text-sm"><?= esc($r['keterangan']) ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($riwayat)): ?>
                <tr><td colspan="6" class="px-6 py-8 text-center text-gray-400 italic">Belum ada riwayat aktivitas.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= view('Backend/Template/footer') ?>
