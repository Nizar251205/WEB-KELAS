<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ClassDataService;

class ClassStructureTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        ClassDataService::saveData([
            'profile' => [
                'nama_kelas' => 'Sistem Informasi 2A',
                'prodi' => 'D-III Sistem Informasi',
                'jurusan' => 'Jurusan Teknologi Informasi dan Komputer',
                'institusi' => 'Politeknik Negeri Subang',
                'angkatan' => '2026',
                'mata_kuliah' => 'Pemrograman Website [PSI3310]',
                'dosen_wali' => 'Rahmat Irsyada, M.Pd. & Usep Abdul Rosid, M.Kom.',
                'deskripsi' => 'Pengujian unit logic struktur kelas SI2A POLSUB',
                'kelompok' => 'Kelompok 4'
            ],
            'mahasiswa' => [
                [
                    'id' => 1,
                    'nim' => '10112001',
                    'nama' => 'Aakip Hasan Mutakin',
                    'kelas' => 'Sistem Informasi 2A',
                    'jabatan' => 'Ketua Kelas',
                    'email' => 'aakip.10112001@mhs.polsub.ac.id',
                    'no_hp' => '0812-3456-7801',
                    'gender' => 'Laki-laki'
                ],
                [
                    'id' => 2,
                    'nim' => '10112016',
                    'nama' => 'Aulia Putri Ramadhina',
                    'kelas' => 'Sistem Informasi 2A',
                    'jabatan' => 'Anggota',
                    'email' => 'aulia.10112016@mhs.polsub.ac.id',
                    'no_hp' => '0812-3456-7802',
                    'gender' => 'Perempuan'
                ]
            ]
        ]);
    }

    protected function tearDown(): void
    {
        // Pastikan setelah pengujian selesai, data sistem dikosongkan kembali
        ClassDataService::clearAllData();
        parent::tearDown();
    }

    public function test_assign_role_conflict_shows_pilih_jabatan_lain()
    {
        // Mahasiswa 2 (Aulia) mencoba mengambil jabatan "Ketua Kelas" yang sedang dipegang Mahasiswa 1 (Aakip)
        $result = ClassDataService::assignRole(2, 'Ketua Kelas');
        $this->assertFalse($result['success']);
        $this->assertStringContainsString('Pilih Jabatan Lain', $result['message']);
    }

    public function test_assign_role_success_when_allowed()
    {
        // Mahasiswa 2 (Aulia) diberi jabatan "Wakil Ketua Kelas" (belum ada yang pegang)
        $result = ClassDataService::assignRole(2, 'Wakil Ketua Kelas');
        $this->assertTrue($result['success']);
    }

    public function test_search_student_returns_matching()
    {
        $found = ClassDataService::getStudents('Aakip');
        $this->assertNotEmpty($found);
        $this->assertEquals('Aakip Hasan Mutakin', $found[0]['nama']);

        $notFound = ClassDataService::getStudents('NonExistentNameXYZ123');
        $this->assertEmpty($notFound);
    }
}
