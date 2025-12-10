<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'campaigns';

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'description',
        'status',

        // Step fields added to fillable
        'step_name',
        'step_type',
        'email_template_id',
        'preferred_property_type',
    ];

    // Relationship to the User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to the Email Template
    public function template()
    {
        return $this->belongsTo(EmailTemplate::class, 'email_template_id');
    }
}
