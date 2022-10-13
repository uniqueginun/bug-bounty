<?php

namespace App\Models;

use App\Models\Traits\Uuidable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, Uuidable;

    protected $guarded = [];

    protected $casts = [
        'links' => 'json'
    ];

    protected $hidden = [
        'id',
    ];

    protected $appends = ['short_description'];

    public function scopePending(Builder $builder)
    {
        $builder->where('status', 'pending');
    }

    /**
     * Get the short description.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function shortDescription(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => str($attributes['description'])->limit(150)->toString(),
        );
    }

    /**
     * Get the capitalized name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function productName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str($value)->title()->toString(),
        );
    }

    public function submittions()
    {
        return $this->hasMany(Submission::class);
    }

    public function approvedSubmittions()
    {
        return $this->hasMany(Submission::class)->where('status', 'approved');
    }

    public function actions()
    {
        return $this->morphMany(Action::class, 'actionable');
    }

    public function makeAction(string $actionName, $notes)
    {
        $this->update([
            'status' => $actionName
        ]);

        $this->actions()->create([
            'actuin_name' => $actionName,
            'notes' => $notes
        ]);
    }

    public function submitReport(string $details, UploadedFile $uploadedFile)
    {
        $submittion = $this->submittions()->create([
            'details' => $details,
            'user_id' => Auth::id()
        ]);

        $submittion->addFile($uploadedFile);
    }
}
