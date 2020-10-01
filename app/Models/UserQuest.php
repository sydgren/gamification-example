<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserQuest extends Model
{
    protected $fillable = [
        'started_at',
        'completed_at',
    ];

    protected $dates = [
        'started_at',
        'completed_at',
    ];

    public function quest(): BelongsTo
    {
        return $this->belongsTo(Quest::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function objectives(): HasMany
    {
        return $this->hasMany(UserQuestObjective::class);
    }

    public function scopeIncomplete(Builder $query)
    {
        $query->whereNull('completed_at');
    }

    public function scopeCompleted(Builder $query)
    {
        $query->whereNotNull('completed_at');
    }

    public function isCompleted(): bool
    {
        return ! is_null($this->completed_at);
    }

    public function canComplete(): bool
    {
        return ! $this->isCompleted() && $this->objectives()->incomplete()->count() == 0;
    }

    public function complete(): bool
    {
        return $this->fill(['completed_at' => now()])->save();
    }
}
