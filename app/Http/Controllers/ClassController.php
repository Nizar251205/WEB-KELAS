<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display the Dashboard page.
     */
    public function dashboard()
    {
        $info = config('classdata.info');
        $dashboard = config('classdata.dashboard');
        $officers = config('classdata.officers');

        return view('dashboard', [
            'info' => $info,
            'dashboard' => $dashboard,
            'officers' => $officers,
        ]);
    }

    /**
     * Display the Class Profile page.
     */
    public function profile()
    {
        $info = config('classdata.info');

        return view('profile', [
            'info' => $info,
        ]);
    }

    /**
     * Display the Class Officers & Organization Structure page.
     */
    public function jabatan()
    {
        $info = config('classdata.info');
        $officers = config('classdata.officers');

        return view('jabatan', [
            'info' => $info,
            'officers' => $officers,
        ]);
    }
}
