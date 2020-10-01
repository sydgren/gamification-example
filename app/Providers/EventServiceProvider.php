<?php

namespace App\Providers;

use App\Events\UserLeveledUp;
use App\Listeners\RewardLevelUpAchievement;
use App\Models\UserQuest;
use App\Observers\UserQuestObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserLeveledUp::class => [
            RewardLevelUpAchievement::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        UserQuest::observe(UserQuestObserver::class);
    }
}
