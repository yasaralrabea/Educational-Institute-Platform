<?php

namespace App\Repositories;

use App\Models\Lighting;

class LightingRepository
{
    public function all()
    {
        return Lighting::all();
    }

    public function allActive()
    {
        return Lighting::where('condition', 'yes')->get();
    }

    public function find($id)
    {
        return Lighting::findOrFail($id);
    }

    public function create(array $data)
    {
        return Lighting::create($data);
    }

    public function update(Lighting $lighting, array $data)
    {
        return $lighting->update($data);
    }

    public function delete(Lighting $lighting)
    {
        return $lighting->delete();
    }
}
