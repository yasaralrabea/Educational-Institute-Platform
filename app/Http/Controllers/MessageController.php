<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MessageService;

class MessageController extends Controller
{
    protected $service;

    public function __construct(MessageService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $messages = $this->service->fetchMessages();
        return view('messages', compact('messages'));
    }

    public function fetch()
    {
        $messages = $this->service->fetchMessages();
        return view('partials.messages', compact('messages'));
    }

    // إرسال رسالة جديدة
    public function store(Request $request)
    {
        $request->validate(['message' => 'required|string|max:255']);

        $message = $this->service->createMessage($request->message);

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['message' => 'required|string|max:255']);

        try {
            $message = $this->service->updateMessage($id, $request->message);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function destroy($id)
    {
        try {
            $this->service->deleteMessage($id);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }

        return response()->json(['success' => true]);
    }
}
