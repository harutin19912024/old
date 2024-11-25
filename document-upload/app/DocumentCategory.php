<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentCategory extends Model
{
    protected $table = 'document_category';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'sea_id', 'lea_id', 'ses_id', 'name', 'description'
    ];

    public function resolveChildRouteBinding($childType, $value, $field)
    {
        // TODO: Implement resolveChildRouteBinding() method.
    }
}
