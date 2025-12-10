<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use Illuminate\Http\Request; // MUST be imported and injected
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\TemplateMail;

class EmailTemplateController extends Controller
{
    // Define all possible client statuses for dropdowns
    protected $statuses = ['Buyer', 'Client', 'Closed', 'Inactive', 'Lead', 'Prospect', 'Seller'];

    // Centralized validation rules
    protected function validationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'target_status' => 'required|array',
            'target_status.*' => 'required|string|in:' . implode(',', $this->statuses),
            'body' => 'required|string',
        ];
    }

    // -----------------------------------------------------------
    // UPDATED METHOD: INDEX (WITH SEARCH FUNCTIONALITY)
    // -----------------------------------------------------------
    public function index(Request $request)
    {
        // Start the query builder for the current user's templates
        $query = Auth::user()->emailTemplates()->latest();

        // Check if a search term is present in the request
        if ($search = $request->query('search')) {
            // Apply search filter to both 'name' and 'subject' columns
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('subject', 'like', '%' . $search . '%');
            });
        }

        // Paginate the final result set and include the search query in the links
        $templates = $query->paginate(10)->withQueryString();

        return view('templates.index', compact('templates'));
    }

    public function create()
    {
        $statusesWithClients = Auth::user()->clients()
            ->select('client_status')
            ->distinct()
            ->pluck('client_status')
            ->toArray();

        $statuses = array_intersect($this->statuses, $statusesWithClients);

        return view('templates.create', compact('statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->validationRules());
        Auth::user()->emailTemplates()->create($validated);
        return redirect()->route('templates.index')->with('success', 'Email template created successfully!');
    }

    /**
     * Display the specified resource (Read-Only View).
     */
    public function show(EmailTemplate $template)
    {
        if (Auth::id() !== $template->user_id) {
            return Redirect::route('templates.index')->with('error', 'Unauthorized access.');
        }
        return view('templates.show', compact('template'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmailTemplate $template)
    {
        if (Auth::id() !== $template->user_id) {
            return Redirect::route('templates.index')->with('error', 'Unauthorized access.');
        }
        $statuses = $this->statuses;
        return view('templates.edit', compact('template', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmailTemplate $template)
    {
        if (Auth::id() !== $template->user_id) {
            return Redirect::route('templates.index')->with('error', 'Unauthorized access.');
        }
        $validated = $request->validate($this->validationRules());
        $template->update($validated);
        return Redirect::route('templates.index')->with('success', "Template '{$template->name}' updated successfully!");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailTemplate $template)
    {
        if (Auth::id() !== $template->user_id) {
            return Redirect::back()->with('error', 'Unauthorized to delete this template.');
        }
        $template->delete();
        return Redirect::route('templates.index')->with('success', "Template deleted successfully!");
    }

    // -----------------------------------------------------------
    // NEW METHOD: SEND TEMPLATE TO MATCHING CLIENTS
    // -----------------------------------------------------------

    /**
     * Send the template to all clients matching the target status(es).
     */
    public function send(EmailTemplate $template)
    {
        // 1. Authorization Check
        if (Auth::id() !== $template->user_id) {
            return back()->with('error', 'Unauthorized to send this template.');
        }

        $targetStatuses = $template->target_status; // Array due to model casting

        // 2. Query all eligible clients (must have an email and match one of the target statuses)
        $clients = Auth::user()->clients()
            ->whereIn('client_status', $targetStatuses)
            ->whereNotNull('email')
            ->get();

        if ($clients->isEmpty()) {
            return back()->with('error', 'No clients found matching the target statuses: ' . implode(', ', $targetStatuses) . '. No emails were sent.');
        }

        $clientCount = 0;

        // 3. Dispatch Emails
        foreach ($clients as $client) {
            // Send email, replacing placeholders inside the TemplateMail constructor
            Mail::to($client->email)->send(
                new TemplateMail($client, $template->subject, $template->body)
            );
            $clientCount++;
        }

        return redirect()->route('templates.index')->with('success', "Template '{$template->name}' sent to {$clientCount} clients successfully!");
    }
}
