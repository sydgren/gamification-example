<?php

namespace App\Models;

use App\Concerns\HasCoins;
use App\Concerns\HasExperience;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;
    use HasRolesAndAbilities;
    use HasExperience;
    use HasCoins;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'experience',
        'coins',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'experience' => 'int',
        'experience' => 'int',
    ];

    public function giftCoins(User $recipient, int $coins)
    {
        $this->subtractCoins($coins);
        $recipient->addCoins($coins);

        $this->save();
        $recipient->save();
    }
}
