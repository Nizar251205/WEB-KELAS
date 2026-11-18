@extends('layouts.app')

@section('title', 'Profil Kelas SI2A')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center space-x-2">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-brand-100 text-brand-800">
                    Profil Kelas
                </span>
                <span class="text-xs text-slate-400">Sistem Informasi SI2A</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">
                Informasi & Profil Kelas
            </h1>
        </div>

        <!-- Admin Action Buttons (Activity Diagram Page 8) -->
        <div class="flex flex-wrap items-center gap-2">
            @if($isAdmin)
                <button type="button" onclick="openModal('modal-edit-profil')" class="px-3.5 py-2 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow-sm transition flex items-center space-x-1.5">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Kelola / Ubah Profil</span>
                </button>
                @if($hasProfile)
                <button type="button" onclick="openModal('modal-delete-profil')" class="px-3 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold border border-rose-200 transition flex items-center space-x-1">
                    <i class="fa-solid fa-trash-can"></i>
                    <span>Hapus</span>
                </button>
                @endif
            @else
                <a href="{{ route('login') }}" class="px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition">
                    <i class="fa-solid fa-shield mr-1"></i> Login Admin untuk Mengelola
                </a>
            @endif

            @if(!$hasProfile)
            <form action="{{ route('profil.reset') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow transition">
                    <i class="fa-solid fa-rotate-left mr-1"></i> Pulihkan Profil Default SI2A
                </button>
            </form>
            @endif
        </div>
    </div>

    @if(!$hasProfile)
        <!-- Activity Diagram Page 4: Data profil ada? Tidak -> Tampilkan pesan "Profil kelas belum tersedia" -->
        <div class="p-10 rounded-3xl bg-white border border-slate-200 text-center shadow-sm max-w-xl mx-auto my-8">
            <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fa-solid fa-id-card-clip"></i>
            </div>
            <h2 class="text-xl font-bold text-slate-800">Profil kelas belum tersedia</h2>
            <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                Data profil kelas belum diisi atau baru saja dihapus. Anda dapat menambahkan data profil baru atau memulihkan profil awal kelas SI2A.
            </p>
            <div class="mt-6 flex justify-center gap-3">
                @if($isAdmin)
                <button type="button" onclick="openModal('modal-edit-profil')" class="px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow">
                    <i class="fa-solid fa-plus mr-1"></i> Tambah Profil Kelas
                </button>
                @endif
                <form action="{{ route('profil.reset') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow">
                        <i class="fa-solid fa-rotate-left mr-1"></i> Muat Profil SI2A POLSUB
                    </button>
                </form>
            </div>
        </div>
    @else
        <!-- Activity Diagram Page 4: Data profil ada? Ya -> Tampilkan nama kelas, prodi, angkatan, wali kelas, deskripsi -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden mb-8">
            <!-- Hero Top Header -->
            <div class="p-6 sm:p-8 bg-gradient-to-r from-brand-900 via-indigo-900 to-slate-900 text-white relative">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/15 text-white backdrop-blur-md border border-white/20 inline-block mb-2">
                            Angkatan {{ $profile['angkatan'] }}
                        </span>
                        <h2 class="text-3xl font-black text-white tracking-tight">
                            Kelas {{ $profile['nama_kelas'] }}
                        </h2>
                        <p class="text-sm text-indigo-200 mt-1">
                            {{ $profile['prodi'] }} • {{ $profile['institusi'] }}
                        </p>
                    </div>

                    <div class="text-left sm:text-right bg-white/10 p-4 rounded-2xl border border-white/10 backdrop-blur-sm">
                        <span class="text-xs text-indigo-200 block">Mata Kuliah:</span>
                        <span class="text-sm font-bold text-white block">{{ $profile['mata_kuliah'] ?? 'Pemrograman Website' }}</span>
                        <span class="text-xs text-emerald-300 font-semibold block mt-1">{{ $profile['kelompok'] ?? 'Kelompok 4' }}</span>
                    </div>
                </div>
            </div>

            <!-- Detail Grid Fields -->
            <div class="p-6 sm:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Nama Kelas:</span>
                        <p class="text-lg font-bold text-slate-900">{{ $profile['nama_kelas'] }}</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Program Studi:</span>
                        <p class="text-lg font-bold text-slate-900">{{ $profile['prodi'] }}</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Jurusan:</span>
                        <p class="text-lg font-bold text-slate-900">{{ $profile['jurusan'] }}</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Institusi / Perguruan Tinggi:</span>
                        <p class="text-lg font-bold text-slate-900">{{ $profile['institusi'] }}</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Tahun Angkatan:</span>
                        <p class="text-lg font-bold text-slate-900">{{ $profile['angkatan'] }}</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-brand-50/70 border border-brand-100">
                        <span class="text-xs font-bold uppercase tracking-wider text-brand-600 block mb-1">Dosen Pengampu / Wali:</span>
                        <p class="text-base font-extrabold text-brand-900">{{ $profile['dosen_wali'] }}</p>
                    </div>

                </div>

                <!-- Deskripsi Kelas (Activity Diagram Page 4) -->
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-2">Deskripsi Kelas:</span>
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 text-sm text-slate-700 leading-relaxed">
                        {{ $profile['deskripsi'] }}
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>

<!-- MODAL KELOLA / EDIT PROFIL (Activity Diagram Page 8) -->
<div id="modal-edit-profil" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl relative max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-bold text-slate-900">Kelola Data Profil Kelas</h3>
            <button onclick="closeModal('modal-edit-profil')" class="text-slate-400 hover:text-slate-600">&times;</button>
        </div>

        <form action="{{ route('profil.save') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Kelas</label>
                <input type="text" name="nama_kelas" value="{{ old('nama_kelas', $profile['nama_kelas'] ?? 'SI2A') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
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
                    <input type="text" name="angkatan" value="{{ old('angkatan', $profile['angkatan'] ?? '2026') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
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
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-brand-600 hover:bg-brand-700 text-white shadow">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL KONFIRMASI HAPUS PROFIL (Activity Diagram Page 8: "Menampilkan dialog konfirmasi penghapusan") -->
<div id="modal-delete-profil" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-sm w-full p-6 shadow-2xl text-center">
        <div class="w-14 h-14 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center text-xl mx-auto mb-4">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <h3 class="text-base font-bold text-slate-900">Konfirmasi Hapus Profil Kelas?</h3>
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
