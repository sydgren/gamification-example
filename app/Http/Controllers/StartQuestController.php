<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserQuestResource;
use App\Models\Quest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class StartQuestController extends Controller
{
    public function __invoke(Quest $quest)
    {
        if (! $quest->exists) {
            throw new UnprocessableEntityHttpException('Quest not found');
        }

        return DB::transaction(function () use ($quest) {
            if (Auth::user()->isOnQuest($quest)) {
                throw new UnprocessableEntityHttpException('User is already on that quest');
            }

            return UserQuestResource::make(
                Auth::user()
                    ->startQuest($quest)
            );
        });
    }
}
