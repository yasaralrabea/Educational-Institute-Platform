<?php

namespace App\Repositories;

use App\Models\Absence;
use App\Models\Student;

class AbsenceRepository
{
    public function getAbsencesWithStudent($fromDate = null, $toDate = null)
    {
        $query = Absence::with(['student' => fn($q) => $q->withCount('absences')]);

        if ($fromDate && $toDate) {
            $query->whereBetween('date', [$fromDate, $toDate]);
        } elseif ($fromDate) {
            $query->whereDate('date', '>=', $fromDate);
        } elseif ($toDate) {
            $query->whereDate('date', '<=', $toDate);
        }

        return $query->get();
    }

    public function getStudentsWithAbsencesCount()
    {
        return Student::withCount('absences')->get();
    }

    public function createAbsence($studentId, $date, $reason = null)
    {
        return Absence::create([
            'student_id' => $studentId,
            'date' => $date,
            'reason' => $reason,
        ]);
    }

    public function findAbsence($id)
    {
        return Absence::findOrFail($id);
    }

    public function deleteAbsence($id)
    {
        $absence = $this->findAbsence($id);
        return $absence->delete();
    }

    public function updateAbsence($id, $data)
    {
        $absence = $this->findAbsence($id);
        return $absence->update($data);
    }

    public function getStudentAbsences($studentId, $fromDate = null, $toDate = null)
    {
        $query = Absence::where('student_id', $studentId);

        if ($fromDate) $query->whereDate('date', '>=', $fromDate);
        if ($toDate) $query->whereDate('date', '<=', $toDate);

        return $query->orderBy('date', 'desc')->get();
    }
}
