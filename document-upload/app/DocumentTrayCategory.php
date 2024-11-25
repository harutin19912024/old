<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentTrayCategory extends Model
{
    protected $table = 'document_tray_category';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'sea_id', 'lea_id', 'ses_id', 'document_tray_id', 'category_id', 'is_required'
    ];

    public function resolveChildRouteBinding($childType, $value, $field)
    {
        // TODO: Implement resolveChildRouteBinding() method.
    }
}
