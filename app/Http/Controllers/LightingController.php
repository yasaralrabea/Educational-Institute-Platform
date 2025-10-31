<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LightingService;
use App\Models\Lighting;

class LightingController extends Controller
{
    protected $service;

    public function __construct(LightingService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $lighting = $this->service->listAll();
        return view('lightings', compact('lighting'));
    }

    public function index_to_student()
    {
        $lighting = $this->service->listActive();
        return view('lightings_s', compact('lighting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'condition' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'lighting' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $this->service->createLighting($request);

        return redirect()->route('lighting.index')->with('success', 'تمت إضافة الإضاءة بنجاح');
    }

    public function update(Request $request, $id)
    {
        $lighting = Lighting::findOrFail($id);

        $request->validate([
            'lighting' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'condition' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $this->service->updateLighting($request, $lighting);

        return redirect()->route('lighting.index')->with('success', 'تم تعديل الإضاءة بنجاح');
    }

    public function destroy($id)
    {
        $lighting = Lighting::findOrFail($id);
        $this->service->deleteLighting($lighting);

        return redirect()->route('lighting.index')->with('success', 'تم حذف الإضاءة بنجاح');
    }
}
