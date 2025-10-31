<?php

namespace App\Repositories;

use App\Models\Recitation;
use App\Models\Student;

class RecitationRepository
{
    public function allWithStudent()
    {
        return Recitation::with('student')->orderBy('date', 'desc')->get();
    }

    public function getByStudent(Student $student)
    {
        return $student->recitations()->orderBy('date', 'desc')->get();
    }

    public function queryByStudentId($studentId)
    {
        return Recitation::where('student_id', $studentId);
    }
}
