<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FinService;
use App\Models\Fin;

class FinController extends Controller
{
    protected $service;

    public function __construct(FinService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $data = $this->service->listFins($request->only(['type', 'from', 'to']));
        return view('fins', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'reason' => 'required|string|max:255',
            'party' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $this->service->createFin($request->all());

        return redirect()->route('fins.index')->with('success', 'تمت إضافة الحركة بنجاح');
    }

    public function update(Request $request, Fin $fin)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'reason' => 'required|string|max:255',
            'party' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $this->service->updateFin($fin, $request->all());

        return redirect()->route('fins.index')->with('success', 'تمت تعديل الحركة بنجاح');
    }

    public function destroy(Fin $fin)
    {
        $this->service->deleteFin($fin);

        return redirect()->route('fins.index')->with('success', 'تم حذف الحركة بنجاح');
    }

    public function update_budget(Request $request)
    {
        $request->validate([
            'budget' => 'required|numeric|min:0',
        ]);

        $this->service->updateBudget($request->budget);

        return redirect()->back()->with('success', 'تم تعديل الميزانية بنجاح');
    }
}
