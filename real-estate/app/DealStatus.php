<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealStatus extends Model
{
    protected $table = 'deal_statuses';
	
    protected $fillable = [
        'name'
    ];
}
