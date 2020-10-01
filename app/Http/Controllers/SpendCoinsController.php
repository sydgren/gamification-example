<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpendCoinsRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class SpendCoinsController extends Controller
{
    public function __invoke(SpendCoinsRequest $request)
    {
        // TODO: Add whatever product or subscription from $request->product_id to the current user

        Auth::user()->subtractCoins($request->amount)->save();

        return UserResource::make(Auth::user());
    }
}
