<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('eleve')) {
            $lessons = Lesson::where('student_id', $user->id)->get();
        } elseif ($user->hasRole('moniteur')) {
            $lessons = Lesson::where('moniteur_id', $user->id)->get();
        } else {
            $lessons = Lesson::all();
        }

        return response()->json($lessons);
    }
    public function store(Request $request)
    {
        
    }
    public function show($id)
    {
        
    }
    public function update(Request $request, $id)
    {
        
    }
    public function destroy($id)
    {
        
    }
}
