@extends('layouts.app')

@section('title', 'Profil Kelas - Sistem Informasi 2A')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-brand-50 text-brand-700 border border-brand-200">
                    Informasi Akademik
                </span>
                <span class="text-xs text-slate-400">Sistem Informasi 2A</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1.5 tracking-tight">
                Profil & Identitas Kelas
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                Data resmi entitas kelas Program Studi D-III Sistem Informasi POLSUB
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap items-center gap-2">
            @if($isAdmin)
                <button type="button" onclick="openModal('modal-edit-profil')" class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 text-white text-xs font-extrabold shadow-lg shadow-brand-500/25 transition-all flex items-center space-x-1.5">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Kelola Profil Kelas</span>
                </button>
                @if($hasProfile)
                <button type="button" onclick="openModal('modal-delete-profil')" class="px-3.5 py-2.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold border border-rose-200 transition flex items-center space-x-1">
                    <i class="fa-solid fa-trash-can"></i>
                    <span>Hapus</span>
                </button>
                @endif
            @else
                <div class="text-xs text-slate-500 bg-white px-3.5 py-2 rounded-xl border border-slate-200 shadow-xs">
                    <i class="fa-solid fa-lock text-slate-400 mr-1"></i> Mode Mahasiswa (Hanya Lihat)
                </div>
            @endif

            @if(!$hasProfile)
            <form action="{{ route('profil.reset') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-md transition flex items-center space-x-1.5">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span>Pulihkan Profil SI2A</span>
                </button>
            </form>
            @endif
        </div>
    </div>

    @if(!$hasProfile)
        <!-- EMPTY STATE: Profil kelas belum tersedia -->
        <div class="p-12 rounded-3xl bg-white border border-slate-200 text-center shadow-sm max-w-lg mx-auto my-8">
            <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fa-solid fa-id-card-clip"></i>
            </div>
            <h2 class="text-xl font-black text-slate-800">Profil kelas belum tersedia</h2>
            <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                Data profil kelas belum diisi atau telah dihapus. Silakan tambahkan data profil atau pulihkan ke data default SI2A.
            </p>
            <div class="mt-6 flex justify-center gap-3">
                @if($isAdmin)
                <button type="button" onclick="openModal('modal-edit-profil')" class="px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow">
                    + Tambah Profil Kelas
                </button>
                @endif
                <form action="{{ route('profil.reset') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow">
                        Muat Profil SI2A
                    </button>
                </form>
            </div>
        </div>
    @else
        <!-- BENTO GRID PROFIL KELAS -->
        <div class="space-y-6">
            
            <!-- Hero Top Header Banner -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-950 via-slate-900 to-indigo-950 text-white p-7 sm:p-9 border border-slate-800 shadow-xl">
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="max-w-xl">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 mb-3">
                            Tahun Angkatan {{ $profile['angkatan'] }}
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                            {{ $profile['nama_kelas'] }}
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-300 mt-1 font-medium">
                            {{ $profile['prodi'] }} • {{ $profile['jurusan'] }}
                        </p>
                    </div>

                    <div class="bg-white/5 border border-white/10 backdrop-blur-md p-4 sm:p-5 rounded-2xl min-w-[200px]">
                        <span class="text-[10px] font-black uppercase text-slate-400 block tracking-widest">Institusi</span>
                        <span class="text-sm font-bold text-white block mt-0.5">{{ $profile['institusi'] }}</span>
                        <span class="text-xs text-brand-400 font-semibold block mt-1">Status: Terakreditasi</span>
                    </div>
                </div>
            </div>

            <!-- Bento Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs glow-card">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-base mb-3">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <span class="text-[10px] font-black uppercase text-slate-400 tracking-wider block">Program Studi</span>
                    <h3 class="text-base font-black text-slate-900 mt-1">{{ $profile['prodi'] }}</h3>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $profile['jurusan'] }}</p>
                </div>

                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs glow-card">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-base mb-3">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <span class="text-[10px] font-black uppercase text-slate-400 tracking-wider block">Dosen Pembimbing / Wali</span>
                    <h3 class="text-base font-black text-slate-900 mt-1 leading-snug">{{ $profile['dosen_wali'] }}</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Dosen Pengampu Mata Kuliah</p>
                </div>

                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs glow-card">
                    <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-base mb-3">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    <span class="text-[10px] font-black uppercase text-slate-400 tracking-wider block">Mata Kuliah & Tim</span>
                    <h3 class="text-base font-black text-slate-900 mt-1">{{ $profile['mata_kuliah'] ?? 'Pemrograman Website' }}</h3>
                    <p class="text-xs text-cyan-700 font-bold mt-0.5">{{ $profile['kelompok'] ?? 'Kelompok 4' }}</p>
                </div>

            </div>

            <!-- Deskripsi Kelas Card -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
                <div class="flex items-center space-x-2.5 pb-4 border-b border-slate-100 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-align-left"></i>
                    </div>
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider">Deskripsi & Profil Kelas</h3>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-normal">
                    {{ $profile['deskripsi'] }}
                </p>
            </div>

        </div>
    @endif

