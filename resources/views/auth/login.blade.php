@extends('layouts.app')

@section('title', 'Login Sistem')

@section('content')
<div class="min-h-[80vh] flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-md w-full bg-white rounded-3xl border border-slate-200/80 shadow-xl p-8 sm:p-10 relative overflow-hidden">
        
        <!-- Header Banner Accent -->
        <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-brand-600 via-indigo-600 to-blue-500"></div>

        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-brand-700 to-indigo-600 text-white flex items-center justify-center text-2xl mx-auto shadow-lg shadow-brand-500/25 mb-4">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Sistem Informasi Kelas</h1>
            <p class="text-xs text-slate-500 mt-1">SI2A • Politeknik Negeri Subang</p>
        </div>

        <!-- Form Login (Activity Diagram Page 2) -->
        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="login_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Username / Email / NIM
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                        <i class="fa-regular fa-user"></i>
                    </span>
                    <input type="text" 
                           id="login_id" 
                           name="login_id" 
                           value="{{ old('login_id') }}" 
                           placeholder="Contoh: admin atau 10112001"
                           class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent text-sm placeholder-slate-400 transition">
                </div>
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Password
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           placeholder="••••••••"
                           class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent text-sm placeholder-slate-400 transition">
                </div>
            </div>

            <button type="submit" class="w-full py-3 px-4 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm shadow-md shadow-brand-500/20 transition-all flex items-center justify-center space-x-2">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>Masuk ke Dashboard</span>
            </button>
        </form>

        <!-- Quick Credentials Info for Grading / Demo -->
        <div class="mt-8 pt-6 border-t border-slate-100">
            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block text-center mb-3">
                Akun Demo untuk Pengujian:
            </span>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <button type="button" 
                        onclick="fillLogin('admin', 'admin123')"
                        class="p-2.5 rounded-xl border border-rose-200 bg-rose-50 hover:bg-rose-100 text-rose-800 text-left transition">
                    <span class="font-bold block flex items-center"><i class="fa-solid fa-shield mr-1"></i> Admin</span>
                    <span class="text-[11px] text-rose-600 font-mono">admin / admin123</span>
                </button>
                <button type="button" 
                        onclick="fillLogin('10112001', '12345678')"
                        class="p-2.5 rounded-xl border border-emerald-200 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 text-left transition">
                    <span class="font-bold block flex items-center"><i class="fa-solid fa-user-graduate mr-1"></i> Mahasiswa</span>
                    <span class="text-[11px] text-emerald-600 font-mono">10112001 / 12345678</span>
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
