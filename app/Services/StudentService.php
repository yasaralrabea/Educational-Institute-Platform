<?php

namespace App\Services;

use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class StudentService
{
    protected $repo;

    public function __construct(StudentRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listStudents()
    {
        return $this->repo->all();
    }

    public function createStudent(array $data)
    {
        // إنشاء المستخدم
        $user = $this->repo->createUser([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));

        // إنشاء الطالب وربطه بالمستخدم
        $studentData = $data;
        $studentData['user_id'] = $user->id;

        return $this->repo->createStudent($studentData);
    }

    public function updateStudent($id, array $data)
    {
        $student = $this->repo->find($id);
        return $this->repo->updateStudent($student, $data);
    }

    public function deleteStudent($id)
    {
        $student = $this->repo->find($id);
        return $this->repo->deleteStudent($student);
    }

    public function findStudent($id)
    {
        return $this->repo->find($id);
    }
}
