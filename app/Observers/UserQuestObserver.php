<?php

namespace App\Observers;

use App\Events\UserLeveledUp;
use App\Models\UserQuest;

class UserQuestObserver
{
    public function updated(UserQuest $userQuest)
    {
        if ($userQuest->wasChanged('completed_at') && $userQuest->isCompleted()) {
            if ($userQuest->user->quests()->completed()->count() == 20) {
                // TODO: Placeholder for achievement
            }

            $ding = $userQuest->user->getExperienceToLevelUp() <=$userQuest->quest->reward_xp;

            $userQuest->user->addExperience($userQuest->quest->reward_xp);
            $userQuest->user->addCoins($userQuest->quest->reward_coins);
            $userQuest->user->save();

            if ($ding) {
                UserLeveledUp::broadcast($userQuest->user);
            }
        }
    }
}
