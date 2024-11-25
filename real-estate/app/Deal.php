<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Deal extends Model
{
    protected $table = 'deals';
    
    public static $deal_types = [
        'buy',
        'sell',
        'rent'
    ];


    protected $fillable = [
        'type', 
        'user_id', 
        'property_address',
        'mls',
        'price',
        'seller_commision',
        'buyer_commision',
        'offer_date',
        'inspection_date',
        'inspection_passed',
        'pns_date',
        'pns_passed',
        'mortage_contingency_date',
        'mortage_contingency_passed',
        'closing_date',
        'deal_status_id',
        'email',
    ];
    
    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $offer_date = Carbon::createFromFormat('d/m/Y', $model->attributes['offer_date']);
            $model->attributes['offer_date'] = Carbon::parse($offer_date)->format('Y-m-d');
            
            $inspection_date = Carbon::createFromFormat('d/m/Y H:i:s', $model->attributes['inspection_date']);
            $model->attributes['inspection_date'] = Carbon::parse($inspection_date)->format('Y-m-d h:i:s');

            $pns_date = Carbon::createFromFormat('d/m/Y H:i:s', $model->attributes['pns_date']);
            $model->attributes['pns_date'] = Carbon::parse($pns_date)->format('Y-m-d h:i:s');
            
            $mortage_contingency_date = Carbon::createFromFormat('d/m/Y H:i:s', $model->attributes['mortage_contingency_date']);
            $model->attributes['mortage_contingency_date'] = Carbon::parse($mortage_contingency_date)->format('Y-m-d h:i:s');
            
            $closing_date = Carbon::createFromFormat('d/m/Y H:i:s', $model->attributes['closing_date']);
            $model->attributes['closing_date'] = Carbon::parse($closing_date)->format('Y-m-d h:i:s');
        });


        self::updating(function($model){
            $offer_date = Carbon::createFromFormat('d/m/Y', $model->attributes['offer_date']);
            $model->attributes['offer_date'] = Carbon::parse($offer_date)->format('Y-m-d');
            
            $inspection_date = Carbon::createFromFormat('d/m/Y H:i:s', $model->attributes['inspection_date']);
            $model->attributes['inspection_date'] = Carbon::parse($inspection_date)->format('Y-m-d h:i:s');

            $pns_date = Carbon::createFromFormat('d/m/Y H:i:s', $model->attributes['pns_date']);
            $model->attributes['pns_date'] = Carbon::parse($pns_date)->format('Y-m-d h:i:s');
            
            $mortage_contingency_date = Carbon::createFromFormat('d/m/Y H:i:s', $model->attributes['mortage_contingency_date']);
            $model->attributes['mortage_contingency_date'] = Carbon::parse($mortage_contingency_date)->format('Y-m-d h:i:s');
            
            $closing_date = Carbon::createFromFormat('d/m/Y H:i:s', $model->attributes['closing_date']);
            $model->attributes['closing_date'] = Carbon::parse($closing_date)->format('Y-m-d h:i:s');
        });




    }
    /**
     * Get the deal's offer date.
     *
     * @param  string  $value
     * @return string
     */
    public function getOfferDateAttribute($value)
    {
        $val = Carbon::createFromFormat('Y-m-d', $value);
        $date = Carbon::parse($val)->format('m/d/Y');
        
        return $date;
    }
    
    /**
     * Get the deal's inspection date.
     *
     * @param  string  $value
     * @return string
     */
    public function getInspectionDateAttribute($value)
    {
        $val = Carbon::createFromFormat('Y-m-d H:i:s', $value);
        $date = Carbon::parse($val)->format('d/m/Y H:i:s');
        
        return $date;
    }
    
    /**
     * Get the deal's pns date.
     *
     * @param  string  $value
     * @return string
     */
    public function getPnsDateAttribute($value)
    {
        $val = Carbon::createFromFormat('Y-m-d H:i:s', $value);
        $date = Carbon::parse($val)->format('d/m/Y H:i:s');
        
        return $date;
    }
    
    /**
     * Get the deal's mortage contingency date.
     *
     * @param  string  $value
     * @return string
     */
    public function getMortageContingencyDateAttribute($value)
    {
        $val = Carbon::createFromFormat('Y-m-d H:i:s', $value);
        $date = Carbon::parse($val)->format('d/m/Y H:i:s');
        
        return $date;
    }
    
    /**
     * Get the deal's closing date.
     *
     * @param  string  $value
     * @return string
     */
    public function getClosingDateAttribute($value)
    {
        $val = Carbon::createFromFormat('Y-m-d H:i:s', $value);
        $date = Carbon::parse($val)->format('d/m/Y H:i:s');
        
        return $date;
    }
    
    public function participants() {
        return $this->hasMany(DealParticipant::class);
    }
	
	public function deal_parties() {
        return $this->belongsToMany(DealParty::class, 'deal_participants', 'deal_id', 'deal_parties_id');
    }
}
