<?php

namespace App\Models\Traits;

use App\Models\History;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

trait Historable
{
    public function histories(): MorphMany
    {
        return $this->morphMany(History::class, 'historable');
    }

    public function saveHistory(array $oldData): void
    {
        $userId = Auth::user()?->id;
        $history = new History(['old_data' => $oldData, 'user_id' => $userId]);
        $this->histories()->save($history);
    }

    public function save(array $options = [])
    {
        $old = $this->getOriginal();
        $model = parent::save($options);
        $this->saveHistory($old);
        return $model;
    }

}
