<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30'
            ],

            'department' => [
                'nullable',
                'string',
                'max:255'
            ],

            'designation' => [
                'nullable',
                'string',
                'max:255'
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed'
            ],
        ]);


        // Basic profile information
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        $user->phone = $validated['phone'] ?? null;

        $user->department = $validated['department'] ?? null;

        $user->designation = $validated['designation'] ?? null;


        // Profile picture upload
        if ($request->hasFile('profile_photo')) {

            // Delete previous profile picture
            if (
                $user->profile_photo &&
                Storage::disk('public')->exists($user->profile_photo)
            ) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Store new profile picture
            $user->profile_photo = $request
                ->file('profile_photo')
                ->store('profile-photos', 'public');
        }


        // Password
        if (!empty($validated['password'])) {

            $user->password = Hash::make(
                $validated['password']
            );
        }


        $user->save();


        return redirect()
            ->route('profile.edit')
            ->with(
                'success',
                'Your profile has been updated successfully.'
            );
    }
}