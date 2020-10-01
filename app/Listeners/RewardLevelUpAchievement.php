<?php

namespace App\Listeners;

use App\Events\UserLeveledUp;
use App\Models\Achievement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RewardLevelUpAchievement
{
    public function handle(UserLeveledUp $event)
    {
        // TODO: Eliminate street fighter indentation
        if ($event->level >= 5) {
            if (! $event->user->achievements()->whereName('Veteran')->exists()) {
                if ($achievement = Achievement::whereName('Veteran')->first()) {
                    $event->user
                        ->achievements()
                        ->attach(
                            Achievement::whereName('Veteran')->first(),
                            ['achieved_at' => now()]
                        );
                }
            }
        }
    }
}
