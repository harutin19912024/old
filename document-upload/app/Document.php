<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'document';
    const CREATED_AT = 'uploaded_date';
    const UPDATED_AT = 'modified_date';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'sea_id', 'lea_id', 'ses_id',
        'name', 'description', 'document_category_id',
        'size', 'is_encrypted', 'location', 'tags', 'uploaded_date',
        'modified_date', 'uploaded_by'
    ];

    public function resolveChildRouteBinding($childType, $value, $field)
    {
        // TODO: Implement resolveChildRouteBinding() method.
    }

    public function documentCategory()
    {
        return $this->hasOne('App\DocumentCategory', 'id','document_category_id');
    }

}
