<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestResource;
use App\Models\Quest;

class QuestsController extends Controller
{
    public function __invoke()
    {
        return QuestResource::collection(Quest::all());
    }
}
