<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'ppr_user_details';

    protected $fillable = [
        'user_id',
        'profile_picture_path',
        'first_name',
        'last_name',
        'middle_name',
        'gender',
        'state',
        'city',
        'zipcode',
        'phone_number',
        'license_number',
        'license_expiration_date',
        'agency_name',
        'agency_phone_number',
        'agency_address',
        'signature_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
