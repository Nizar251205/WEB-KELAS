<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test bahwa tamu (belum login) wajib diarahkan ke halaman login.
     */
    public function test_guest_is_redirected_to_login_page()
    {
        // Akses root / diarahkan ke login
        $response = $this->get('/');
        $response->assertRedirect('/login');

        // Akses dashboard tanpa login diarahkan ke login
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');

        // Akses profil tanpa login diarahkan ke login
        $response = $this->get('/profil');
        $response->assertRedirect('/login');

        // Akses mahasiswa tanpa login diarahkan ke login
        $response = $this->get('/mahasiswa');
        $response->assertRedirect('/login');

        // Akses struktur kelas tanpa login diarahkan ke login
        $response = $this->get('/struktur-kelas');
        $response->assertRedirect('/login');

        // Akses laporan tanpa login diarahkan ke login
        $response = $this->get('/laporan');
        $response->assertRedirect('/login');

        // Halaman login publik dapat diakses dengan sukses
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    /**
     * Test bahwa pengguna yang sudah login dapat mengakses menu sistem.
     */
    public function test_authenticated_user_can_access_system()
    {
        $sessionData = [
            'auth_user' => [
                'name' => 'Administrator SI2A',
                'username' => 'admin',
                'email' => 'admin@polsub.ac.id',
                'role' => 'admin'
            ]
        ];

        // Akses root / diarahkan ke dashboard jika sudah login
        $response = $this->withSession($sessionData)->get('/');
        $response->assertRedirect('/dashboard');

        // Dashboard
        $response = $this->withSession($sessionData)->get('/dashboard');
        $response->assertStatus(200);

        // Profil
        $response = $this->withSession($sessionData)->get('/profil');
        $response->assertStatus(200);

        // Mahasiswa
        $response = $this->withSession($sessionData)->get('/mahasiswa');
        $response->assertStatus(200);

        // Struktur
        $response = $this->withSession($sessionData)->get('/struktur-kelas');
        $response->assertStatus(200);

        // Laporan
        $response = $this->withSession($sessionData)->get('/laporan');
        $response->assertStatus(200);
    }
}
