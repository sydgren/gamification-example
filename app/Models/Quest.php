<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'reward_xp',
        'reward_coins',
    ];

    protected $attributes = [
        'reward_xp' => 0,
        'reward_coins' => 0,
    ];

    protected $casts = [
        'reward_xp' => 'int',
        'reward_coins' => 'int',
    ];

    public function objectives(): HasMany
    {
        return $this->hasMany(Objective::class);
    }
}
