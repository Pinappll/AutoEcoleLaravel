<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Car;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    protected $smsService;

    
    
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
        // Validation des données
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
    
        // Conversion des heures en objets Carbon
        $startTime = Carbon::createFromFormat('Y-m-d H:i', $validated['date'] . ' ' . $validated['start_time']);
        $endTime = Carbon::createFromFormat('Y-m-d H:i', $validated['date'] . ' ' . $validated['end_time']);
        $now = Carbon::now();
    
        // Vérifier que la leçon n'est pas dans le passé
        if ($startTime < $now) {
            return back()->withErrors(['error' => 'La leçon ne peut pas être programmée dans le passé.']);
        }
    
        // Vérifier les conflits pour l'étudiant
        $conflictingLessonForStudent = Lesson::where('student_id', $validated['student_id'])
            ->where(function($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime])
                      ->orWhere(function($query) use ($startTime, $endTime) {
                          $query->where('start_time', '<=', $startTime)
                                ->where('end_time', '>=', $endTime);
                      });
            })
            ->exists();
    
        // Vérifier les conflits pour le moniteur
        $conflictingLessonForMoniteur = Lesson::where('moniteur_id', $validated['moniteur_id'])
            ->where(function($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime])
                      ->orWhere(function($query) use ($startTime, $endTime) {
                          $query->where('start_time', '<=', $startTime)
                                ->where('end_time', '>=', $endTime);
                      });
            })
            ->exists();
    
        // Vérifier les conflits pour la voiture
        $conflictingLessonForCar = Lesson::where('car_id', $validated['car_id'])
            ->where(function($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime])
                      ->orWhere(function($query) use ($startTime, $endTime) {
                          $query->where('start_time', '<=', $startTime)
                                ->where('end_time', '>=', $endTime);
                      });
            })
            ->exists();
    
        if ($conflictingLessonForStudent) {
            // Erreur si la leçon se chevauche avec celle d'un autre étudiant
            return back()->withErrors(['error' => 'L\'étudiant a déjà une leçon qui se chevauche avec cette nouvelle leçon.']);
        }
    
        if ($conflictingLessonForMoniteur) {
            // Erreur si le moniteur est déjà occupé
            return back()->withErrors(['error' => 'Le moniteur est déjà occupé à ce créneau horaire.']);
        }
    
        if ($conflictingLessonForCar) {
            // Erreur si la voiture est déjà réservée
            return back()->withErrors(['error' => 'La voiture est déjà réservée à ce créneau horaire.']);
        }
    
        // Enregistrer la leçon si aucun conflit n'est détecté
       Lesson::create($validated);

        // $student = User::find($validated['student_id']);
        // $message = "Bonjour {$student->name}, vous êtes inscrit à la leçon de conduite le {$lesson->date} de {$lesson->start_time} à {$lesson->end_time}.";
        // $this->smsService->sendSms($student->phone_number, $message);
    
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

