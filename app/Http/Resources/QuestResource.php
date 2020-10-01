<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestResource extends JsonResource
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
            'description' => $this->description,
            'reward_xp' => (int) $this->reward_xp,
            'reward_coins' => (int) $this->reward_coins,
            'objectives' => ObjectiveResource::collection($this->objectives),
        ];
    }
}
