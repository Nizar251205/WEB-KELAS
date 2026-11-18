@extends('layouts.app')

@section('title', 'Detail Mahasiswa - ' . $student['nama'])

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <!-- Tombol Kembali (Activity Diagram Page 6: "Klik tombol kembali") -->
    <div class="mb-6">
        <a href="{{ route('mahasiswa.index') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-500 hover:text-brand-600 transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar Mahasiswa</span>
        </a>
    </div>

    <!-- Activity Diagram Page 6: "Tampilkan nim, nama, kelas, jabatan, email, no hp" -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xl overflow-hidden">
        
        <!-- Header Banner Card -->
        <div class="p-6 sm:p-8 bg-gradient-to-r from-brand-700 to-indigo-700 text-white flex items-center space-x-5">
            <div class="w-20 h-20 rounded-2xl bg-white/20 border-2 border-white/30 backdrop-blur-md flex items-center justify-center text-3xl font-extrabold text-white flex-shrink-0 shadow-lg">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div>
                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold bg-white/20 text-white backdrop-blur-md border border-white/20 mb-1.5">
                    {{ $student['kelas'] }} • {{ $student['gender'] ?? 'Laki-laki' }}
                </span>
                <h1 class="text-xl sm:text-2xl font-black text-white leading-tight">
                    {{ $student['nama'] }}
                </h1>
                <p class="text-xs text-indigo-100 font-mono mt-0.5">NIM: {{ $student['nim'] }}</p>
            </div>
        </div>

        <!-- Detail Data Grid -->
        <div class="p-6 sm:p-8 space-y-5">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Nomor Induk Mahasiswa (NIM):</span>
                    <span class="text-base font-bold text-slate-800 font-mono">{{ $student['nim'] }}</span>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Nama Lengkap:</span>
                    <span class="text-base font-bold text-slate-800">{{ $student['nama'] }}</span>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Kelas:</span>
                    <span class="text-base font-bold text-slate-800">{{ $student['kelas'] }}</span>
                </div>

                <div class="p-4 rounded-2xl bg-brand-50/70 border border-brand-100">
                    <span class="text-xs font-bold uppercase tracking-wider text-brand-600 block mb-1">Jabatan di Kelas:</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black 
                        {{ $student['jabatan'] === 'Ketua Kelas' ? 'bg-amber-100 text-amber-800' : '' }}
                        {{ $student['jabatan'] === 'Wakil Ketua Kelas' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ in_array($student['jabatan'], ['Sekretaris', 'Bendahara']) ? 'bg-indigo-100 text-indigo-800' : '' }}
                        {{ $student['jabatan'] === 'Anggota' ? 'bg-slate-200 text-slate-700' : '' }}
                    ">
                        {{ $student['jabatan'] }}
                    </span>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Email Mahasiswa:</span>
                    <a href="mailto:{{ $student['email'] }}" class="text-sm font-semibold text-brand-600 hover:underline flex items-center">
                        <i class="fa-regular fa-envelope mr-1.5 text-slate-400"></i>
                        {{ $student['email'] }}
                    </a>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Nomor Handphone / WhatsApp:</span>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $student['no_hp']) }}" target="_blank" class="text-sm font-semibold text-emerald-600 hover:underline flex items-center">
                        <i class="fa-brands fa-whatsapp mr-1.5"></i>
                        {{ $student['no_hp'] }}
                    </a>
                </div>

            </div>

            <!-- Footer Action inside Card -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                <span class="text-xs text-slate-400">Data terverifikasi di SI2A POLSUB</span>
                <a href="{{ route('mahasiswa.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-md transition">
                    &larr; Tampilkan Kembali Data Mahasiswa
                </a>
            </div>

        </div>

    </div>

</div>
@endsection
