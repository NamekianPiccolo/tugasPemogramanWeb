<?= view('Backend/Template/header') ?>
<?= view('Backend/Template/sidebar') ?>

<div class="mb-8">
    <h1 class="text-3xl font-bold text-white tracking-wide">Selamat Datang, <?= esc(session()->get('username')) ?>!</h1>
    <p class="text-gray-300 mt-2">Berikut adalah ringkasan sistem arsip dokumen Anda hari ini.</p>
</div>

<!-- Stat Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Card 1 -->
    <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-6 shadow-2xl flex items-center justify-between hover:-translate-y-1 transition-transform duration-300">
        <div>
            <p class="text-gray-300 text-sm uppercase tracking-wider font-semibold mb-1">Total Dokumen</p>
            <h3 class="text-4xl font-bold text-white"><?= esc($total_dokumen) ?></h3>
        </div>
        <div class="w-16 h-16 rounded-full bg-blue-500/20 flex items-center justify-center border border-blue-500/30">
            <i class="fas fa-folder-open text-2xl text-blue-400"></i>
        </div>
    </div>
    
    <!-- Card 2 -->
    <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-6 shadow-2xl flex items-center justify-between hover:-translate-y-1 transition-transform duration-300">
        <div>
            <p class="text-gray-300 text-sm uppercase tracking-wider font-semibold mb-1">Kategori Dokumen</p>
            <h3 class="text-4xl font-bold text-white"><?= esc($total_kategori) ?></h3>
        </div>
        <div class="w-16 h-16 rounded-full bg-orange-500/20 flex items-center justify-center border border-orange-500/30">
            <i class="fas fa-tags text-2xl text-orange-400"></i>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-6 shadow-2xl flex items-center justify-between hover:-translate-y-1 transition-transform duration-300">
        <div>
            <p class="text-gray-300 text-sm uppercase tracking-wider font-semibold mb-1">Unit / Bagian</p>
            <h3 class="text-4xl font-bold text-white"><?= esc($total_unit) ?></h3>
        </div>
        <div class="w-16 h-16 rounded-full bg-brand-500/20 flex items-center justify-center border border-brand-500/30">
            <i class="fas fa-briefcase text-2xl text-brand-400"></i>
        </div>
    </div>
</div>

<?= view('Backend/Template/footer') ?>
