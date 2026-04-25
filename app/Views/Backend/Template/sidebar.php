    <?php $uri = current_url(true); $seg2 = $uri->getTotalSegments() >= 2 ? $uri->getSegment(2) : ''; ?>
    
    <!-- Sidebar -->
    <aside class="w-72 fixed h-full z-20 top-0 left-0 flex flex-col bg-[#0f172a]/40 backdrop-blur-xl border-r border-white/10 shadow-[0_0_40px_rgba(0,0,0,0.3)] transition-transform duration-300">
        
        <!-- Logo -->
        <div class="flex items-center justify-center h-20 border-b border-white/10">
            <h1 class="text-2xl font-bold text-white tracking-wider">Arsip<span class="text-brand-500">Digital</span></h1>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-2">
            
            <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300 <?= $seg2 == 'dashboard' ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/30' : 'text-gray-300 hover:bg-white/10 hover:text-white' ?>">
                <i class="fas fa-chart-pie w-5 text-center"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            <a href="<?= base_url('admin/dokumen') ?>" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300 <?= $seg2 == 'dokumen' ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/30' : 'text-gray-300 hover:bg-white/10 hover:text-white' ?>">
                <i class="fas fa-folder-open w-5 text-center"></i>
                <span class="font-medium">Data Dokumen</span>
            </a>

            <a href="<?= base_url('admin/kategori') ?>" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300 <?= $seg2 == 'kategori' ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/30' : 'text-gray-300 hover:bg-white/10 hover:text-white' ?>">
                <i class="fas fa-tags w-5 text-center"></i>
                <span class="font-medium">Kategori Dokumen</span>
            </a>

            <a href="<?= base_url('admin/unit') ?>" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300 <?= $seg2 == 'unit' ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/30' : 'text-gray-300 hover:bg-white/10 hover:text-white' ?>">
                <i class="fas fa-briefcase w-5 text-center"></i>
                <span class="font-medium">Unit / Bagian</span>
            </a>

            <a href="<?= base_url('admin/distribusi') ?>" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300 <?= $seg2 == 'distribusi' ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/30' : 'text-gray-300 hover:bg-white/10 hover:text-white' ?>">
                <i class="fas fa-exchange-alt w-5 text-center"></i>
                <span class="font-medium">Distribusi</span>
            </a>

            <a href="<?= base_url('admin/riwayat') ?>" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300 <?= $seg2 == 'riwayat' ? 'bg-brand-500 text-white shadow-lg shadow-brand-500/30' : 'text-gray-300 hover:bg-white/10 hover:text-white' ?>">
                <i class="fas fa-history w-5 text-center"></i>
                <span class="font-medium">Riwayat</span>
            </a>

        </nav>

        <!-- User Info & Logout -->
        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-4 px-4 py-3 mb-2 rounded-xl bg-black/20 border border-white/5">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-brand-500 to-teal-400 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                    <?= strtoupper(substr(session()->get('username') ?? 'A', 0, 1)) ?>
                </div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-sm font-semibold text-white truncate"><?= esc(session()->get('username')) ?></p>
                    <p class="text-xs text-brand-400 truncate"><?= esc(session()->get('role')) ?></p>
                </div>
            </div>
            <a href="<?= base_url('logout') ?>" class="flex items-center justify-center gap-2 w-full py-3 rounded-xl bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white border border-red-500/30 transition-all duration-300 font-medium">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <main class="flex-1 ml-72 min-h-screen flex flex-col transition-all duration-300 relative">
        
        <!-- Topbar Navbar (Optional, can just be a padding area) -->
        <header class="h-20 w-full flex items-center justify-between px-8 bg-[#0f172a]/20 backdrop-blur-md border-b border-white/5 sticky top-0 z-10">
            <h2 class="text-xl font-semibold text-white capitalize"><?= $seg2 ?: 'Dashboard' ?> Overview</h2>
            <div class="flex items-center gap-4">
                <div class="text-sm text-gray-300 bg-white/5 px-4 py-2 rounded-full border border-white/10">
                    <i class="far fa-calendar-alt mr-2"></i> <?= date('d M Y') ?>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="p-8 flex-1">