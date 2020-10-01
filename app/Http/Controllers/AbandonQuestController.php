<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class AbandonQuestController extends Controller
{
    public function __invoke(Quest $quest)
    {
        return DB::transaction(function () use ($quest) {
            if (! Auth::user()->isOnQuest($quest)) {
                throw new UnprocessableEntityHttpException('User is not on that quest');
            }

            Auth::user()->abandonQuest($quest);

            return response(null, 204);
        });
    }
}
