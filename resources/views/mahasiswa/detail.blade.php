@extends('layouts.app')

@section('title', 'Detail Mahasiswa - ' . $student['nama'])

@section('content')
<div class="max-w-3xl mx-auto px-3 sm:px-6 lg:px-8 py-6 sm:py-10">

    <!-- Tombol Kembali -->
    <div class="mb-5 sm:mb-6">
        <a href="{{ route('mahasiswa.index') }}" class="inline-flex items-center space-x-2 text-xs font-black text-slate-500 hover:text-brand-600 transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar Mahasiswa</span>
        </a>
    </div>

    <!-- Academic ID Card -->
    <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-xl overflow-hidden glow-card">
        
        <!-- Header Banner Card -->
        <div class="p-5 sm:p-8 bg-gradient-to-r from-slate-950 via-slate-900 to-indigo-950 text-white flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-4 sm:gap-5 relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-brand-500/20 rounded-full blur-2xl pointer-events-none"></div>

            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-tr from-brand-600 to-indigo-500 border-2 border-white/20 backdrop-blur-md flex items-center justify-center text-2xl sm:text-3xl font-black text-white flex-shrink-0 shadow-lg shadow-brand-500/30">
                {{ substr($student['nama'], 0, 1) }}
            </div>
            <div class="min-w-0">
                <span class="inline-block px-3 py-0.5 rounded-full text-xs font-black bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 mb-1.5">
                    {{ $student['kelas'] }} • {{ $student['gender'] ?? 'Laki-laki' }}
                </span>
                <h1 class="text-xl sm:text-2xl font-black text-white leading-tight truncate">
                    {{ $student['nama'] }}
                </h1>
                <p class="text-xs text-slate-300 font-mono mt-0.5">NIM: {{ $student['nim'] }}</p>
            </div>
        </div>

        <!-- Detail Data Grid -->
        <div class="p-4 sm:p-8 space-y-4 sm:space-y-6">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                
                <div class="p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-slate-50/80 border border-slate-100">
                    <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 block mb-1">NIM Mahasiswa:</span>
                    <span class="text-sm sm:text-base font-black text-slate-900 font-mono">{{ $student['nim'] }}</span>
                </div>

                <div class="p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-slate-50/80 border border-slate-100">
                    <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 block mb-1">Nama Lengkap:</span>
                    <span class="text-sm sm:text-base font-black text-slate-900">{{ $student['nama'] }}</span>
                </div>

                <div class="p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-slate-50/80 border border-slate-100">
                    <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 block mb-1">Kelas:</span>
                    <span class="text-sm sm:text-base font-black text-slate-900">{{ $student['kelas'] }}</span>
                </div>

                <div class="p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-brand-50/60 border border-brand-100">
                    <span class="text-[10px] font-black uppercase tracking-wider text-brand-600 block mb-1">Jabatan di Kelas:</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black 
                        {{ $student['jabatan'] === 'Ketua Kelas' ? 'bg-amber-100 text-amber-800' : '' }}
                        {{ $student['jabatan'] === 'Wakil Ketua Kelas' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ in_array($student['jabatan'], ['Sekretaris', 'Bendahara']) ? 'bg-indigo-100 text-indigo-800' : '' }}
                        {{ $student['jabatan'] === 'Anggota' ? 'bg-slate-200 text-slate-700' : '' }}
                    ">
                        {{ $student['jabatan'] }}
                    </span>
                </div>

                <div class="p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-slate-50/80 border border-slate-100">
                    <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 block mb-1">Email Mahasiswa:</span>
                    <a href="mailto:{{ $student['email'] }}" class="text-xs sm:text-sm font-bold text-brand-600 hover:underline flex items-center truncate">
                        <i class="fa-regular fa-envelope mr-1.5 text-slate-400 flex-shrink-0"></i>
                        <span class="truncate">{{ $student['email'] }}</span>
                    </a>
                </div>

                <div class="p-3.5 sm:p-4 rounded-xl sm:rounded-2xl bg-slate-50/80 border border-slate-100">
                    <span class="text-[10px] font-black uppercase tracking-wider text-slate-400 block mb-1">WhatsApp / HP:</span>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $student['no_hp']) }}" target="_blank" class="text-xs sm:text-sm font-bold text-emerald-600 hover:underline flex items-center">
                        <i class="fa-brands fa-whatsapp mr-1.5"></i>
                        {{ $student['no_hp'] }}
                    </a>
                </div>

            </div>

            <!-- Footer Action inside Card -->
            <div class="pt-4 sm:pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
                <span class="text-[11px] sm:text-xs text-slate-400">Sistem Informasi 2A • POLSUB</span>
                <a href="{{ route('mahasiswa.index') }}" class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-black text-xs shadow-md transition text-center">
                    &larr; Tampilkan Kembali Data
                </a>
            </div>

        </div>

    </div>

</div>
@endsection
