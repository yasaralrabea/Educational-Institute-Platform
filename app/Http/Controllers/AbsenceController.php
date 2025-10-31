<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AbsenceService;

class AbsenceController extends Controller
{
    protected $service;

    public function __construct(AbsenceService $service)
    {
        $this->service = $service;
    }

    public function absences(Request $request)
    {
        $data = $this->service->listAbsences(
            $request->input('from_date'),
            $request->input('to_date')
        );

        return view('absences', $data);
    }

    public function store(Request $request)
    {
        $this->service->storeAbsences(
            $request->input('absent', []),
            $request->input('reason', [])
        );

        return redirect()->route('absences.index')
                         ->with('success', 'تم تسجيل الغياب بنجاح 🗑');
    }

    public function destroy($id)
    {
        $this->service->deleteAbsence($id);

        return redirect()->route('absences.index')
                         ->with('success', 'تم حذف الغياب بنجاح 🗑');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'reason' => 'nullable|string|max:255',
        ]);

        $this->service->updateAbsence($id, $request->only(['date', 'reason']));

        return redirect()->route('absences.index')
                         ->with('success', 'تم تحديث الغياب بنجاح');
    }

    public function my_absences(Request $request)
    {
        $absences = $this->service->getMyAbsences(
            $request->input('fromDate'),
            $request->input('toDate')
        );

        return view('my_absences', compact('absences'));
    }
}
