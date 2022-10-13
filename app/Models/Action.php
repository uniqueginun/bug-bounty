<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Action extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        static::creating(function($action) {
            $action->user_id = Auth::id();
        });
    }

    public function actionable()
    {
        return $this->morphTo();
    }
}
