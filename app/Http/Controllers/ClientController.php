<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // NEW: Added Storage Facade

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     // Get only the clients belonging to the logged-in user
    //     $clients = Auth::user()->clients()->latest()->paginate(10);

    //     return view('clients.index', compact('clients'));
    // }


    public function index(Request $request)
    {
        // Start building the query for clients belonging to the logged-in user
        $clients = Auth::user()->clients();

        // --- 1. Apply Search Filter (Full text search on name, email, city) ---
        if ($search = $request->input('search')) {
            $clients->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%');
            });
        }

        // --- 2. Apply Status Filter ---
        if ($status = $request->input('status')) {
            $clients->where('client_status', $status);
        }

        // --- 3. Apply State Filter ---
        if ($state = $request->input('state')) {
            // Using 'like' allows users to search by state name or abbreviation
            $clients->where('state', 'like', '%' . $state . '%');
        }

        // --- 4. Get Results, Paginate, and Append Filters to Links ---
        // We use appends($request->query()) to ensure that the filters remain active when changing pages
        $clients = $clients->latest()->paginate(10)->appends($request->query());

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // ... Validation rules ...
            'first_name' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'middle_name' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:50',
            'date_of_birth' => 'nullable|date',
            'marital_status' => 'nullable|string|max:50',
            'occupation' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'zipcode' => 'nullable|string|max:20',
            'neighborhood' => 'nullable|string|max:255',
            'budget_min' => 'nullable|numeric',
            'budget_max' => 'nullable|numeric',
            'preferred_property_type' => 'nullable|string|max:100',
            'preferred_location' => 'nullable|string|max:255',
            'preferred_contact_method' => 'nullable|string|max:50',
            'contact_time_preference_from' => 'nullable',
            'contact_time_preference_to' => 'nullable',
            'contact_day_preference' => 'nullable|string|max:100',
            'client_status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        // Handle File Upload for Creation
        $profilePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePath = $request->file('profile_picture')->store('client_photos', 'public');
        }

        // Create Client
        Auth::user()->clients()->create(array_merge(
            $validated,
            ['profile_picture_path' => $profilePath]
        ));

        return redirect()->route('clients.index')->with('success', 'Client added successfully!');
    }

    /**
     * Display the specified resource (Read-Only View).
     */
    public function show(Client $client)
    {
        // Ensure only the owner can view this client
        if (Auth::id() !== $client->user_id) {
            return redirect()->route('clients.index')->with('error', 'Unauthorized access.');
        }

        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        // Authorization check
        if (Auth::id() !== $client->user_id) {
            return redirect()->route('clients.index')->with('error', 'Unauthorized access.');
        }

        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        // Authorization check
        if (Auth::id() !== $client->user_id) {
            return redirect()->route('clients.index')->with('error', 'Unauthorized access.');
        }

        // 1. Re-run Validation for Updates (MUST INCLUDE ALL FIELDS TO BE SAVED)
        $validated = $request->validate([
            // --- PERSONAL INFO (Required fields should still be required) ---
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|max:50',
            'marital_status' => 'nullable|string|max:50',

            // --- CONTACT & ADDRESS ---
            // Note: Since you are not forcing email to be unique on update, this is fine.
            'email' => 'nullable|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'occupation' => 'nullable|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zipcode' => 'nullable|string|max:20',

            // --- REAL ESTATE PREFERENCES ---
            'budget_min' => 'nullable|numeric',
            'budget_max' => 'nullable|numeric',
            'preferred_property_type' => 'nullable|string|max:100',
            'preferred_location' => 'nullable|string|max:255',

            // --- OTHER FIELDS (from your Store method) ---
            'preferred_contact_method' => 'nullable|string|max:50',
            'contact_time_preference_from' => 'nullable',
            'contact_time_preference_to' => 'nullable',
            'contact_day_preference' => 'nullable|string|max:100',
            'client_status' => 'required|string',
            'notes' => 'nullable|string',

            // --- PHOTO ---
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2. Handle Profile Picture Upload
        $profilePath = $client->profile_picture_path;

        if ($request->hasFile('profile_picture')) {
            // Delete old file
            if ($profilePath) {
                Storage::disk('public')->delete($profilePath);
            }
            // Store new file
            $profilePath = $request->file('profile_picture')->store('client_photos', 'public');
        }

        // 3. Update Client Record
        // Merge the validated data with the profile picture path and save.
        $client->update(array_merge(
            $validated,
            ['profile_picture_path' => $profilePath]
        ));

        return redirect()->route('clients.index')->with('success', "Client {$client->first_name} updated successfully!");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        // Authorization check
        if (Auth::id() !== $client->user_id) {
            return redirect()->route('clients.index')->with('error', 'Unauthorized access.');
        }

        // Optional: Delete the profile picture file from storage before deleting the record
        if ($client->profile_picture_path) {
            Storage::disk('public')->delete($client->profile_picture_path);
        }

        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully!');
    }
}
