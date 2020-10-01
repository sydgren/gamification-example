<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserQuestResource extends JsonResource
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
            'quest' => QuestResource::make($this->quest),
            'objectives' => UserQuestObjectiveResource::collection($this->objectives),
            'can_complete' => $this->canComplete(),
            'started_at' => $this->started_at,
            'completed_at' => $this->completed_at,
        ];
    }
}
