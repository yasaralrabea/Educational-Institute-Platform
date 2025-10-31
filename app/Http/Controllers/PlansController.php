<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PlansService;
use App\Models\Student;

class PlansController extends Controller
{
    protected $service;

    public function __construct(PlansService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->listAllRecitations();
        return view('plans', $data);
    }

    public function getByStudent(Student $student)
    {
        $recitations = $this->service->recitationsByStudent($student);
        return response()->json($recitations);
    }

    public function my_plan(Request $request)
    {
        $data = $this->service->myPlan($request);
        return view('my_plan', $data);
    }
}
