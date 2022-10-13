<?php

namespace App\Models;

use App\Models\Traits\Uuidable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\UploadedFile;

class Submission extends Model
{
    use HasFactory, Uuidable;

    protected $guarded = [];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function addFile(UploadedFile $uploadedFile)
    {
        if($fileName = $uploadedFile->store($this->service->uuid)) {
            $this->attachments()->create([
                'path' => $fileName
            ]);
        }
    }
}
