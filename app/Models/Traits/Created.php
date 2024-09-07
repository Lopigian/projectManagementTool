<?php

namespace App\Models\Traits;

trait Created
{
    public static function bootCreated(): void
    {
        static::creating(function ($model){
            if(!$model->isDirty('created_at')){
                $model->created_at = now();
                $model->created_by = auth()->id();
            }
        });
    }
}
