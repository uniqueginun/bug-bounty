<?php

namespace App\Models\Traits;

use App\Models\Action;
use Illuminate\Support\Facades\Auth;

trait HasActions
{
    public function actions()
    {
        return $this->morphMany(Action::class, 'actionable');
    }

    public function makeAction(string $actionName, $notes)
    {
        $this->update([
            'status' => $actionName
        ]);

        $this->actions()->save(new Action([
            'action_name' => $actionName,
            'notes' => $notes ?? '',
            'user_id' => Auth::id()
        ]));
    }
}
