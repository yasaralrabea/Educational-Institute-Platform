<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TeacherService;

class TeacherController extends Controller
{
    protected $service;

    public function __construct(TeacherService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $teachers = $this->service->listTeachers();
        return view('teachers', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'phone'=>'required|numeric',
            'position'=>'required|string|max:255',
            'qualification'=>'required|string|max:255',
            'salary'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed|min:8',
        ]);

        $this->service->createTeacher($request->all());

        return redirect()->route('teachers.index')->with('success','تمت إضافة المعلم بنجاح ✅');
    }

    public function show($id)
    {
        $teacher = $this->service->getTeacher($id);
        return view('teacher', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'phone'=>'required|numeric',
            'position'=>'required|string|max:255',
            'qualification'=>'required|string|max:255',
            'salary'=>'required|string|max:255',
        ]);

        $this->service->updateTeacher($id, $request->all());

        return redirect()->route('teachers.show', $id)
                         ->with('success','تم تحديث بيانات المعلم بنجاح ✅');
    }

    public function destroy($id)
    {
        try {
            $this->service->deleteTeacher($id);
        } catch (\Exception $e) {
            return redirect()->route('teachers.index')->with('error', $e->getMessage());
        }

        return redirect()->route('teachers.index')->with('success','تم حذف المعلم بنجاح 🗑');
    }

    public function promote($id)
    {
        $teacher = $this->service->promote($id);
        return redirect()->route('teachers.show',$id)
                         ->with('success','تمت ترقية المعلم لمشرف');
    }

    public function demote($id)
    {
        $teacher = $this->service->demote($id);
        return redirect()->route('teachers.show',$id)
                         ->with('success','تمت إزالة المعلم من المشرف');
    }
}
