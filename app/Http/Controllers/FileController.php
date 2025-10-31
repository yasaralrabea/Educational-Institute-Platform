<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FileService;
use App\Models\File;

class FileController extends Controller
{
    protected $service;

    public function __construct(FileService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $files = $this->service->listFiles();
        return view('files', compact('files'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file|max:10240',
        ]);

        $this->service->storeFile($request);

        return redirect()->route('files.index')->with('success', 'تم رفع الملف بنجاح.');
    }

    public function update(Request $request, File $file)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|file|max:10240',
        ]);

        $this->service->updateFile($request, $file);

        return redirect()->route('files.index')->with('success', 'تم تعديل الملف بنجاح.');
    }

    public function destroy(File $file)
    {
        $this->service->deleteFile($file);

        return redirect()->route('files.index')->with('success', 'تم حذف الملف بنجاح.');
    }
}
