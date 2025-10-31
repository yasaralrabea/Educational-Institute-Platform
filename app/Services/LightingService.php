<?php

namespace App\Services;

use App\Repositories\LightingRepository;
use Illuminate\Support\Facades\Storage;

class LightingService
{
    protected $repo;

    public function __construct(LightingRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listAll()
    {
        return $this->repo->all();
    }

    public function listActive()
    {
        return $this->repo->allActive();
    }

    public function createLighting($request)
    {
        $path = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $filename, 'public');
        }

        return $this->repo->create([
            'condition' => $request->condition,
            'lighting' => $request->lighting,
            'subject' => $request->subject,
            'photo' => $path ? '/storage/' . $path : null,
        ]);
    }

    public function updateLighting($request, $lighting)
    {
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images', 'public');
            $requestData['photo'] = '/storage/' . $path;
        }

        $requestData = [
            'condition' => $request->condition,
            'lighting' => $request->lighting,
            'subject' => $request->subject,
        ];

        if (isset($requestData['photo'])) {
            $requestData['photo'] = $requestData['photo'];
        }

        return $this->repo->update($lighting, $requestData);
    }

    public function deleteLighting($lighting)
    {
        return $this->repo->delete($lighting);
    }
}
