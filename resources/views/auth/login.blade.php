@extends('layouts.app')

@section('title', 'Login Sistem Informasi 2A')

@section('content')
<div class="w-full max-w-md my-auto">
    
    <!-- Cyber Card Wrapper -->
    <div class="relative bg-slate-900/85 backdrop-blur-xl rounded-3xl border border-slate-800 shadow-2xl p-8 sm:p-10 text-white overflow-hidden ring-1 ring-white/10">
        
        <!-- Glowing Cyan Neon Top Line -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-500 via-brand-500 to-indigo-500 shadow-lg shadow-cyan-500/50"></div>
        <div class="absolute -top-24 -left-24 w-48 h-48 bg-cyan-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-brand-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Header: Logo & Title -->
        <div class="text-center mb-8 relative">
            <div class="relative inline-block mb-4">
                <img src="{{ asset('images/logo-si2a.png') }}" 
                     alt="Logo Sistem Informasi 2A" 
                     class="w-20 h-20 rounded-2xl mx-auto shadow-xl ring-2 ring-brand-500/60 object-cover">
                <span class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-400 border-2 border-slate-900 rounded-full animate-ping"></span>
                <span class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-500 border-2 border-slate-900 rounded-full"></span>
            </div>
            
            <h1 class="text-2xl font-black text-white tracking-tight">
                Sistem Informasi 2A
            </h1>
            <p class="text-xs text-slate-400 mt-1 font-medium">
                Politeknik Negeri Subang • D-III Sistem Informasi
            </p>
        </div>

        <!-- Alert Error jika ada -->
        @if(session('error'))
        <div class="mb-5 p-3.5 rounded-xl bg-rose-500/20 border border-rose-500/40 text-rose-200 text-xs flex items-center space-x-2.5">
            <i class="fa-solid fa-circle-exclamation text-rose-400 text-sm flex-shrink-0"></i>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        @if(session('success'))
        <div class="mb-5 p-3.5 rounded-xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-200 text-xs flex items-center space-x-2.5">
            <i class="fa-solid fa-circle-check text-emerald-400 text-sm flex-shrink-0"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <!-- Form Login -->
        <form action="{{ route('login.post') }}" method="POST" class="space-y-5 relative">
            @csrf

            <div>
                <label for="login_id" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                    Username / Email / NIM
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                        <i class="fa-solid fa-user-astronaut"></i>
                    </span>
                    <input type="text" 
                           id="login_id" 
                           name="login_id" 
                           value="{{ old('login_id') }}" 
                           placeholder="Contoh: admin atau 10112001"
                           class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/70 border border-slate-700/80 text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
                </div>
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                    Password
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                        <i class="fa-solid fa-key"></i>
                    </span>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           placeholder="••••••••"
                           class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/70 border border-slate-700/80 text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition-all">
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 text-white font-extrabold text-sm shadow-lg shadow-brand-500/30 transition-all flex items-center justify-center space-x-2 transform hover:-translate-y-0.5">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>Masuk ke Sistem</span>
            </button>
        </form>

        <!-- Quick Demo Credentials -->
        <div class="mt-8 pt-6 border-t border-slate-800/80 relative">
            <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest block text-center mb-3">
                Klik Cepat untuk Demo Pengujian:
            </span>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <button type="button" 
                        onclick="fillLogin('admin', 'admin123')"
                        class="p-2.5 rounded-xl border border-rose-500/30 bg-rose-950/40 hover:bg-rose-900/50 text-rose-200 text-left transition flex flex-col justify-between">
                    <span class="font-bold flex items-center text-xs"><i class="fa-solid fa-shield-halved mr-1.5 text-rose-400"></i> Admin</span>
                    <span class="text-[11px] text-rose-300 font-mono mt-1">admin / admin123</span>
                </button>
                <button type="button" 
                        onclick="fillLogin('10112001', '12345678')"
                        class="p-2.5 rounded-xl border border-emerald-500/30 bg-emerald-950/40 hover:bg-emerald-900/50 text-emerald-200 text-left transition flex flex-col justify-between">
                    <span class="font-bold flex items-center text-xs"><i class="fa-solid fa-user-graduate mr-1.5 text-emerald-400"></i> Mahasiswa</span>
                    <span class="text-[11px] text-emerald-300 font-mono mt-1">10112001 / 12345678</span>
                </button>
            </div>
        </div>

    </div>

</div>

<script>
    function fillLogin(u, p) {
        document.getElementById('login_id').value = u;
        document.getElementById('password').value = p;
    }
</script>
@endsection
