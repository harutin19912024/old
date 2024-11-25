<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealParty extends Model
{
    protected $table = 'deal_parties';
	
    protected $fillable = [
        'name', 
        'email',
        'office_phone_number',
        'cell_phone_number',
        'role',
        'address1',
        'address2',
        'city',
        'state',
        'zip_code',
    ];

    public static $roles = [
        "buyer",
        "agent/broker",
        "buyer attorney",
        "seller attorney",
        "mortage broker",
        "inspektor"
    ];
}
