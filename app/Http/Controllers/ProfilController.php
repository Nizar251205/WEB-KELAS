<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClassDataService;

class ProfilController extends Controller
{
    /**
     * Tampilkan Halaman Profil Kelas
     */
    public function index()
    {
        $profile = ClassDataService::getProfile();
        $hasProfile = !empty($profile) && !empty($profile['nama_kelas']);

        return view('profil.index', [
            'profile' => $profile,
            'hasProfile' => $hasProfile,
            'isAdmin' => session('auth_user.role') === 'admin'
        ]);
    }

    /**
     * Tambah / Ubah Profil Kelas (Admin)
     */
    public function save(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'prodi' => 'required|string|max:100',
            'jurusan' => 'required|string|max:100',
            'institusi' => 'required|string|max:150',
            'angkatan' => 'required|string|max:20',
            'dosen_wali' => 'required|string|max:150',
            'deskripsi' => 'required|string'
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'prodi.required' => 'Program studi wajib diisi.',
            'jurusan.required' => 'Jurusan wajib diisi.',
            'institusi.required' => 'Institusi / Kampus wajib diisi.',
            'angkatan.required' => 'Tahun angkatan wajib diisi.',
            'dosen_wali.required' => 'Dosen wali wajib diisi.',
            'deskripsi.required' => 'Deskripsi profil kelas wajib diisi.'
        ]);

        $updatedProfile = ClassDataService::updateProfile([
            'nama_kelas' => $request->input('nama_kelas'),
            'prodi' => $request->input('prodi'),
            'jurusan' => $request->input('jurusan'),
            'institusi' => $request->input('institusi'),
            'angkatan' => $request->input('angkatan'),
            'mata_kuliah' => $request->input('mata_kuliah', 'Pemrograman Website [PSI3310]'),
            'dosen_wali' => $request->input('dosen_wali'),
            'deskripsi' => $request->input('deskripsi'),
            'kelompok' => $request->input('kelompok', 'Kelompok 4')
        ]);

        return redirect()->route('profil.index')->with('success', 'Profil kelas berhasil diperbarui!');
    }

    /**
     * Hapus Data Profil Kelas (Admin)
     */
    public function destroy()
    {
        ClassDataService::deleteProfile();
        return redirect()->route('profil.index')->with('success', 'Data profil kelas berhasil dihapus.');
    }

    /**
     * Pulihkan Data Default Profil Kelas SI2A
     */
    public function reset()
    {
        ClassDataService::resetProfile();
        return redirect()->route('profil.index')->with('success', 'Data profil kelas berhasil dipulihkan ke pengaturan awal (SI2A Politeknik Negeri Subang).');
    }
}
