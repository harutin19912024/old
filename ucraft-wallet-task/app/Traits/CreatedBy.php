<?php

namespace App\Traits;

/**
 * @method static creating(\Closure $param)
 */
trait CreatedBy
{
    public static function bootCreatedBy(): void
    {
        // updating created_by when model is created
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = auth()->user()->id;
            }
        });
    }
}
