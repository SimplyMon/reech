<?php

namespace App\Models;

use App\Models\Client;
use App\Models\EmailTemplate;
use App\Models\Campaign;
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


    public function emailTemplates()
    {
        return $this->hasMany(EmailTemplate::class, 'user_id');
    }


    public function campaigns()
    {
        return $this->hasMany(Campaign::class, 'user_id');
    }
}
