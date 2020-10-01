<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserQuestResource;
use App\Models\Quest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ValidateQuestController extends Controller
{
    public function __invoke(Quest $quest)
    {
        // TODO: Implement magic to update quest progress with data from a remote service

        return DB::transaction(function () use ($quest) {
            if (! Auth::user()->isOnQuest($quest)) {
                throw new UnprocessableEntityHttpException('User is not on that quest');
            }

            $userQuest = Auth::user()->getQuest($quest);

            $userQuest->objectives
                ->each(
                    fn ($objective) => $objective->update(['progress' => $objective->objective->goal])
                );

            return UserQuestResource::make($userQuest->fresh());
        });
    }
}
