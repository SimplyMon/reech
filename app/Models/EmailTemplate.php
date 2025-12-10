<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'subject',
        'target_status',
        'body',
    ];

    // NEW: Cast target_status to array for easy handling
    protected $casts = [
        'target_status' => 'array',
    ];

    // Relationship: A template belongs to one Agent
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
