<?php

namespace App\Services;

use App\Repositories\MessageRepository;
use Illuminate\Support\Facades\Auth;

class MessageService
{
    protected $repo;

    public function __construct(MessageRepository $repo)
    {
        $this->repo = $repo;
    }

    public function fetchMessages($limit = 50)
    {
        return $this->repo->latest($limit);
    }

    public function createMessage($content)
    {
        return $this->repo->create([
            'user_id' => Auth::id(),
            'message' => $content,
        ]);
    }

    public function updateMessage($id, $content)
    {
        $message = $this->repo->find($id);

        if ($message->user_id !== Auth::id() && ! (Auth::user() && Auth::user()->is_admin)) {
            throw new \Exception('غير مصرح');
        }

        $this->repo->update($message, ['message' => $content]);
        return $message;
    }

    public function deleteMessage($id)
    {
        $message = $this->repo->find($id);

        if ($message->user_id !== Auth::id() && ! (Auth::user() && Auth::user()->is_admin)) {
            throw new \Exception('غير مصرح');
        }

        $this->repo->delete($message);
    }
}
