<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClassDataService;

class AuthController extends Controller
{
    /**
     * Tampilkan Halaman Login
     */
    public function showLogin()
    {
        if (session()->has('auth_user')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    /**
     * Proses Validasi & Autentikasi Login
     */
    public function login(Request $request)
    {
        $loginInput = trim($request->input('login_id', ''));
        $password = trim($request->input('password', ''));

        // Cek apakah kolom terisi
        if (empty($loginInput) || empty($password)) {
            return back()->withInput()->with('error', 'Kolom wajib diisi! Silakan masukkan username/email/NIM dan password.');
        }

        // Akun utama
        if ($loginInput === 'nizar' && $password !== '' && $password === config('services.nizar.password')) {
            session([
                'auth_user' => [
                    'name' => 'Muhammad Nizar Zulhaqy',
                    'username' => 'nizar',
                    'nim' => '10112049',
                    'role' => 'admin'
                ]
            ]);
            return redirect()->route('dashboard')->with('success', 'Selamat datang, Muhammad Nizar Zulhaqy!');
        }

        // Cek login via NIM Mahasiswa
        $students = ClassDataService::getStudents();
        foreach ($students as $s) {
            if ($s['nim'] === $loginInput || strtolower($s['email']) === strtolower($loginInput)) {
                if ($password === '12345678' || $password === $s['nim']) {
                    session([
                        'auth_user' => [
                            'name' => $s['nama'],
                            'nim' => $s['nim'],
                            'email' => $s['email'],
                            'role' => 'mahasiswa',
                            'jabatan' => $s['jabatan']
                        ]
                    ]);
                    return redirect()->route('dashboard')->with('success', "Selamat datang, {$s['nama']}!");
                }
            }
        }

        // Data tidak valid
        return back()->withInput()->with('error', 'Data login tidak valid! Username, NIM, email, atau password yang Anda masukkan salah.');
    }

    /**
     * Logout dari Sistem
     */
    public function logout()
    {
        session()->forget('auth_user');
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}
