<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    public function latest($limit = 50)
    {
        return Message::with('user')->latest()->take($limit)->get();
    }

    public function find($id)
    {
        return Message::findOrFail($id);
    }

    public function create(array $data)
    {
        return Message::create($data);
    }

    public function update($message, array $data)
    {
        return $message->update($data);
    }

    public function delete($message)
    {
        return $message->delete();
    }
}
