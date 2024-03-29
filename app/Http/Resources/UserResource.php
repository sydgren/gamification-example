<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'experience' => (int) $this->experience,
            'experience_to_level_up' => (int) $this->getExperienceToLevelUp(),
            'level' => $this->getLevel(),
            'coins' => (int) $this->coins,
            'quests' => UserQuestResource::collection($this->quests()->incomplete()->get()),
            'completed_quests' => UserQuestResource::collection($this->quests()->completed()->get()),
            'achievements' => AchievementResource::collection($this->achievements()->withPivot('achieved_at')->get())
        ];
    }
}
