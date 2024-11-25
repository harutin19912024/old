<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentTrayBudgetItem extends Model
{
    protected $table = 'document_tray_budget_item';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'sea_id', 'lea_id', 'ses_id', 'item_id', 'document_id'
    ];

    public function resolveChildRouteBinding($childType, $value, $field)
    {
        // TODO: Implement resolveChildRouteBinding() method.
    }

    public function budget()
    {
        return $this->belongsTo('App\Budget', 'item_id');
    }

    public function document()
    {
        return $this->belongsTo('App\Document', 'document_id');
    }
}
