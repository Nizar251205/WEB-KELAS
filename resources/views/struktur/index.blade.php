@extends('layouts.app')

@section('title', 'Struktur Organisasi - Sistem Informasi 2A')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
        <div>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-brand-50 text-brand-700 border border-brand-200">
                    Bagan Organisasi
                </span>
                <span class="text-xs text-slate-400">Sistem Informasi 2A</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1.5 tracking-tight">
                Struktur Kepengurusan Kelas
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                Bagan kepemimpinan mahasiswa Program Studi D-III Sistem Informasi POLSUB
            </p>
        </div>

        @if($isAdmin)
        <div class="flex items-center space-x-2">
            <button type="button" onclick="openModal('modal-atur-jabatan')" class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 text-white text-xs font-extrabold shadow-lg shadow-brand-500/25 transition-all flex items-center space-x-2">
                <i class="fa-solid fa-sliders"></i>
                <span>Atur Jabatan Pengurus</span>
            </button>
        </div>
        @else
        <div class="text-xs text-slate-500 bg-white px-3.5 py-2 rounded-xl border border-slate-200 flex items-center space-x-2 shadow-xs">
            <i class="fa-solid fa-lock text-slate-400"></i>
            <span>Mode Mahasiswa (Hanya Lihat)</span>
        </div>
        @endif
    </div>

    <!-- Alert Status Jabatan Kosong -->
    @if(!$isComplete)
    <div class="p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 text-xs sm:text-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-10 shadow-xs">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-circle-exclamation"></i>
            </div>
            <div>
                <span class="font-bold block">Beberapa posisi jabatan saat ini belum ditentukan.</span>
                <span class="text-amber-700 text-xs">Posisi yang kosong ditandai dengan kartu bergaris putus-putus berwarna kuning di bawah.</span>
            </div>
        </div>
        @if($isAdmin)
        <button type="button" onclick="openModal('modal-atur-jabatan')" class="px-3.5 py-1.5 rounded-xl bg-amber-700 hover:bg-amber-800 text-white text-xs font-bold transition shadow-xs flex-shrink-0">
            Tetapkan Sekarang &rarr;
        </button>
        @endif
    </div>
    @endif

    <!-- BAGAN ORGANISASI HIERARKIS VISUAL -->
    <div class="flex flex-col items-center">

        <!-- LEVEL 1: DOSEN WALI -->
        <div class="flex flex-col items-center mb-4">
            <span class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">
                Pembimbing / Dosen Wali
            </span>
            <div class="bg-white rounded-3xl border-2 border-brand-500 p-5 sm:p-6 shadow-xl max-w-md w-full text-center relative group glow-card">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-brand-600 to-indigo-600 text-white flex items-center justify-center text-2xl mx-auto mb-3 shadow-md shadow-brand-500/30">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <span class="px-3 py-0.5 rounded-full text-[11px] font-extrabold uppercase bg-brand-50 text-brand-700 border border-brand-200">
                    Dosen Wali
                </span>
                <h3 class="text-base sm:text-lg font-black text-slate-900 mt-2">
                    {{ $structure['Dosen Wali'] ?? 'Rahmat Irsyada, M.Pd. & Usep Abdul Rosid, M.Kom.' }}
                </h3>
                <p class="text-xs text-slate-500 mt-1">D-III Sistem Informasi • Politeknik Negeri Subang</p>
            </div>
            <!-- Garis Penghubung Vertikal -->
            <div class="w-0.5 h-10 bg-gradient-to-b from-brand-500 to-slate-300"></div>
        </div>

        <!-- LEVEL 2: KETUA & WAKIL KETUA -->
        <div class="w-full max-w-4xl mb-4">
            <div class="text-center mb-3">
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Pimpinan Inti Kelas</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Ketua Kelas -->
                <div class="bg-white rounded-3xl border {{ !empty($structure['Ketua Kelas']) ? 'border-amber-300 shadow-lg glow-card' : 'border-2 border-dashed border-slate-300 bg-slate-50/50' }} p-6 text-center relative overflow-hidden">
                    @if(!empty($structure['Ketua Kelas']))
                        <div class="absolute top-0 right-0 w-24 h-24 bg-amber-500/10 rounded-bl-full pointer-events-none"></div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase bg-amber-100 text-amber-800 border border-amber-200 mb-3">
                            <i class="fa-solid fa-crown mr-1.5 text-amber-600"></i> Ketua Kelas
                        </span>
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-amber-500 to-orange-400 text-white flex items-center justify-center text-xl font-black mx-auto mb-3 shadow-md shadow-amber-500/20">
                            {{ substr($structure['Ketua Kelas']['nama'], 0, 1) }}
                        </div>
                        <h4 class="text-lg font-black text-slate-900">{{ $structure['Ketua Kelas']['nama'] }}</h4>
                        <p class="text-xs text-slate-500 font-mono mt-0.5">NIM: {{ $structure['Ketua Kelas']['nim'] }}</p>
                        <div class="mt-3 pt-3 border-t border-slate-100 text-xs text-brand-600 font-semibold truncate">
                            <i class="fa-regular fa-envelope mr-1"></i> {{ $structure['Ketua Kelas']['email'] }}
                        </div>
                    @else
                        <!-- Posisi Kosong: Belum ditentukan -->
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase bg-amber-100 text-amber-800 border border-amber-200 mb-3">
                            <i class="fa-solid fa-crown mr-1.5 text-amber-600"></i> Ketua Kelas
                        </span>
                        <div class="py-6">
                            <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-lg mx-auto mb-2">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                            <h4 class="text-sm font-bold text-amber-800 italic">Belum ditentukan</h4>
                            <p class="text-xs text-amber-600 mt-0.5">Dapat ditetapkan oleh admin</p>
                            @if($isAdmin)
                            <button type="button" onclick="openAturPosisi('Ketua Kelas')" class="mt-3 px-3 py-1.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold transition shadow-xs">
                                + Tetapkan Pengurus
                            </button>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Wakil Ketua Kelas -->
                <div class="bg-white rounded-3xl border {{ !empty($structure['Wakil Ketua Kelas']) ? 'border-blue-300 shadow-lg glow-card' : 'border-2 border-dashed border-amber-300 bg-amber-50/20' }} p-6 text-center relative overflow-hidden">
                    @if(!empty($structure['Wakil Ketua Kelas']))
                        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/10 rounded-bl-full pointer-events-none"></div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase bg-blue-100 text-blue-800 border border-blue-200 mb-3">
                            <i class="fa-solid fa-star mr-1.5 text-blue-600"></i> Wakil Ketua Kelas
                        </span>
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-blue-600 to-cyan-500 text-white flex items-center justify-center text-xl font-black mx-auto mb-3 shadow-md shadow-blue-500/20">
                            {{ substr($structure['Wakil Ketua Kelas']['nama'], 0, 1) }}
                        </div>
                        <h4 class="text-lg font-black text-slate-900">{{ $structure['Wakil Ketua Kelas']['nama'] }}</h4>
                        <p class="text-xs text-slate-500 font-mono mt-0.5">NIM: {{ $structure['Wakil Ketua Kelas']['nim'] }}</p>
                        <div class="mt-3 pt-3 border-t border-slate-100 text-xs text-brand-600 font-semibold truncate">
                            <i class="fa-regular fa-envelope mr-1"></i> {{ $structure['Wakil Ketua Kelas']['email'] }}
                        </div>
                    @else
                        <!-- Posisi Kosong: Belum ditentukan -->
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase bg-amber-100 text-amber-800 border border-amber-200 mb-3">
                            <i class="fa-solid fa-star mr-1.5 text-amber-600"></i> Wakil Ketua Kelas
                        </span>
                        <div class="py-6">
                            <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-lg mx-auto mb-2">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                            <h4 class="text-sm font-bold text-amber-800 italic">Belum ditentukan</h4>
                            <p class="text-xs text-amber-600 mt-0.5">Dapat ditetapkan oleh admin</p>
                            @if($isAdmin)
                            <button type="button" onclick="openAturPosisi('Wakil Ketua Kelas')" class="mt-3 px-3 py-1.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold transition shadow-xs">
                                + Tetapkan Pengurus
                            </button>
                            @endif
                        </div>
                    @endif
                </div>

            </div>

            <!-- Garis Penghubung Vertikal -->
            <div class="w-0.5 h-10 bg-slate-300 mx-auto mt-6"></div>
        </div>

        <!-- LEVEL 3: SEKRETARIS & BENDAHARA -->
        <div class="w-full max-w-4xl mb-6">
            <div class="text-center mb-3">
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Administrasi & Keuangan</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Sekretaris -->
                <div class="bg-white rounded-3xl border {{ !empty($structure['Sekretaris']) ? 'border-indigo-300 shadow-lg glow-card' : 'border-2 border-dashed border-amber-300 bg-amber-50/20' }} p-6 text-center">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase {{ !empty($structure['Sekretaris']) ? 'bg-indigo-100 text-indigo-800' : 'bg-amber-100 text-amber-800' }} mb-3">
                        <i class="fa-solid fa-pen-fancy mr-1.5"></i> Sekretaris
                    </span>
                    @if(!empty($structure['Sekretaris']))
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-indigo-600 to-purple-500 text-white flex items-center justify-center text-lg font-black mx-auto mb-2 shadow-sm">
                            {{ substr($structure['Sekretaris']['nama'], 0, 1) }}
                        </div>
                        <h4 class="text-base font-black text-slate-900">{{ $structure['Sekretaris']['nama'] }}</h4>
                        <p class="text-xs text-slate-500 font-mono">NIM: {{ $structure['Sekretaris']['nim'] }}</p>
                    @else
                        <!-- Belum ditentukan -->
                        <div class="py-5">
                            <h4 class="text-sm font-bold text-amber-800 italic">Belum ditentukan</h4>
                            <p class="text-xs text-amber-600 mt-0.5">Posisi sekretaris kelas masih kosong</p>
                            @if($isAdmin)
                            <button type="button" onclick="openAturPosisi('Sekretaris')" class="mt-3 px-3 py-1.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold transition shadow-xs">
                                + Tetapkan Pengurus
                            </button>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Bendahara -->
                <div class="bg-white rounded-3xl border {{ !empty($structure['Bendahara']) ? 'border-emerald-300 shadow-lg glow-card' : 'border-2 border-dashed border-amber-300 bg-amber-50/20' }} p-6 text-center">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase {{ !empty($structure['Bendahara']) ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }} mb-3">
                        <i class="fa-solid fa-wallet mr-1.5"></i> Bendahara
                    </span>
                    @if(!empty($structure['Bendahara']))
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center text-lg font-black mx-auto mb-2 shadow-sm">
                            {{ substr($structure['Bendahara']['nama'], 0, 1) }}
                        </div>
                        <h4 class="text-base font-black text-slate-900">{{ $structure['Bendahara']['nama'] }}</h4>
                        <p class="text-xs text-slate-500 font-mono">NIM: {{ $structure['Bendahara']['nim'] }}</p>
                    @else
                        <!-- Belum ditentukan -->
                        <div class="py-5">
                            <h4 class="text-sm font-bold text-amber-800 italic">Belum ditentukan</h4>
                            <p class="text-xs text-amber-600 mt-0.5">Posisi bendahara kelas masih kosong</p>
                            @if($isAdmin)
                            <button type="button" onclick="openAturPosisi('Bendahara')" class="mt-3 px-3 py-1.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold transition shadow-xs">
                                + Tetapkan Pengurus
                            </button>
                            @endif
                        </div>
                    @endif
                </div>

            </div>

            <!-- Garis Penghubung Vertikal -->
            <div class="w-0.5 h-10 bg-slate-300 mx-auto mt-6"></div>
        </div>

        <!-- LEVEL 4: ANGGOTA KELAS -->
        <div class="w-full max-w-4xl">
            <div class="text-center mb-4">
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Seluruh Anggota Mahasiswa</span>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-7">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                    @forelse($structure['Anggota'] as $ang)
                    <div class="p-3.5 rounded-2xl bg-slate-50/80 hover:bg-slate-100/80 border border-slate-200/70 transition flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-brand-50 text-brand-700 flex items-center justify-center font-black text-xs flex-shrink-0 border border-brand-100">
                            {{ substr($ang['nama'], 0, 1) }}
                        </div>
                        <div class="min-w-0 flex-grow">
                            <span class="font-bold text-slate-900 text-xs block truncate">{{ $ang['nama'] }}</span>
                            <span class="text-[10px] text-slate-400 font-mono block">{{ $ang['nim'] }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center text-xs text-slate-400 py-6 italic">
                        Belum ada mahasiswa yang tercatat sebagai anggota biasa.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

</div>

<!-- MODAL ATUR JABATAN PENGURUS (Admin) -->
<div id="modal-atur-jabatan" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl relative">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <div>
                <h3 class="text-lg font-black text-slate-900">Atur Jabatan Pengurus</h3>
                <p class="text-xs text-slate-400">Validasi kepemilikan jabatan organisasi kelas</p>
            </div>
            <button onclick="closeModal('modal-atur-jabatan')" class="text-slate-400 hover:text-slate-600 text-lg">&times;</button>
        </div>

        <form action="{{ route('struktur.atur') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Pilih Mahasiswa</label>
                <select name="mahasiswa_id" id="modal-select-mahasiswa" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500 font-medium">
                    <option value="" disabled selected>-- Pilih Mahasiswa --</option>
                    @forelse($allStudents as $std)
                        <option value="{{ $std['id'] }}">
                            {{ $std['nim'] }} - {{ $std['nama'] }} (Saat ini: {{ $std['jabatan'] }})
                        </option>
                    @empty
                        <option value="" disabled>-- Belum ada mahasiswa terdaftar --</option>
                    @endforelse
                </select>
                @if(empty($allStudents))
                <p class="text-[11px] text-amber-600 mt-1">
                    <i class="fa-solid fa-triangle-exclamation mr-1"></i> Data mahasiswa masih kosong. Silakan tambahkan data di menu <strong>Mahasiswa</strong> terlebih dahulu.
                </p>
                @endif
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Pilih Jabatan Baru</label>
                <select name="jabatan" id="modal-select-jabatan" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500 font-medium">
                    <option value="" disabled selected>-- Pilih Jabatan --</option>
                    <option value="Ketua Kelas">Ketua Kelas</option>
                    <option value="Wakil Ketua Kelas">Wakil Ketua Kelas</option>
                    <option value="Sekretaris">Sekretaris</option>
                    <option value="Bendahara">Bendahara</option>
                    <option value="Anggota">Anggota (Kembalikan ke Anggota)</option>
                </select>
                <p class="text-[11px] text-slate-400 mt-1.5 leading-relaxed">
                    *Catatan: Jabatan tunggal (Ketua, Wakil, Sekretaris, Bendahara) hanya dapat dipegang oleh 1 mahasiswa. Jika sudah diisi, sistem akan menolak dengan pesan validasi.
                </p>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end space-x-2">
                <button type="button" onclick="closeModal('modal-atur-jabatan')" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 text-white shadow-md shadow-brand-500/20">Simpan Jabatan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
    function openAturPosisi(posisi) {
        document.getElementById('modal-select-jabatan').value = posisi;
        openModal('modal-atur-jabatan');
    }
</script>
@endsection
