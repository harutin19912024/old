<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentTray extends Model
{
    protected $table = 'document_tray';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'sea_id', 'lea_id', 'ses_id', 'document_tray_type_id', 'name', 'description'
    ];

    public function resolveChildRouteBinding($childType, $value, $field)
    {
        // TODO: Implement resolveChildRouteBinding() method.
    }

    public function trayType()
    {
        return $this->hasOne('App\DocumentTrayType', 'id','document_tray_type_id');
    }
}
