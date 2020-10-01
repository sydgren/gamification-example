<?php

namespace App\Http\Controllers;

use App\Http\Requests\GiftCoinsRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class GiftCoinsController extends Controller
{
    public function __invoke(GiftCoinsRequest $request, User $user)
    {
        if (! $user->exists) {
            throw new UnprocessableEntityHttpException('Recipient does not exist');
        }

        return DB::transaction(function () use ($request, $user) {
            Auth::user()->sendCoinsTo($user, $request->amount);

            return UserResource::make(Auth::user());
        });
    }
}
