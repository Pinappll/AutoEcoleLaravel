<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'phone_number' => 'required'
        ]);

        Student::create($request->all());

        return redirect('/students')->with('success', 'Étudiant a été ajouté');
    }

    public function show($id)
    {
        $student = Student::find($id);
        return view('students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::find($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone_number' => 'required'
        ]);

        $student = Student::find($id);
        $student->update($request->all());

        return redirect('/students')->with('success', 'Étudiant a été mis à jour');
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect('/students')->with('success', 'Étudiant a été supprimé');
    }
}
