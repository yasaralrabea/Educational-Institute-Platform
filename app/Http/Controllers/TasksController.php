<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CalendarService;

class TasksController extends Controller
{
    protected $service;

    public function __construct(CalendarService $service)
    {
        $this->service = $service;
    }

    public function get_calendar()
    {
        $calendars = $this->service->list();
        return view('calendar', compact('calendars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'goal' => 'required|string|max:255',
            'condition' => 'nullable|string|max:255',
            'students' => 'nullable|string|max:255'
        ]);

        $this->service->create($request->all());
        return redirect()->route('calendars.index')->with('success', 'تمت إضافة الهدف بنجاح');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'goal' => 'required|string|max:255',
            'condition' => 'nullable|string|max:255',
        ]);

        $this->service->update($id, $request->all());
        return redirect()->route('calendars.index')->with('success', 'تم تعديل الهدف بنجاح');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('calendars.index')->with('success', 'تم حذف الهدف بنجاح');
    }

    public function done($id)
    {
        $this->service->markDone($id);
        return redirect()->route('calendars.index')->with('success', 'تم انجاز الهدف بنجاح');
    }

    public function my_calendar()
    {
        $calendar = $this->service->studentCalendar();
        return view('my_calendar', compact('calendar'));
    }
}
