<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test all routes in the system return successful response.
     */
    public function test_all_system_routes_return_successful_response()
    {
        // 1. Login Page (Diagram 2)
        $response = $this->get('/login');
        $response->assertStatus(200);

        // 2. Dashboard Page (Diagram 3)
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/dashboard');
        $response->assertStatus(200);

        // 3. Profil Kelas Page (Diagram 4 & 8)
        $response = $this->get('/profil');
        $response->assertStatus(200);

        // 4. Daftar Mahasiswa Page (Diagram 5 & 9)
        $response = $this->get('/mahasiswa');
        $response->assertStatus(200);

        // 5. Detail Mahasiswa (Diagram 6)
        $response = $this->get('/mahasiswa/detail/1');
        $response->assertStatus(200);

        // 6. Struktur Kelas Page (Diagram 7 & 10)
        $response = $this->get('/struktur-kelas');
        $response->assertStatus(200);

        // 7. Generate Laporan Page (Diagram 11 & 12)
        $response = $this->get('/laporan');
        $response->assertStatus(200);

        // 8. Export Excel
        $response = $this->get('/laporan/export-excel?jenis=mahasiswa&jabatan=semua');
        $response->assertStatus(200);
    }
}
