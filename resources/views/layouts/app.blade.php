<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi 2A') - Politeknik Negeri Subang</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f7ff',
                            100: '#e0effe',
                            200: '#bae0fd',
                            300: '#7cc8fc',
                            400: '#38abf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        cyber: {
                            dark: '#090d16',
                            card: '#0f172a',
                            border: '#1e293b',
                            cyan: '#06b6d4',
                            glow: '#38bdf8'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
        }
        .cyber-glass {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        .glow-cyan {
            box-shadow: 0 0 25px -5px rgba(14, 165, 233, 0.35);
        }
        .glow-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glow-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px -10px rgba(14, 165, 233, 0.18);
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: #ffffff !important;
                color: #000000 !important;
            }
            .main-content-wrapper {
                padding-left: 0 !important;
            }
        }
    </style>
</head>
<body class="h-full text-slate-800 antialiased selection:bg-brand-500 selection:text-white flex">

    @if(session()->has('auth_user'))
        <!-- BACKDROP MOBILE SIDEBAR OVERLAY -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-40 hidden md:hidden transition-opacity" onclick="toggleSidebar()"></div>

        <!-- MODERN CYBER-SLATE SIDEBAR -->
        <aside id="main-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 lg:w-72 bg-gradient-to-b from-slate-950 via-slate-900 to-indigo-950 border-r border-slate-800/80 text-slate-300 flex flex-col justify-between transition-transform duration-300 -translate-x-full md:translate-x-0 shadow-2xl no-print">
            
            <div class="flex flex-col">
                <!-- Sidebar Header: Brand Logo & Title -->
                <div class="h-20 px-5 flex items-center justify-between border-b border-slate-800/80 bg-slate-950/40">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group min-w-0">
                        <div class="relative flex-shrink-0">
                            <img src="{{ asset('images/logo-si2a.png') }}" 
                                 alt="Logo Sistem Informasi 2A" 
                                 class="w-11 h-11 rounded-xl object-cover ring-2 ring-brand-500/50 shadow-lg shadow-brand-500/20 group-hover:scale-105 transition-transform duration-300">
                            <span class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-emerald-500 border-2 border-slate-950 rounded-full" title="Sistem Aktif"></span>
                        </div>
                        <div class="min-w-0 flex-grow">
                            <span class="font-black text-white text-base leading-tight group-hover:text-brand-400 transition-colors block truncate tracking-tight">
                                Sistem Informasi 2A
                            </span>
                            <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest block">
                                POLSUB
                            </span>
                        </div>
                    </a>

                    <!-- Mobile Close -->
                    <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>

                <!-- User Profile Card in Sidebar -->
                <div class="p-3.5 mx-3.5 my-4 rounded-2xl bg-slate-900/80 border border-slate-800/90 shadow-inner flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl {{ session('auth_user.role') === 'admin' ? 'bg-gradient-to-tr from-rose-600 to-amber-500 text-white' : 'bg-gradient-to-tr from-brand-600 to-emerald-500 text-white' }} flex items-center justify-center text-sm font-black flex-shrink-0 shadow-md">
                        <i class="fa-solid {{ session('auth_user.role') === 'admin' ? 'fa-shield-halved' : 'fa-user-graduate' }}"></i>
                    </div>
                    <div class="min-w-0 flex-grow">
                        <div class="flex items-center space-x-1.5">
                            <span class="block text-xs font-bold text-white truncate leading-tight">
                                {{ session('auth_user.name') }}
                            </span>
                        </div>
                        <div class="flex items-center space-x-1.5 mt-1">
                            <span class="w-2 h-2 rounded-full {{ session('auth_user.role') === 'admin' ? 'bg-rose-400' : 'bg-emerald-400' }} animate-pulse"></span>
                            <span class="text-[10px] font-extrabold uppercase tracking-wider {{ session('auth_user.role') === 'admin' ? 'text-rose-400' : 'text-emerald-400' }}">
                                Role: {{ session('auth_user.role') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Navigation Menu -->
                <div class="px-3 space-y-6 overflow-y-auto">
                    
                    <!-- Kategori: Menu Utama -->
                    <div>
                        <span class="px-3 text-[10px] font-black uppercase tracking-widest text-slate-500 block mb-2">
                            Menu Utama
                        </span>
                        <nav class="space-y-1.5">
                            
                            <!-- Dashboard -->
                            <a href="{{ route('dashboard') }}" 
                               class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-brand-600 to-indigo-600 text-white shadow-lg shadow-brand-500/25 ring-1 ring-white/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                                <i class="fa-solid fa-chart-pie w-5 text-center text-sm {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                                <span>Dashboard</span>
                            </a>

                            <!-- Profil Kelas -->
                            <a href="{{ route('profil.index') }}" 
                               class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 {{ request()->routeIs('profil.*') ? 'bg-gradient-to-r from-brand-600 to-indigo-600 text-white shadow-lg shadow-brand-500/25 ring-1 ring-white/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                                <i class="fa-solid fa-id-card w-5 text-center text-sm {{ request()->routeIs('profil.*') ? 'text-white' : 'text-slate-400' }}"></i>
                                <span>Profil Kelas</span>
                            </a>

                            <!-- Data Mahasiswa -->
                            <a href="{{ route('mahasiswa.index') }}" 
                               class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 {{ request()->routeIs('mahasiswa.*') ? 'bg-gradient-to-r from-brand-600 to-indigo-600 text-white shadow-lg shadow-brand-500/25 ring-1 ring-white/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                                <i class="fa-solid fa-users w-5 text-center text-sm {{ request()->routeIs('mahasiswa.*') ? 'text-white' : 'text-slate-400' }}"></i>
                                <span>Data Mahasiswa</span>
                            </a>

                            <!-- Struktur Kelas -->
                            <a href="{{ route('struktur.index') }}" 
                               class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 {{ request()->routeIs('struktur.*') ? 'bg-gradient-to-r from-brand-600 to-indigo-600 text-white shadow-lg shadow-brand-500/25 ring-1 ring-white/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                                <i class="fa-solid fa-sitemap w-5 text-center text-sm {{ request()->routeIs('struktur.*') ? 'text-white' : 'text-slate-400' }}"></i>
                                <span>Struktur Organisasi</span>
                            </a>

                        </nav>
                    </div>

                    <!-- Kategori: Laporan & Dokumen -->
                    <div>
                        <span class="px-3 text-[10px] font-black uppercase tracking-widest text-slate-500 block mb-2">
                            Laporan & Administrasi
                        </span>
                        <nav class="space-y-1.5">
                            
                            <!-- Generate Laporan -->
                            <a href="{{ route('laporan.index') }}" 
                               class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 {{ request()->routeIs('laporan.*') ? 'bg-gradient-to-r from-brand-600 to-indigo-600 text-white shadow-lg shadow-brand-500/25 ring-1 ring-white/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                                <i class="fa-solid fa-file-lines w-5 text-center text-sm {{ request()->routeIs('laporan.*') ? 'text-white' : 'text-slate-400' }}"></i>
                                <span>Generate Laporan</span>
                            </a>

                        </nav>
                    </div>

                </div>
            </div>

            <!-- Sidebar Bottom: Logout -->
            <div class="p-4 border-t border-slate-800/80 bg-slate-950/60">
                <a href="{{ route('logout') }}" 
                   class="w-full py-2.5 px-3 rounded-xl bg-slate-900 hover:bg-rose-950/70 border border-slate-800 hover:border-rose-800/60 text-slate-300 hover:text-rose-300 text-xs font-bold transition-all flex items-center justify-center space-x-2 shadow-sm">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar dari Sistem</span>
                </a>
            </div>

        </aside>

        <!-- MAIN CONTENT WRAPPER -->
        <div class="flex-1 flex flex-col min-h-screen md:pl-64 lg:pl-72 main-content-wrapper">
            
            <!-- Top App Bar / Header -->
            <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200/80 px-4 sm:px-6 lg:px-8 flex items-center justify-between sticky top-0 z-30 shadow-xs no-print">
                <div class="flex items-center space-x-3">
                    <!-- Mobile Hamburger -->
                    <button type="button" onclick="toggleSidebar()" class="md:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-100 focus:outline-none transition" aria-label="Toggle Sidebar">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>
                    <div>
                        <h2 class="text-xs sm:text-sm font-extrabold text-slate-900 leading-tight">
                            Politeknik Negeri Subang
                        </h2>
                        <span class="text-[11px] font-medium text-slate-500">
                            Kelas Sistem Informasi 2A • D-III Sistem Informasi
                        </span>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <span class="hidden sm:inline-flex items-center px-3.5 py-1.5 rounded-full text-xs font-black {{ session('auth_user.role') === 'admin' ? 'bg-rose-50 text-rose-700 border border-rose-200' : 'bg-brand-50 text-brand-700 border border-brand-200' }} shadow-xs">
                        <i class="fa-solid {{ session('auth_user.role') === 'admin' ? 'fa-shield-halved' : 'fa-user-graduate' }} mr-1.5 {{ session('auth_user.role') === 'admin' ? 'text-rose-600' : 'text-brand-600' }}"></i>
                        <span>{{ session('auth_user.role') === 'admin' ? 'Administrator' : 'Mahasiswa' }}</span>
                    </span>
                    <div class="w-9 h-9 rounded-xl {{ session('auth_user.role') === 'admin' ? 'bg-rose-50 text-rose-700 border border-rose-200' : 'bg-brand-50 text-brand-700 border border-brand-200' }} flex items-center justify-center text-xs font-black shadow-xs" title="{{ session('auth_user.name') }}">
                        <i class="fa-solid {{ session('auth_user.role') === 'admin' ? 'fa-user-shield' : 'fa-user-graduate' }}"></i>
                    </div>
                </div>
            </header>

            <!-- Global Toast / Alerts -->
            <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 pt-4 no-print">
                @if(session('success'))
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs sm:text-sm flex items-center justify-between shadow-sm mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 text-lg font-bold px-2">&times;</button>
                </div>
                @endif

                @if(session('error'))
                <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 text-xs sm:text-sm flex items-center justify-between shadow-sm mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>
                        <span class="font-semibold">{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 text-lg font-bold px-2">&times;</button>
                </div>
                @endif

                @if($errors->any())
                <div class="p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 text-xs sm:text-sm shadow-sm mb-4">
                    <div class="flex items-center space-x-2.5 mb-2 font-bold">
                        <i class="fa-solid fa-triangle-exclamation text-amber-600"></i>
                        <span>Mohon periksa input berikut:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-0.5 ml-4 text-amber-800">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Page Main Content -->
            <main class="flex-grow">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-slate-200/80 mt-auto py-5 px-4 sm:px-6 lg:px-8 no-print">
                <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
                    <div class="flex items-center space-x-2">
                        <strong class="text-slate-800 font-bold">Sistem Informasi 2A</strong>
                        <span>•</span>
                        <span>Politeknik Negeri Subang (Kelompok 4)</span>
                    </div>
                    <div class="text-slate-400">
                        Dosen Pengampu: <span class="font-semibold text-slate-600">Rahmat Irsyada, M.Pd.</span> & <span class="font-semibold text-slate-600">Usep Abdul Rosid, M.Kom.</span>
                    </div>
                </div>
            </footer>

        </div>

    @else
        <!-- GUEST (LOGIN SCREEN): Fullscreen Cyber Aesthetic -->
        <div class="w-full min-h-screen flex flex-col justify-between bg-gradient-to-tr from-slate-950 via-slate-900 to-indigo-950">
            <main class="flex-grow flex items-center justify-center p-4">
                @yield('content')
            </main>
            <footer class="py-4 text-center text-xs text-slate-500 no-print">
                Sistem Informasi 2A • Politeknik Negeri Subang
            </footer>
        </div>
    @endif

    <!-- Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('main-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (sidebar && overlay) {
                const isOpen = !sidebar.classList.contains('-translate-x-full');
                if (isOpen) {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                } else {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                }
            }
        }
    </script>
</body>
</html>
