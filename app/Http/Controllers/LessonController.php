<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::all();
        return view('lessons.index', compact('lessons'));
    }

    public function create()
    {
        $moniteurs = User::role('moniteur')->get();
        $id_user = Auth::id();
        $cars = Car::all();
        return view('lessons.create', compact('moniteurs', 'cars','id_user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'moniteur_id' => 'required|exists:users,id',
            'student_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
        ]);
        Lesson::create($validated);
           
        return redirect()->route('eleve.dashboard')->with('success', 'Leçon créée avec succès.');

    }

    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);
        return view('lessons.show', compact('lesson'));
    }

    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        $moniteurs = User::role('moniteur')->get();
        $students = User::role('eleve')->get();
        $cars = Car::all();
        return view('lessons.edit', compact('lesson', 'moniteurs', 'students', 'cars'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
            'moniteur_id' => 'required|exists:users,id',
            'student_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
        ]);

        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->all());

        return redirect()->route('lessons.index')->with('success', 'Leçon mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return redirect()->route('lessons.index')->with('success', 'Leçon supprimée avec succès.');
    }
}

