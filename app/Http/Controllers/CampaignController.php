<?php

namespace App\Http\Controllers;

use App\Models\Campaign; // Use the single Campaign model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

// The EmailTemplate model is needed for dropdowns in create/edit
// The validation rules for the single table structure
class CampaignController extends Controller
{
    protected $propertyTypes = ['Single Family', 'Condo', 'Townhouse', 'Multi-Family', 'Land'];

    protected function validationRules()
    {
        return [
            // Header Validation
            'name' => 'required|string|max:255',
            'type' => 'required|in:email_only,email_sms',
            'status' => 'required|in:draft,active,paused,completed',
            'description' => 'nullable|string|max:1000',

            // Step/Detail Validation (fields are now top-level)
            'step_name' => 'required|string|max:255',
            'email_template_id' => 'required|exists:email_templates,id',
            'preferred_property_type' => 'nullable|string|in:' . implode(',', $this->propertyTypes),
            // The step_type is fixed to email_only for simplicity
        ];
    }

    public function index()
    {
        // Use the new model name
        $campaigns = Auth::user()->campaigns()->latest()->paginate(10);
        return view('campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        // Fetch necessary data for the view
        $templates = Auth::user()->emailTemplates()->pluck('name', 'id');
        $propertyTypes = $this->propertyTypes;

        return view('campaigns.create', compact('templates', 'propertyTypes'));
    }

    public function store(Request $request)
    {
        // The single validation is much simpler now
        $validated = $request->validate($this->validationRules());

        // Create the single campaign record
        $campaign = Auth::user()->campaigns()->create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'status' => $validated['status'],
            'description' => $validated['description'] ?? null,

            // Map step fields directly
            'step_name' => $validated['step_name'],
            'step_type' => 'email_only', // Fixed for single step
            'email_template_id' => $validated['email_template_id'],
            'preferred_property_type' => $validated['preferred_property_type'] ?? null,
        ]);

        return redirect()->route('campaigns.show', $campaign->id)->with('success', "Campaign '{$campaign->name}' created successfully!");
    }

    public function show(Campaign $campaign) // Use Campaign model
    {
        if (Auth::id() !== $campaign->user_id) {
            return Redirect::route('campaigns.index')->with('error', 'Unauthorized access.');
        }

        // Pass necessary data for the view
        $propertyTypes = $this->propertyTypes;

        return view('campaigns.show', compact('campaign', 'propertyTypes'));
    }

    public function edit(Campaign $campaign) // Use Campaign model
    {
        if (Auth::id() !== $campaign->user_id) {
            return Redirect::route('campaigns.index')->with('error', 'Unauthorized access.');
        }

        // Fetch required data for dropdowns
        $templates = Auth::user()->emailTemplates()->pluck('name', 'id');
        $propertyTypes = $this->propertyTypes;

        return view('campaigns.edit', compact('campaign', 'templates', 'propertyTypes'));
    }

    public function update(Request $request, Campaign $campaign) // Use Campaign model
    {
        if (Auth::id() !== $campaign->user_id) {
            return Redirect::route('campaigns.index')->with('error', 'Unauthorized access.');
        }

        // Single validation handles all fields
        $validated = $request->validate($this->validationRules());

        // Update the single campaign record
        $campaign->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'status' => $validated['status'],
            'description' => $validated['description'] ?? null,

            // Map step fields directly
            'step_name' => $validated['step_name'],
            'step_type' => 'email_only', // Fixed for single step
            'email_template_id' => $validated['email_template_id'],
            'preferred_property_type' => $validated['preferred_property_type'] ?? null,
        ]);

        return Redirect::route('campaigns.show', $campaign->id)->with('success', "Campaign '{$campaign->name}' saved successfully!");
    }

    public function destroy(Campaign $campaign) // Use Campaign model
    {
        if (Auth::id() !== $campaign->user_id) {
            return Redirect::back()->with('error', 'Unauthorized to delete this campaign.');
        }

        $campaignName = $campaign->name;
        $campaign->delete();

        return Redirect::route('campaigns.index')->with('success', "Campaign '{$campaignName}' deleted successfully!");
    }
}
