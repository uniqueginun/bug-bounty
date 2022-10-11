<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait Uuidable
{
    public static function bootUuidable()
    {
        static::creating(function($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
}