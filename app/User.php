<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'moto', 'avatar', 'avatar_back'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $defaultAvatar = 'image/avatar/avatar.jpg';
    public static $defaultAvatarBack = 'image/avatar/avatar2.jpg';
    public static $defaultMoto = 'If god exists, why does he always keep silent?';

    protected static function getUserInfo($id)
    {
        $user = static::find($id);

        $is_admin = (Auth::check() && (Auth::user()->id == $user->id)) ?: false;
        $avatar = Auth::check() ? (Auth::user()->avatar ?: static::$defaultAvatar) : '';
        $user_avatar = $user->avatar ?: static::$defaultAvatar;
        $user_avatar_back = $user->avatar_back ?: static::$defaultAvatarBack;
        $moto = $user->moto ?: static::$defaultMoto;

        return [
            'id' => $id,
            'is_admin' => $is_admin,
            'avatar' => $avatar,
            'user_avatar' => $user_avatar,
            'user_avatar_back' => $user_avatar_back,
            'moto' => $moto
        ];
    }

    protected static function userExist($id)
    {
        if(static::find($id)) return true;

        return false;
    }
}
