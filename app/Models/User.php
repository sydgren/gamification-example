<?php

namespace App\Models;

use App\Concerns\HasCoins;
use App\Concerns\HasExperience;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;
    use HasRolesAndAbilities;
    use HasExperience;
    use HasCoins;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'experience',
        'coins',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'experience' => 'int',
        'experience' => 'int',
    ];

    public function quests(): HasMany
    {
        return $this->hasMany(UserQuest::class);
    }

    public function achievements(): BelongsToMany
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements');
    }

    public function startQuest(Quest $quest): UserQuest
    {
        $userQuest = $this->quests()->make(['started_at' => now()]);
        $userQuest->quest()->associate($quest);
        $userQuest->saveOrFail();

        $quest->objectives->each(
            fn ($objective) => $userQuest->objectives()
                ->make()
                ->objective()->associate($objective)
                ->saveOrFail()
        );

        return $userQuest;
    }

    public function getQuest(Quest $quest): UserQuest
    {
        return $this->quests()
            ->whereQuestId($quest->getKey())
            ->first();
    }

    public function abandonQuest(Quest $quest): self
    {
        $this->quests()
            ->whereQuestId($quest->getKey())
            ->delete();

        return $this;
    }

    public function completeQuest(Quest $quest): bool
    {
        $userQuest = $this->getQuest($quest);

        return $userQuest->complete();
    }

    public function canCompleteQuest(Quest $quest): bool
    {
        return $this->getQuest($quest)
            ->canComplete();
    }

    public function isOnQuest(Quest $quest): bool
    {
        return $this->quests()
            ->whereQuestId($quest->getKey())
            ->exists();
    }

    public function sendCoinsTo(User $user, int $amount): self
    {
        $this->subtractCoins($amount)->save();
        $user->addCoins($amount)->save();

        return $this;
    }
}
