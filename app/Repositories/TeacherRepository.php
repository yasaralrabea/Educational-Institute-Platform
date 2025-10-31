<?php

namespace App\Repositories;

use App\Models\Teacher;
use App\Models\User;

class TeacherRepository
{
    public function all()
    {
        return Teacher::all();
    }

    public function find($id)
    {
        return Teacher::with('user')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Teacher::create($data);
    }

    public function update($teacher, array $data)
    {
        return $teacher->update($data);
    }

    public function delete($teacher)
    {
        return $teacher->delete();
    }

    public function findUser($userId)
    {
        return User::findOrFail($userId);
    }
}
