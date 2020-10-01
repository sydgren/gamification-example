<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserQuestResource;
use App\Models\Quest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class CompleteQuestController extends Controller
{
    public function __invoke(Quest $quest)
    {
        return DB::transaction(function () use ($quest) {
            if (! Auth::user()->isOnQuest($quest)) {
                throw new UnprocessableEntityHttpException('User is not on that quest');
            }

            if (! Auth::user()->canCompleteQuest($quest)) {
                throw new ConflictHttpException('Quest can not be completed');
            }

            Auth::user()->completeQuest($quest);

            return UserQuestResource::make(
                Auth::user()->getQuest($quest)
            );
        });
    }
}
