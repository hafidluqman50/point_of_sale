<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\UuidInsert;

class User extends Authenticatable
{
    use UuidInsert;

    protected $table      = 'users';
    protected $primaryKey = 'id_users';
    public $timestamps    = false;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];
    
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function checkUsername($username)
    {
        $check  = self::where('username',$username)->count();

        $return = '';

        if ($check == 0) {
            $return = true;
        }
        else {
            $return = false;
        }

        return $return;
    }
}
