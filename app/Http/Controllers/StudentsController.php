<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StudentService;

class StudentsController extends Controller
{
    protected $service;

    public function __construct(StudentService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $students = $this->service->listStudents();
        return view('students', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'track'=>'required|string|max:255',
            'phone'=>'required|numeric',
            'memorization'=>'required|string|max:255',
            'level'=>'required|string|max:255',
            'age'=>'required|string|max:255',
            'goal'=>'required|string|max:255',
            'juz'=>'required|string|max:255',
            'email'=>['required','string','lowercase','email','max:255','unique:users,email'],
            'password'=>['required','confirmed'],
        ]);

        $this->service->createStudent($request->all());

        return redirect()->route('students.index')->with('success','تمت إضافة الطالب بنجاح ✅');
    }

    public function show($id)
    {
        $student = $this->service->findStudent($id);
        return view('student', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'track'=>'required|string|max:255',
            'phone'=>'required|numeric',
            'memorization'=>'required|string|max:255',
            'level'=>'required|string|max:255',
            'age'=>'required|string|max:255',
            'goal'=>'required|string|max:255',
            'juz'=>'required|string|max:255',
        ]);

        $this->service->updateStudent($id, $request->all());

        return redirect()->route('students.show', $id)
                         ->with('success','تم تحديث بيانات الطالب بنجاح ✅');
    }

    public function destroy($id)
    {
        $this->service->deleteStudent($id);
        return redirect()->route('students.index')
                         ->with('success','تم حذف الطالب بنجاح 🗑');
    }
}
