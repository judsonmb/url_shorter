<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * This trait is used to automatically add a user_id to a model
 */
trait LoggedUser
{
    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', '=', 1);
        });

        static::creating(function ($model) {
            $model->user_id = 1;
        });

        static::updating(function ($model) {
            $model->user_id = 1;
        });

        static::deleting(function ($model) {
            $model->user_id = 1;
        });
    }
}
