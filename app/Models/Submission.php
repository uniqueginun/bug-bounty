<?php

namespace App\Models;

use App\Models\Traits\HasActions;
use App\Models\Traits\Uuidable;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submission extends Model
{
    use HasFactory, Uuidable, HasActions;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date: Y/m/d'
    ];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getAttachPath(): string
    {
        return 'submittions/' . $this->service->uuid;
    }

    public function addFile(UploadedFile $uploadedFile)
    {

        if($fileName = $uploadedFile->store($this->getAttachPath())) {
            $this->attachments()->create([
                'path' => $fileName
            ]);
        }
    }
}
