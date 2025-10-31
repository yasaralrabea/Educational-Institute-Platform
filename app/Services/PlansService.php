<?php

namespace App\Services;

use App\Repositories\RecitationRepository;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PlansService
{
    protected $repo;

    public function __construct(RecitationRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listAllRecitations()
    {
        $recitations = $this->repo->allWithStudent();
        $plans = Student::all();

        return compact('plans', 'recitations');
    }

    public function recitationsByStudent(Student $student)
    {
        return $this->repo->getByStudent($student);
    }

    public function myPlan($request)
    {
        $userId = Auth::id();
        $student = Student::where('user_id', $userId)->first();

        $query = $this->repo->queryByStudentId($student->id);

        // فلتر نوع الخطة
        $planType = $request->get('plan_type'); // weekly, monthly, quarterly
        $now = Carbon::now();

        if ($planType == 'weekly') {
            $query->whereBetween('date', [$now->startOfWeek(), $now->endOfWeek()]);
        } elseif ($planType == 'monthly') {
            $query->whereBetween('date', [$now->startOfMonth(), $now->endOfMonth()]);
        } elseif ($planType == 'quarterly') {
            $query->whereBetween('date', [$now->subMonths(3)->startOfMonth(), $now->endOfMonth()]);
        }

        // فلتر من - إلى
        $fromDate = $request->get('fromDate');
        $toDate = $request->get('toDate');

        if ($fromDate) $query->whereDate('date', '>=', $fromDate);
        if ($toDate) $query->whereDate('date', '<=', $toDate);

        $recitation = $query->orderBy('date', 'desc')->get();

        return compact('student', 'recitation');
    }
}
