<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;

class UserRepository
{
    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function getTeacherByUserId($userId)
    {
        return Teacher::with('user')->where('user_id', $userId)->first();
    }

    public function getStudentByUserId($userId)
    {
        return Student::with('user')->where('user_id', $userId)->first();
    }

    public function updateUser($user, array $data)
    {
        $user->fill($data);
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();
        return $user;
    }

    public function deleteUser($user)
    {
        return $user->delete();
    }
}
