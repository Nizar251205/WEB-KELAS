<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClassDataService;

class StrukturKelasController extends Controller
{
    /**
     * Tampilkan Bagan Struktur Kelas
     */
    public function index()
    {
        $structure = ClassDataService::getStructure();
        $allStudents = ClassDataService::getStudents();
        $profile = ClassDataService::getProfile();

        // Cek kelengkapan jabatan
        $isComplete = !empty($structure['Ketua Kelas']) &&
                      !empty($structure['Wakil Ketua Kelas']) &&
                      !empty($structure['Sekretaris']) &&
                      !empty($structure['Bendahara']);

        return view('struktur.index', [
            'structure' => $structure,
            'isComplete' => $isComplete,
            'allStudents' => $allStudents,
            'profile' => $profile,
            'isAdmin' => session('auth_user.role') === 'admin'
        ]);
    }

    /**
     * Atur Jabatan Pengurus oleh Admin
     */
    public function aturJabatan(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|integer',
            'jabatan' => 'required|string'
        ], [
            'mahasiswa_id.required' => 'Silakan pilih mahasiswa.',
            'jabatan.required' => 'Silakan pilih jabatan baru.'
        ]);

        $studentId = (int)$request->input('mahasiswa_id');
        $newRole = $request->input('jabatan');

        $result = ClassDataService::assignRole($studentId, $newRole);

        if (!$result['success']) {
            return redirect()->route('struktur.index')->with('error', $result['message']);
        }

        return redirect()->route('struktur.index')->with('success', $result['message']);
    }
}
