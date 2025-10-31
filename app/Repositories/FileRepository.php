<?php

namespace App\Repositories;

use App\Models\File;

class FileRepository
{
    public function all()
    {
        return File::orderBy('created_at', 'desc')->get();
    }

    public function create(array $data)
    {
        return File::create($data);
    }

    public function find($id)
    {
        return File::findOrFail($id);
    }

    public function update(File $file, array $data)
    {
        return $file->update($data);
    }

    public function delete(File $file)
    {
        return $file->delete();
    }
}
