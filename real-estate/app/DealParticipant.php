<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealParticipant extends Model
{
    protected $table = 'deal_participants';
	
    protected $fillable = [
        'deal_id', 
        'deal_parties_id'
    ];
}
