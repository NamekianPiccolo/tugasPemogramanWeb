<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Digital Archive System</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/output.css') ?>">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-image: linear-gradient(rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.8)), url('<?= base_url('images/login_bg.png') ?>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .input-glass {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .input-glass:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #1D9E75;
            box-shadow: 0 0 20px rgba(29, 158, 117, 0.2);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #1D9E75 0%, #0F6E56 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(15, 110, 86, 0.3);
            filter: brightness(1.1);
        }

        .float-animation {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Custom Scrollbar for the info area */
        .custom-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 relative overflow-hidden">

    <!-- Ambient Glow -->
    <div class="absolute top-1/4 -left-20 w-80 h-80 bg-brand-500/20 rounded-full blur-[100px] opacity-50"></div>
    <div class="absolute bottom-1/4 -right-20 w-80 h-80 bg-teal-500/20 rounded-full blur-[100px] opacity-50"></div>

    <div class="w-full max-w-5xl grid grid-cols-1 lg:grid-cols-2 glass-card rounded-[3rem] overflow-hidden animate-in fade-in zoom-in duration-700">
        
        <!-- Left Side: Login Form -->
        <div class="p-10 lg:p-20 flex flex-col justify-center">
            <div class="mb-10">
                <div class="w-16 h-16 bg-brand-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-brand-500/30 float-animation">
                    <i class="fas fa-archive text-white text-2xl"></i>
                </div>
                <h1 class="text-4xl font-bold text-white tracking-tight mb-3">Selamat Datang</h1>
                <p class="text-gray-400">Masuk untuk mengakses sistem arsip digital.</p>
            </div>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-4 rounded-2xl mb-8 flex items-center gap-3 text-sm font-medium animate-in slide-in-from-top duration-300">
                    <i class="fas fa-circle-exclamation text-lg"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login') ?>" method="POST" class="space-y-6">
                <?= csrf_field() ?>
                
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Username</label>
                    <div class="relative">
                        <i class="far fa-user absolute left-5 top-1/2 -translate-y-1/2 text-gray-500"></i>
                        <input type="text" name="username" placeholder="Masukkan username" class="w-full input-glass p-5 pl-14 rounded-2xl text-white outline-none placeholder:text-gray-600 font-medium" required>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Password</label>
                    <div class="relative">
                        <i class="far fa-lock absolute left-5 top-1/2 -translate-y-1/2 text-gray-500"></i>
                        <input type="password" name="password" placeholder="Masukkan password" class="w-full input-glass p-5 pl-14 rounded-2xl text-white outline-none placeholder:text-gray-600 font-medium" required>
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm px-1">
                    <label class="flex items-center gap-2 text-gray-500 cursor-pointer group">
                        <input type="checkbox" class="rounded border-gray-700 bg-gray-800 text-brand-500 focus:ring-brand-500/20 transition-all">
                        <span class="group-hover:text-gray-300 transition-colors">Ingat Saya</span>
                    </label>
                    <a href="#" class="text-brand-400 hover:text-brand-300 font-semibold transition-all">Lupa Password?</a>
                </div>

                <button type="submit" class="w-full btn-gradient text-white font-bold py-5 rounded-2xl shadow-xl shadow-brand-500/10 text-lg">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-12 pt-8 border-t border-white/5 text-center">
                <p class="text-gray-500 text-sm">
                    Belum punya akun? <span class="text-brand-400 font-semibold cursor-pointer hover:text-brand-300 transition-colors" id="showInfo">Hubungi Admin</span>
                </p>
            </div>
        </div>

        <!-- Right Side: Info/Decoration -->
        <div class="hidden lg:flex flex-col justify-between p-20 bg-black/20 border-l border-white/5 relative overflow-hidden">
            <!-- Geometric Decoration -->
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-brand-500/10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-white mb-6 leading-tight">Masa Depan <br><span class="text-brand-400">Pengarsipan Digital</span></h2>
                <div class="space-y-8">
                    <div class="flex gap-5">
                        <div class="w-12 h-12 shrink-0 rounded-xl bg-white/5 flex items-center justify-center border border-white/10">
                            <i class="fas fa-shield-check text-brand-400"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-bold mb-1">Keamanan Terjamin</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Enkripsi data tingkat tinggi untuk melindungi setiap dokumen berharga Anda.</p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="w-12 h-12 shrink-0 rounded-xl bg-white/5 flex items-center justify-center border border-white/10">
                            <i class="fas fa-bolt text-brand-400"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-bold mb-1">Akses Instan</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Cari dan temukan dokumen dalam hitungan detik dengan mesin pencari pintar.</p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="w-12 h-12 shrink-0 rounded-xl bg-white/5 flex items-center justify-center border border-white/10">
                            <i class="fas fa-users text-brand-400"></i>
                        </div>
                        <div>
                            <h4 class="text-white font-bold mb-1">Kolaborasi Tim</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Bagikan dokumen dan kelola izin akses tim Anda dengan kontrol penuh.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative z-10">
                <div class="p-6 bg-brand-500/10 border border-brand-500/20 rounded-3xl backdrop-blur-sm">
                    <p class="text-brand-200 text-sm font-medium mb-1 italic">"Efisiensi adalah kunci kesuksesan modern."</p>
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">- Kelompok 6 Projek</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Modals or Overlays can be added here -->

</body>
</html>