<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\UserDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        // 1. Validate inputs
        $validated = $request->validate([
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'in:Male,Female'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'state' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'zipcode' => ['nullable', 'string', 'max:20'],
            'license_number' => ['nullable', 'string', 'max:255'],
            'license_expiration_date' => ['nullable', 'date'],
            'agency_name' => ['nullable', 'string', 'max:255'],
            'agency_phone_number' => ['nullable', 'string', 'max:20'],
            'agency_address' => ['nullable', 'string', 'max:255'],

            'signature' => ['nullable', 'image', 'mimes:png', 'max:2048'],
            // --- MISSING PART 1: VALIDATION ---
            'profile_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $user = $request->user();

        // 2. Handle Signature Upload (Existing)
        $currentSignaturePath = $user->detail->signature_path ?? null;
        $newSignaturePath = $currentSignaturePath;

        if ($request->hasFile('signature')) {
            if ($currentSignaturePath && Storage::disk('public')->exists($currentSignaturePath)) {
                Storage::disk('public')->delete($currentSignaturePath);
            }
            $newSignaturePath = $request->file('signature')->store('signatures', 'public');
        }

        // --- MISSING PART 2: PROFILE PICTURE UPLOAD LOGIC ---
        $currentProfilePath = $user->detail->profile_picture_path ?? null;
        $newProfilePath = $currentProfilePath;

        if ($request->hasFile('profile_picture')) {
            // Delete old picture if exists
            if ($currentProfilePath && Storage::disk('public')->exists($currentProfilePath)) {
                Storage::disk('public')->delete($currentProfilePath);
            }
            // Store new picture
            $newProfilePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // 3. Save Data
        UserDetail::updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => $validated['first_name'] ?? null,
                'last_name' => $validated['last_name'] ?? null,
                'middle_name' => $validated['middle_name'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'phone_number' => $validated['phone_number'] ?? null,
                'state' => $validated['state'] ?? null,
                'city' => $validated['city'] ?? null,
                'zipcode' => $validated['zipcode'] ?? null,
                'license_number' => $validated['license_number'] ?? null,
                'license_expiration_date' => $validated['license_expiration_date'] ?? null,
                'agency_name' => $validated['agency_name'] ?? null,
                'agency_phone_number' => $validated['agency_phone_number'] ?? null,
                'agency_address' => $validated['agency_address'] ?? null,
                'signature_path' => $newSignaturePath,
                // --- MISSING PART 3: SAVE TO DATABASE ---
                'profile_picture_path' => $newProfilePath,
            ]
        );

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        // ... (Keep existing destroy logic)
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
