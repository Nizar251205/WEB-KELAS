<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClassDataService;

class MahasiswaController extends Controller
{
    /**
     * Tampilkan Daftar Mahasiswa & Pencarian
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $students = ClassDataService::getStudents($search);
        $notFound = false;

        // Cek jika pencarian tidak menemukan hasil
        if ($search !== null && $search !== '' && empty($students)) {
            $notFound = true;
        }

        return view('mahasiswa.index', [
            'students' => $students,
            'search' => $search,
            'notFound' => $notFound,
            'isAdmin' => session('auth_user.role') === 'admin'
        ]);
    }

    /**
     * Tampilkan Detail Mahasiswa
     */
    public function show($id)
    {
        $student = ClassDataService::getStudentById($id);

        if (!$student) {
            return redirect()->route('mahasiswa.index')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        return view('mahasiswa.detail', [
            'student' => $student,
            'isAdmin' => session('auth_user.role') === 'admin'
        ]);
    }

    /**
     * Tambah Data Mahasiswa (Admin)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:30',
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'no_hp' => 'required|string|max:20',
            'gender' => 'required|string'
        ], [
            'nim.required' => 'NIM wajib diisi.',
            'nama.required' => 'Nama mahasiswa wajib diisi.',
            'jabatan.required' => 'Jabatan wajib dipilih.',
            'email.required' => 'Email mahasiswa wajib diisi.',
            'no_hp.required' => 'Nomor HP/WhatsApp wajib diisi.',
            'gender.required' => 'Jenis kelamin wajib dipilih.'
        ]);

        $profile = ClassDataService::getProfile();
        $kelas = $profile['nama_kelas'] ?? 'SI2A';

        ClassDataService::addStudent([
            'nim' => $request->input('nim'),
            'nama' => $request->input('nama'),
            'kelas' => $kelas,
            'jabatan' => $request->input('jabatan'),
            'email' => $request->input('email'),
            'no_hp' => $request->input('no_hp'),
            'gender' => $request->input('gender')
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Perbarui Data Mahasiswa (Admin)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|string|max:30',
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'no_hp' => 'required|string|max:20',
            'gender' => 'required|string'
        ]);

        $profile = ClassDataService::getProfile();
        $kelas = $profile['nama_kelas'] ?? 'SI2A';

        $updated = ClassDataService::updateStudent($id, [
            'nim' => $request->input('nim'),
            'nama' => $request->input('nama'),
            'kelas' => $kelas,
            'jabatan' => $request->input('jabatan'),
            'email' => $request->input('email'),
            'no_hp' => $request->input('no_hp'),
            'gender' => $request->input('gender')
        ]);

        if (!$updated) {
            return redirect()->route('mahasiswa.index')->with('error', 'Gagal memperbarui: Data mahasiswa tidak ditemukan.');
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Hapus Data Mahasiswa (Admin)
     */
    public function destroy($id)
    {
        $deleted = ClassDataService::deleteStudent($id);

        if (!$deleted) {
            return redirect()->route('mahasiswa.index')->with('error', 'Gagal menghapus: Data mahasiswa tidak ditemukan.');
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}
