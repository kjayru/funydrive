<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{
   
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','role_id','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function navigation(){
        return auth()->check() ? auth()->user()->role->name : 'guest';
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function socialAccount(){
        return $this->hasOne(UserSocialAccount::class);
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function registers()
    {
        return $this->hasMany('App\Register');
    }

    public function requirement()
    {
        return $this->hasMany('App\Requirement');
    }

    public function conversation(){
        return $this->hasMany('App\Conversation');
    }

    public function conversation2(){
        return $this->hasMany('App\Conversation');
    }

    public function conversationreply()
    {
        return $this->hasMany('App\ConversationReply');
    }
}
