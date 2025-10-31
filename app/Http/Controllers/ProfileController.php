<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    protected $service;

    public function __construct(ProfileService $service)
    {
        $this->service = $service;
    }

    public function my_profile()
    {
        $userId = auth()->id();
        $data = $this->service->getProfileData($userId);

        if ($data['user']->role == 'admin') {
            return view('teacher_profile', ['user' => $data['user'], 'teacher' => $data['teacher']]);
        } elseif ($data['user']->role == 'user') {
            return view('student_profile', ['user' => $data['user'], 'student' => $data['student']]);
        }
    }

    public function edit(Request $request)
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $this->service->updateProfile($request->user(), $request->validated());
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $this->service->deleteProfile($user);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
