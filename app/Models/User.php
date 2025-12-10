<?php

namespace App\Models;

use App\Models\Client;
use App\Models\EmailTemplate;
use App\Models\Campaign; // <-- NEW: Import the Campaign Model
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'ppr_users';

    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'email_verified_at' => 'datetime',
        ];
    }

    public function detail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'user_id');
    }

    /**
     * Define the relationship: One User (Agent) has many EmailTemplates.
     */
    public function emailTemplates()
    {
        // Laravel links User ID (id) to EmailTemplate's foreign key (user_id)
        return $this->hasMany(EmailTemplate::class, 'user_id');
    }

    /**
     * Define the relationship: One User (Agent) has many Campaigns.
     * This fixes the "campaigns() not found" error.
     */
    public function campaigns()
    {
        // Assumes 'campaigns' table has a foreign key 'user_id'
        return $this->hasMany(Campaign::class, 'user_id');
    }
}
