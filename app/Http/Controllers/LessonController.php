<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::all();
        return view('lessons.index', compact('lessons'));
    }

    public function create()
    {
        return view('lessons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
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
        return view('lessons.edit', compact('lesson'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
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
