<?php

namespace App\Models;

use App\Models\Traits\Uuidable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

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

    public function scopePending(Builder $builder)
    {
        $builder->where('status', 'pending');
    }

    public function submittions()
    {
        return $this->hasMany(Submission::class);
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
