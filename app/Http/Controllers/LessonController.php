<?php
// app/Http/Controllers/LessonController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Moniteur;
use App\Models\Student;
use App\Models\Car;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::all();
        return view('lessons.index', compact('lessons'));
    }

    public function create()
    {
        $moniteurs = Moniteur::all();
        $students = Student::all();
        $cars = Car::all();
        return view('lessons.create', compact('moniteurs', 'students', 'cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'moniteur_id' => 'required|exists:moniteurs,id',
            'student_id' => 'required|exists:students,id',
            'car_id' => 'required|exists:cars,id',
        ]);

        Lesson::create($request->all());

        return redirect()->route('lessons.index')->with('success', 'Leçon créée avec succès.');
    }

    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);
        return view('lessons.show', compact('lesson'));
    }

    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        $moniteurs = Moniteur::all();
        $students = Student::all();
        $cars = Car::all();
        return view('lessons.edit', compact('lesson', 'moniteurs', 'students', 'cars'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'moniteur_id' => 'required|exists:moniteurs,id',
            'student_id' => 'required|exists:students,id',
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
