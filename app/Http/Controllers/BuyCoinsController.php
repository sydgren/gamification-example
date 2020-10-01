<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyCoinsRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class BuyCoinsController extends Controller
{
    public function __invoke(BuyCoinsRequest $request)
    {
        // TODO: Check $request->payment_intent_id against PSP to verify payment and amount of coins bought

        Auth::user()->addCoins($request->amount);

        return UserResource::make(Auth::user());
    }
}
