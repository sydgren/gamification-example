<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class UserQuestObjective extends Model
{
    use HasFactory;

    protected $fillable = [
        'progress',
    ];

    protected $casts = [
        'progress' => 'int',
    ];

    public function objective(): BelongsTo
    {
        return $this->belongsTo(Objective::class);
    }

    public function scopeIncomplete(Builder $query)
    {
        $query->whereHas(
            'objective',
            fn ($q) => $q->where('goal', '>', DB::raw('user_quest_objectives.progress'))
        );
    }
}