</div>

<!-- MODAL KELOLA PROFIL (Admin) -->
<div id="modal-edit-profil" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl relative max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-black text-slate-900">Kelola Data Profil Kelas</h3>
            <button onclick="closeModal('modal-edit-profil')" class="text-slate-400 hover:text-slate-600 text-lg">&times;</button>
        </div>

        <form action="{{ route('profil.save') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Kelas</label>
                <input type="text" name="nama_kelas" value="{{ old('nama_kelas', $profile['nama_kelas'] ?? 'Sistem Informasi 2A') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500 font-bold">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Program Studi</label>
                <input type="text" name="prodi" value="{{ old('prodi', $profile['prodi'] ?? 'D-III Sistem Informasi') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Jurusan</label>
                <input type="text" name="jurusan" value="{{ old('jurusan', $profile['jurusan'] ?? 'Jurusan Teknologi Informasi dan Komputer') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Institusi / Kampus</label>
                <input type="text" name="institusi" value="{{ old('institusi', $profile['institusi'] ?? 'Politeknik Negeri Subang') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Angkatan</label>
                    <input type="text" name="angkatan" value="{{ old('angkatan', $profile['angkatan'] ?? '2026') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500 font-mono">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Mata Kuliah</label>
                    <input type="text" name="mata_kuliah" value="{{ old('mata_kuliah', $profile['mata_kuliah'] ?? 'Pemrograman Website [PSI3310]') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Dosen Pengampu / Wali</label>
                <input type="text" name="dosen_wali" value="{{ old('dosen_wali', $profile['dosen_wali'] ?? 'Rahmat Irsyada, M.Pd. & Usep Abdul Rosid, M.Kom.') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Profil Kelas</label>
                <textarea name="deskripsi" rows="3" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">{{ old('deskripsi', $profile['deskripsi'] ?? '') }}</textarea>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end space-x-2">
                <button type="button" onclick="closeModal('modal-edit-profil')" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 text-white shadow-md shadow-brand-500/20">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL KONFIRMASI HAPUS PROFIL -->
<div id="modal-delete-profil" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-sm w-full p-6 shadow-2xl text-center">
        <div class="w-14 h-14 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center text-xl mx-auto mb-3">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <h3 class="text-base font-black text-slate-900">Konfirmasi Hapus Profil Kelas?</h3>
        <p class="text-xs text-slate-500 mt-2">
            Apakah Anda yakin ingin menghapus data profil kelas? Anda tetap bisa memulihkan data default kapan saja.
        </p>
        <div class="mt-6 flex justify-center space-x-2">
            <button type="button" onclick="closeModal('modal-delete-profil')" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100">
                Batal
            </button>
            <form action="{{ route('profil.destroy') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-rose-600 hover:bg-rose-700 text-white shadow">
                    Ya, Hapus Data
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>
@endsection
