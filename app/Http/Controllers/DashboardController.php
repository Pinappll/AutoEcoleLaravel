<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lesson;


class DashboardController extends Controller
{
    public function redirectToDashboard()
    {
        $user = Auth::user();
        
        if ($user->hasRole('eleve')) {
            return redirect()->route('eleve.dashboard');
        } elseif ($user->hasRole('moniteur')) {
            return redirect()->route('moniteur.dashboard');
        } elseif ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('superadmin')) {
            return redirect()->route('superadmin.dashboard');
        }else {
            return redirect()->route('no.role');
        }

        // Optionally, handle the case where the user does not have any role
        return redirect('/'); // Or any other route you prefer
    }
    
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
        $lessons = Lesson::with(['student', 'moniteur', 'car', 'lesson'])->get();
        return view('admins.dashboard', compact('lessons'));
        //return view('admins.dashboard');
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
