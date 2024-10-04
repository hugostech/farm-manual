<?php

namespace App\Models\Traits;

use App\Models\History;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

trait Historable
{
    protected static $recordHistory = true;

    public function histories(): MorphMany
    {
        return $this->morphMany(History::class, 'historable');
    }

    public function saveHistory(array $oldData): void
    {
        if (empty($oldData)) {
            return;
        }
        if (self::$recordHistory) {
            $userId = Auth::user()?->id;
            $history = new History(['old_data' => $oldData, 'user_id' => $userId]);
            $this->histories()->save($history);
        }
    }

    public function save(array $options = [])
    {
        $old = $this->getOriginal();
        $model = parent::save($options);
        $this->saveHistory($old);
        return $model;
    }

    public static function withoutRecordHistory(callable $callback)
    {
        self::$recordHistory = false;
        try {
            $callback();
        } finally {
            self::$recordHistory = true;
        }
    }

    public function restoreHistory(History $history): void
    {

        $this->fill($history->old_data);
        $this->save();
    }

}
