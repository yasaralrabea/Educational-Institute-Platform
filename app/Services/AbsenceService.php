<?php

namespace App\Services;

use App\Repositories\AbsenceRepository;
use Illuminate\Support\Facades\Auth;

class AbsenceService
{
    protected $repo;

    public function __construct(AbsenceRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listAbsences($fromDate = null, $toDate = null)
    {
        $absences = $this->repo->getAbsencesWithStudent($fromDate, $toDate);
        $students = $this->repo->getStudentsWithAbsencesCount();

        return compact('absences', 'students');
    }

    public function storeAbsences(array $absent, array $reasons)
    {
        $date = now()->toDateString();

        foreach ($absent as $studentId => $value) {
            $this->repo->createAbsence(
                $studentId,
                $date,
                $reasons[$studentId] ?? null
            );
        }
    }

    public function deleteAbsence($id)
    {
        return $this->repo->deleteAbsence($id);
    }

    public function updateAbsence($id, array $data)
    {
        return $this->repo->updateAbsence($id, $data);
    }

    public function getMyAbsences($fromDate = null, $toDate = null)
    {
        $student = Auth::user()->student;
        if (!$student) return collect();

        return $this->repo->getStudentAbsences($student->id, $fromDate, $toDate);
    }
}
