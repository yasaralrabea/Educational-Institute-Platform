<?php

namespace App\Services;

use App\Repositories\StudentsTaskRepository;
use Illuminate\Support\Facades\Storage;

class StudentsTaskService
{
    protected $repo;

    public function __construct(StudentsTaskRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listTasks()
    {
        return $this->repo->allTasks();
    }

    public function listOpenTasks()
    {
        return $this->repo->openTasks();
    }

    public function storeTask(array $data, $file = null)
    {
        if ($file) {
            $data['file_path'] = $file->store('tasks_files','public');
        }

        return $this->repo->createTask($data);
    }

    public function updateTask($id, array $data, $file = null)
    {
        $task = $this->repo->findTask($id);

        if ($file) {
            if ($task->file_path && Storage::disk('public')->exists($task->file_path)) {
                Storage::disk('public')->delete($task->file_path);
            }
            $data['file_path'] = $file->store('tasks_files','public');
        }

        return $this->repo->updateTask($task, $data);
    }

    public function closeTask($id)
    {
        $task = $this->repo->findTask($id);
        return $this->repo->updateTask($task, ['condition'=>'close']);
    }

    public function openTask($id)
    {
        $task = $this->repo->findTask($id);
        return $this->repo->updateTask($task, ['condition'=>'open']);
    }

    public function deleteTask($id)
    {
        $task = $this->repo->findTask($id);
        return $this->repo->deleteTask($task);
    }

    public function storeSubmission(array $data, $file = null)
    {
        if ($file) {
            $data['file'] = $file->store('submissions','public');
        }
        $data['user_id'] = auth()->id();

        return $this->repo->createSubmission($data);
    }

    public function rateSubmission($submissionId, $rate)
    {
        $submission = $this->repo->findSubmission($submissionId);
        return $this->repo->updateSubmission($submission, ['rate'=>$rate]);
    }

    public function getTaskWithSubmissions($taskId)
    {
        $task = $this->repo->findTask($taskId);
        $submissions = $this->repo->getSubmissions($taskId);

        return compact('task','submissions');
    }

    public function getStudentSubmission($taskId, $userId)
    {
        return $this->repo->getSubmissions($taskId)->where('user_id',$userId)->first();
    }
}
