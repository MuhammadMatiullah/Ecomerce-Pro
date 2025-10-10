<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'email', 'telephone', 'fax',
        'company', 'address1', 'address2', 'city', 'postcode', 'country', 'region_state',
        'is_billing', 'is_delivery'
    ];

    // relation with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

