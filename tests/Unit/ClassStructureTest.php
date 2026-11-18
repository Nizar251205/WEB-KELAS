<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ClassDataService;

class ClassStructureTest extends TestCase
{
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
