<?php

namespace App\Models\Traits;

trait Updated
{
    public static function bootUpdated(): void
    {
        static::updating(function ($model){
            if(!$model->isDirty('updated_at')){
                $model->updated_at = now();
                $model->updated_by = auth()->id();
            }
        });
    }
}
