<?php

namespace App\Repositories;

use App\Models\StudentsTask;
use App\Models\Submission;

class StudentsTaskRepository
{
    public function allTasks()
    {
        return StudentsTask::all();
    }

    public function openTasks()
    {
        return StudentsTask::where('condition','open')->get();
    }

    public function findTask($id)
    {
        return StudentsTask::findOrFail($id);
    }

    public function createTask(array $data)
    {
        return StudentsTask::create($data);
    }

    public function updateTask($task, array $data)
    {
        return $task->update($data);
    }

    public function deleteTask($task)
    {
        return $task->delete();
    }

    public function getSubmissions($taskId)
    {
        return Submission::where('task_id',$taskId)->get();
    }

    public function createSubmission(array $data)
    {
        return Submission::create($data);
    }

    public function findSubmission($id)
    {
        return Submission::findOrFail($id);
    }

    public function updateSubmission($submission, array $data)
    {
        return $submission->update($data);
    }
}
