<?php

namespace App\Services;

use App\Repositories\TeacherRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class TeacherService
{
    protected $repo;

    public function __construct(TeacherRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listTeachers()
    {
        return $this->repo->all();
    }

    public function createTeacher(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));

        $data['user_id'] = $user->id;

        return $this->repo->create($data);
    }

    public function updateTeacher($id, array $data)
    {
        $teacher = $this->repo->find($id);
        return $this->repo->update($teacher, $data);
    }

    public function deleteTeacher($id)
    {
        $teacher = $this->repo->find($id);
        $user = $this->repo->findUser($teacher->user_id);

        if ($user->role === 'admin') {
            throw new \Exception('لا يمكنك حذف الآدمن, أزل الآدمن أولا');
        }

        return $this->repo->delete($teacher);
    }

    public function promote($id)
    {
        $teacher = $this->repo->find($id);
        $user = $this->repo->findUser($teacher->user_id);
        $user->role = 'admin';
        $user->save();
        return $teacher;
    }

    public function demote($id)
    {
        $teacher = $this->repo->find($id);
        $user = $this->repo->findUser($teacher->user_id);
        $user->role = 'user';
        $user->save();
        return $teacher;
    }

    public function getTeacher($id)
    {
        return $this->repo->find($id);
    }
}
