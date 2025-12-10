<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'ppr_clients';

    protected $fillable = [
        'user_id',
        'profile_picture_path',
        // Personal
        'email',
        'first_name',
        'last_name',
        'middle_name',
        'gender',
        'date_of_birth',
        'marital_status',
        'occupation',
        // Contact
        'phone_number',
        'state',
        'city',
        'zipcode',
        'neighborhood',
        // Real Estate
        'budget_min',
        'budget_max',
        'preferred_property_type',
        'preferred_location',
        // Preferences
        'preferred_contact_method',
        'contact_time_preference_from',
        'contact_time_preference_to',
        'contact_day_preference',
        // Status
        'client_status',
        'notes'
    ];

    // Relationship: A client belongs to one Agent
    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
