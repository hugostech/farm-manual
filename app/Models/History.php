<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $casts = [
        'old_data' => 'array',
    ];

    protected $fillable = [
        'old_data',
        'historable_id',
        'historable_type',
        'user_id',
    ];

    public function historable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function editor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Convert the old data to a model
     */
    public function convertToModel(): Model
    {
        $model = new $this->historable_type();
        $model->fill($this->old_data);
        return $model;
    }
}
