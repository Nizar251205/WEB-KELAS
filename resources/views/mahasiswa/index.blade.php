@extends('layouts.app')

@section('title', 'Daftar Mahasiswa SI2A')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center space-x-2">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-brand-100 text-brand-800">
                    Daftar Mahasiswa
                </span>
                <span class="text-xs text-slate-400">Sistem Informasi SI2A</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">
                Data Mahasiswa Kelas SI2A
            </h1>
        </div>

        @if($isAdmin)
        <div>
            <button type="button" onclick="openModal('modal-add-mhs')" class="px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow-md shadow-brand-500/20 transition flex items-center space-x-1.5">
                <i class="fa-solid fa-user-plus"></i>
                <span>Tambah Mahasiswa</span>
            </button>
        </div>
        @endif
    </div>

    <!-- Search Form (Activity Diagram Page 5: "Ingin mencari mahasiswa?") -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5 mb-6">
        <form action="{{ route('mahasiswa.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3">
            <div class="relative flex-grow w-full">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" 
                       name="search" 
                       value="{{ $search }}" 
                       placeholder="Cari berdasarkan NIM, Nama Mahasiswa, atau Jabatan..." 
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500 text-sm">
            </div>

            <div class="flex items-center space-x-2 w-full sm:w-auto">
                <button type="submit" class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition">
                    Cari Data
                </button>
                @if($search)
                <a href="{{ route('mahasiswa.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold text-xs transition">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Activity Diagram Page 5: Apakah data ditemukan? Tidak -> Tampilkan pesan "Data mahasiswa tidak ditemukan" -->
    @if($notFound)
    <div class="p-6 rounded-2xl bg-amber-50 border border-amber-200 text-center mb-6">
        <div class="w-12 h-12 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-lg mx-auto mb-2">
            <i class="fa-solid fa-user-xmark"></i>
        </div>
        <h3 class="text-base font-bold text-amber-900">Data mahasiswa tidak ditemukan</h3>
        <p class="text-xs text-amber-700 mt-1">
            Tidak ada data mahasiswa yang cocok dengan kata kunci pencarian "<strong>{{ $search }}</strong>".
        </p>
        <div class="mt-4">
            <a href="{{ route('mahasiswa.index') }}" class="px-4 py-2 bg-amber-700 text-white rounded-xl text-xs font-bold inline-block shadow">
                Tampilkan Semua Mahasiswa
            </a>
        </div>
    </div>
    @endif

    <!-- Tabel Data Mahasiswa (Activity Diagram Page 5: Menampilkan tabel NIM, Nama dan Jabatan) -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/70 text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="py-4 px-6">NIM</th>
                        <th class="py-4 px-6">Nama Mahasiswa</th>
                        <th class="py-4 px-6">Kelas</th>
                        <th class="py-4 px-6">Jabatan</th>
                        <th class="py-4 px-6">Jenis Kelamin</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($students as $mhs)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="py-4 px-6 font-mono font-bold text-brand-700 whitespace-nowrap">
                            {{ $mhs['nim'] }}
                        </td>
                        <td class="py-4 px-6 font-semibold text-slate-800">
                            {{ $mhs['nama'] }}
                        </td>
                        <td class="py-4 px-6 text-slate-600">
                            <span class="px-2 py-0.5 rounded text-xs bg-slate-100 font-medium">
                                {{ $mhs['kelas'] }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold 
                                {{ $mhs['jabatan'] === 'Ketua Kelas' ? 'bg-amber-100 text-amber-800' : '' }}
                                {{ $mhs['jabatan'] === 'Wakil Ketua Kelas' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ in_array($mhs['jabatan'], ['Sekretaris', 'Bendahara']) ? 'bg-indigo-100 text-indigo-800' : '' }}
                                {{ $mhs['jabatan'] === 'Anggota' ? 'bg-slate-100 text-slate-700' : '' }}
                            ">
                                {{ $mhs['jabatan'] }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-xs text-slate-500 whitespace-nowrap">
                            {{ $mhs['gender'] ?? 'Laki-laki' }}
                        </td>
                        <td class="py-4 px-6 text-center whitespace-nowrap">
                            <div class="inline-flex items-center space-x-1.5">
                                <!-- Tombol Lihat Detail (Activity Diagram Page 6) -->
                                <a href="{{ route('mahasiswa.show', $mhs['id']) }}" class="px-2.5 py-1.5 rounded-lg bg-brand-50 hover:bg-brand-100 text-brand-700 text-xs font-bold transition" title="Lihat Detail">
                                    <i class="fa-solid fa-eye mr-1"></i> Detail
                                </a>

                                @if($isAdmin)
                                <!-- Tombol Edit (Activity Diagram Page 9) -->
                                <button type="button" onclick="editMahasiswa({{ json_encode($mhs) }})" class="px-2.5 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition" title="Edit Data">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                
                                <!-- Tombol Hapus (Activity Diagram Page 9) -->
                                <form action="{{ route('mahasiswa.destroy', $mhs['id']) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa {{ $mhs['nama'] }}?');">
                                    @csrf
                                    <button type="submit" class="px-2.5 py-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold transition" title="Hapus Data">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-400 text-sm">
                            <i class="fa-solid fa-folder-open text-3xl block mb-2 opacity-50"></i>
                            Belum ada data mahasiswa yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100 bg-slate-50/50 text-xs text-slate-500 flex justify-between items-center">
            <span>Menampilkan <strong>{{ count($students) }}</strong> data mahasiswa</span>
            <span class="font-mono text-[11px]">Sistem Kelas SI2A • No-DB Store</span>
        </div>
    </div>

</div>

<!-- MODAL TAMBAH MAHASISWA (Admin - Activity Diagram Page 9) -->
<div id="modal-add-mhs" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl relative max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-bold text-slate-900">Tambah Mahasiswa Baru</h3>
            <button onclick="closeModal('modal-add-mhs')" class="text-slate-400 hover:text-slate-600">&times;</button>
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
                    <label class="block text-xs font-bold text-slate-700 mb-1">Jabatan</label>
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
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-brand-600 hover:bg-brand-700 text-white shadow">Simpan Mahasiswa</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT MAHASISWA (Admin - Activity Diagram Page 9) -->
<div id="modal-edit-mhs" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl relative max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <h3 class="text-lg font-bold text-slate-900">Edit Data Mahasiswa</h3>
            <button onclick="closeModal('modal-edit-mhs')" class="text-slate-400 hover:text-slate-600">&times;</button>
        </div>

        <form id="form-edit-mhs" action="" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">NIM</label>
                    <input type="text" id="edit-nim" name="nim" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
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
                <input type="text" id="edit-nama" name="nama" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-brand-500">
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
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-brand-600 hover:bg-brand-700 text-white shadow">Simpan Perubahan</button>
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
