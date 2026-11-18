@extends('layouts.app')

@section('title', 'Data Mahasiswa - Sistem Informasi 2A')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-brand-50 text-brand-700 border border-brand-200">
                    Database Mahasiswa
                </span>
                <span class="text-xs text-slate-400">Sistem Informasi 2A</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1.5 tracking-tight">
                Data Mahasiswa Kelas
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                Daftar direktori akademik mahasiswa aktif Kelas SI2A Politeknik Negeri Subang
            </p>
        </div>

        @if($isAdmin)
        <div>
            <button type="button" onclick="openModal('modal-add-mhs')" class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 text-white text-xs font-extrabold shadow-lg shadow-brand-500/25 transition-all flex items-center space-x-2">
                <i class="fa-solid fa-user-plus"></i>
                <span>Tambah Mahasiswa</span>
            </button>
        </div>
        @endif
    </div>

    <!-- Quick Stats Bar -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-base">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <span class="text-[10px] font-black uppercase text-slate-400 block">Total Siswa</span>
                <span class="text-lg font-black text-slate-900">{{ count($students) }}</span>
            </div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-base">
                <i class="fa-solid fa-crown"></i>
            </div>
            <div>
                <span class="text-[10px] font-black uppercase text-slate-400 block">Pengurus</span>
                <span class="text-lg font-black text-indigo-700">
                    {{ count(array_filter($students, fn($s) => $s['jabatan'] !== 'Anggota')) }}
                </span>
            </div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center font-bold text-base">
                <i class="fa-solid fa-mars"></i>
            </div>
            <div>
                <span class="text-[10px] font-black uppercase text-slate-400 block">Laki-laki</span>
                <span class="text-lg font-black text-cyan-700">
                    {{ count(array_filter($students, fn($s) => ($s['gender'] ?? 'Laki-laki') === 'Laki-laki')) }}
                </span>
            </div>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-base">
                <i class="fa-solid fa-venus"></i>
            </div>
            <div>
                <span class="text-[10px] font-black uppercase text-slate-400 block">Perempuan</span>
                <span class="text-lg font-black text-rose-700">
                    {{ count(array_filter($students, fn($s) => ($s['gender'] ?? '') === 'Perempuan')) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Search Form -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-4 sm:p-5 mb-6">
        <form action="{{ route('mahasiswa.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
            <div class="relative flex-grow w-full">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" 
                       name="search" 
                       value="{{ $search }}" 
                       placeholder="Cari berdasarkan NIM, Nama Mahasiswa, atau Jabatan..." 
                       class="w-full pl-10 pr-4 py-2.5 rounded-2xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500 text-sm font-medium">
            </div>

            <div class="flex items-center space-x-2 w-full sm:w-auto">
                <button type="submit" class="w-full sm:w-auto px-5 py-2.5 rounded-2xl bg-slate-900 hover:bg-slate-800 text-white font-extrabold text-xs transition shadow-sm">
                    <i class="fa-solid fa-filter mr-1"></i> Cari Data
                </button>
                @if($search)
                <a href="{{ route('mahasiswa.index') }}" class="px-4 py-2.5 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs transition">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Notifikasi jika tidak ditemukan -->
    @if($notFound)
    <div class="p-8 rounded-3xl bg-amber-50 border border-amber-200 text-center mb-6 shadow-xs">
        <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-xl mx-auto mb-3">
            <i class="fa-solid fa-user-xmark"></i>
        </div>
        <h3 class="text-base font-black text-amber-900">Data mahasiswa tidak ditemukan</h3>
        <p class="text-xs text-amber-700 mt-1 max-w-sm mx-auto">
            Tidak ada data mahasiswa yang cocok dengan kata kunci pencarian "<strong>{{ $search }}</strong>".
        </p>
        <div class="mt-4">
            <a href="{{ route('mahasiswa.index') }}" class="px-4 py-2 bg-amber-700 hover:bg-amber-800 text-white rounded-xl text-xs font-bold inline-block shadow-sm transition">
                Tampilkan Semua Mahasiswa
            </a>
        </div>
    </div>
    @endif

    <!-- Tabel Data Mahasiswa -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200/80 bg-slate-50/80 text-slate-500 text-[11px] font-black uppercase tracking-wider">
                        <th class="py-4 px-6">Mahasiswa</th>
                        <th class="py-4 px-6">NIM</th>
                        <th class="py-4 px-6">Kelas</th>
                        <th class="py-4 px-6">Jabatan</th>
                        <th class="py-4 px-6">Gender</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs sm:text-sm">
                    @forelse($students as $mhs)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-brand-50 to-indigo-50 border border-brand-100 text-brand-700 font-black text-xs flex items-center justify-center shadow-2xs">
                                    {{ substr($mhs['nama'], 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-900 leading-snug">{{ $mhs['nama'] }}</h4>
                                    <span class="text-[11px] text-slate-400">{{ $mhs['email'] }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 font-mono font-bold text-slate-700 whitespace-nowrap">
                            {{ $mhs['nim'] }}
                        </td>
                        <td class="py-4 px-6 text-slate-600">
                            <span class="px-2 py-0.5 rounded-lg text-xs bg-slate-100 font-semibold text-slate-700">
                                {{ $mhs['kelas'] }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-black
                                {{ $mhs['jabatan'] === 'Ketua Kelas' ? 'bg-amber-100 text-amber-800 border border-amber-200' : '' }}
                                {{ $mhs['jabatan'] === 'Wakil Ketua Kelas' ? 'bg-blue-100 text-blue-800 border border-blue-200' : '' }}
                                {{ in_array($mhs['jabatan'], ['Sekretaris', 'Bendahara']) ? 'bg-indigo-100 text-indigo-800 border border-indigo-200' : '' }}
                                {{ $mhs['jabatan'] === 'Anggota' ? 'bg-slate-100 text-slate-600' : '' }}
                            ">
                                {{ $mhs['jabatan'] }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-500 whitespace-nowrap">
                            {{ $mhs['gender'] ?? 'Laki-laki' }}
                        </td>
                        <td class="py-4 px-6 text-center whitespace-nowrap">
                            <div class="inline-flex items-center space-x-1.5">
                                <a href="{{ route('mahasiswa.show', $mhs['id']) }}" class="px-3 py-1.5 rounded-xl bg-brand-50 hover:bg-brand-100 text-brand-700 text-xs font-bold transition flex items-center space-x-1" title="Lihat Detail">
                                    <i class="fa-solid fa-eye text-[11px]"></i>
                                    <span>Detail</span>
                                </a>

                                @if($isAdmin)
                                <button type="button" onclick="editMahasiswa({{ json_encode($mhs) }})" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition" title="Edit Data">
                                    <i class="fa-solid fa-pen text-[11px]"></i>
                                </button>
                                
                                <form action="{{ route('mahasiswa.destroy', $mhs['id']) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa {{ $mhs['nama'] }}?');">
                                    @csrf
                                    <button type="submit" class="p-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold transition" title="Hapus Data">
                                        <i class="fa-solid fa-trash-can text-[11px]"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-400 text-sm">
                            <i class="fa-solid fa-folder-open text-3xl block mb-2 opacity-40"></i>
                            Belum ada data mahasiswa yang terdaftar di sistem.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100 bg-slate-50/50 text-xs text-slate-500 flex justify-between items-center">
            <span>Total: <strong>{{ count($students) }}</strong> data mahasiswa</span>
            <span class="font-mono text-[11px] text-slate-400">SI2A POLSUB • No-DB Store</span>
        </div>
    </div>

</div>

<!-- MODAL TAMBAH MAHASISWA (Admin) -->
<div id="modal-add-mhs" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl relative max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-black text-slate-900">Tambah Mahasiswa Baru</h3>
            <button onclick="closeModal('modal-add-mhs')" class="text-slate-400 hover:text-slate-600 text-lg">&times;</button>
        </div>

        <form action="{{ route('mahasiswa.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">NIM</label>
                    <input type="text" name="nim" required placeholder="Contoh: 10112050" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Jenis Kelamin</label>
                    <select name="gender" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Mahasiswa</label>
                <input type="text" name="nama" required placeholder="Nama lengkap..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Jabatan Awal</label>
                    <select name="jabatan" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
                        <option value="Anggota" selected>Anggota</option>
                        <option value="Ketua Kelas">Ketua Kelas</option>
                        <option value="Wakil Ketua Kelas">Wakil Ketua Kelas</option>
                        <option value="Sekretaris">Sekretaris</option>
                        <option value="Bendahara">Bendahara</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">No HP / WhatsApp</label>
                    <input type="text" name="no_hp" required placeholder="0812-xxxx-xxxx" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Email Mahasiswa</label>
                <input type="email" name="email" required placeholder="nama@mhs.polsub.ac.id" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end space-x-2">
                <button type="button" onclick="closeModal('modal-add-mhs')" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 text-white shadow-md shadow-brand-500/20">Simpan Mahasiswa</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT MAHASISWA (Admin) -->
<div id="modal-edit-mhs" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl relative max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-black text-slate-900">Edit Data Mahasiswa</h3>
            <button onclick="closeModal('modal-edit-mhs')" class="text-slate-400 hover:text-slate-600 text-lg">&times;</button>
        </div>

        <form id="form-edit-mhs" action="" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">NIM</label>
                    <input type="text" id="edit-nim" name="nim" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500 font-mono">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Jenis Kelamin</label>
                    <select id="edit-gender" name="gender" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Mahasiswa</label>
                <input type="text" id="edit-nama" name="nama" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500 font-bold">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Jabatan</label>
                    <select id="edit-jabatan" name="jabatan" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
                        <option value="Anggota">Anggota</option>
                        <option value="Ketua Kelas">Ketua Kelas</option>
                        <option value="Wakil Ketua Kelas">Wakil Ketua Kelas</option>
                        <option value="Sekretaris">Sekretaris</option>
                        <option value="Bendahara">Bendahara</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">No HP / WhatsApp</label>
                    <input type="text" id="edit-nohp" name="no_hp" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Email Mahasiswa</label>
                <input type="email" id="edit-email" name="email" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end space-x-2">
                <button type="button" onclick="closeModal('modal-edit-mhs')" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 text-white shadow-md shadow-brand-500/20">Simpan Perubahan</button>
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
    function editMahasiswa(data) {
        document.getElementById('form-edit-mhs').action = '/mahasiswa/update/' + data.id;
        document.getElementById('edit-nim').value = data.nim;
        document.getElementById('edit-nama').value = data.nama;
        document.getElementById('edit-jabatan').value = data.jabatan;
        document.getElementById('edit-nohp').value = data.no_hp;
        document.getElementById('edit-email').value = data.email;
        document.getElementById('edit-gender').value = data.gender || 'Laki-laki';
        openModal('modal-edit-mhs');
    }
</script>
@endsection
