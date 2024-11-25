<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentTrayDocument extends Model
{
    protected $table = 'document_tray_document';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'sea_id', 'lea_id', 'ses_id', 'document_tray_id', 'document_id'
    ];

    public function resolveChildRouteBinding($childType, $value, $field)
    {
        // TODO: Implement resolveChildRouteBinding() method.
    }

    public function documentTray()
    {
        return $this->belongsTo('App\DocumentTray', 'document_tray_id');
    }

    public function document()
    {
        return $this->belongsTo('App\Document', 'document_id');
    }
}
