<?php

namespace App\Repositories;

use App\Models\Student;
use App\Models\User;

class StudentRepository
{
    public function all()
    {
        return Student::all();
    }

    public function find($id)
    {
        return Student::findOrFail($id);
    }

    public function createStudent(array $data)
    {
        return Student::create($data);
    }

    public function updateStudent($student, array $data)
    {
        return $student->update($data);
    }

    public function deleteStudent($student)
    {
        return $student->delete();
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }
}
