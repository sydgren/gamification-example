<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestRequest;
use App\Http\Resources\QuestResource;
use App\Models\Quest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateQuestController extends Controller
{
    public function __invoke(CreateQuestRequest $request)
    {
        return DB::transaction(function () use ($request) {
            /** @var Quest $quest */
            $quest = Quest::create($request->only([
                'name',
                'description',
                'reward_xp',
                'reward_coins',
            ]));

            foreach($request->objectives as $objective) {
                $quest->objectives()
                    ->create(
                        Arr::only($objective, [
                            'name',
                            'goal',
                        ])
                    );
            }

            return QuestResource::make($quest);
        });
    }
}
