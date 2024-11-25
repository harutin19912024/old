<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentTrayType extends Model
{
    protected $table = 'document_tray_type';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'description','is_encrypted'
    ];

    public function resolveChildRouteBinding($childType, $value, $field)
    {
        // TODO: Implement resolveChildRouteBinding() method.
    }
}
