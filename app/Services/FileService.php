<?php

namespace App\Services;

use App\Repositories\FileRepository;
use Illuminate\Support\Facades\Storage;

class FileService
{
    protected $repo;

    public function __construct(FileRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listFiles()
    {
        return $this->repo->all();
    }

    public function storeFile($request)
    {
        $uploadedFile = $request->file('file');
        $path = $uploadedFile->store('uploads', 'public');

        return $this->repo->create([
            'name' => $request->name,
            'type' => $uploadedFile->getClientOriginalExtension(),
            'path' => $path,
        ]);
    }

    public function updateFile($request, $file)
    {
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($file->path);

            $uploadedFile = $request->file('file');
            $file->path = $uploadedFile->store('uploads', 'public');
            $file->type = $uploadedFile->getClientOriginalExtension();
        }

        $file->name = $request->name;
        $file->save();

        return $file;
    }

    public function deleteFile($file)
    {
        Storage::disk('public')->delete($file->path);
        return $this->repo->delete($file);
    }
}
