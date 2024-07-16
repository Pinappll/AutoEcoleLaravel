<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function eleveDashboard()
    {
        return view('students.dashboard');
    }

    public function moniteurDashboard()
    {
        return view('moniteurs.dashboard');
    }

    public function adminDashboard()
    {
        return view('admins.dashboard');
    }

    public function superadminDashboard()
    {
        return view('superadmin.dashboard');
    }

    public function noRole()
    {
        return view('no_role');
    }
}
