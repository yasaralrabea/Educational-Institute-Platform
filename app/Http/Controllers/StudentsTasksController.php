<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StudentsTaskService;

class StudentsTasksController extends Controller
{
    protected $service;

    public function __construct(StudentsTaskService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $tasks = $this->service->listTasks();
        return view('studentsTasks', compact('tasks'));
    }

    public function s_index()
    {
        $tasks = $this->service->listOpenTasks();
        return view('my_tasks', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject'=>'required|string|max:255',
            'url'=>'nullable|url',
            'open_to'=>'required|date',
            'file'=>'nullable|file|mimes:pdf,doc,docx,zip|max:10240',
        ]);

        $this->service->storeTask($request->all(), $request->file('file'));

        return redirect()->route('tasks.index')->with('success','تم اضافة الواجب بنجاح');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subject'=>'required|string|max:255',
            'url'=>'nullable|url',
            'open_to'=>'required|date',
            'file'=>'nullable|file|mimes:pdf,doc,docx,zip|max:10240',
        ]);

        $this->service->updateTask($id, $request->all(), $request->file('file'));

        return redirect()->route('visit.task', $id)->with('success','تم تعديل الواجب بنجاح');
    }

    public function destroy($id)
    {
        $this->service->deleteTask($id);
        return redirect()->route('tasks.index')->with('success','تم حذف الواجب بنجاح');
    }

    public function close($id)
    {
        $this->service->closeTask($id);
        return redirect()->route('visit.task', $id)->with('success','تم تعديل الواجب بنجاح');
    }

    public function open($id)
    {
        $this->service->openTask($id);
        return redirect()->route('visit.task', $id)->with('success','تم تعديل الواجب بنجاح');
    }

    public function task($id)
    {
        $data = $this->service->getTaskWithSubmissions($id);
        return view('visittask', $data);
    }

    public function my_task($id)
    {
        $userId = auth()->id();
        $task = $this->service->listOpenTasks()->where('id',$id)->first();
        $rate = $this->service->getStudentSubmission($id, $userId);

        return view('my_task', compact('task','rate'));
    }

    public function task_store(Request $request)
    {
        $this->service->storeSubmission($request->all(), $request->file('file'));
        return redirect()->route('my_task', $request->task_id)
                         ->with('success','تم تسليم الواجب بنجاح');
    }

    public function submission_show($id)
    {
        $submission = $this->service->getStudentSubmission($id, auth()->id());
        return view('submission', compact('submission'));
    }

    public function rate(Request $request, $id)
    {
        $this->service->rateSubmission($id, $request->rate);
        return redirect()->route('submission.show',$id)->with('success','تم التقييم بنجاح');
    }
}
