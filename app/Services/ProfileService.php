<?php

namespace App\Services;

use App\Repositories\UserRepository;

class ProfileService
{
    protected $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getProfileData($userId)
    {
        $user = $this->repo->find($userId);
        $teacher = $this->repo->getTeacherByUserId($userId);
        $student = $this->repo->getStudentByUserId($userId);

        return compact('user', 'teacher', 'student');
    }

    public function updateProfile($user, array $data)
    {
        return $this->repo->updateUser($user, $data);
    }

    public function deleteProfile($user)
    {
        return $this->repo->deleteUser($user);
    }
}
