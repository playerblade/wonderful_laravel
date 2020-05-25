<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
//        'name', 'email', 'password',
        'role_id','ci','first_name','second_name','last_name','mother_last_name','gender','phone_number','birthday','email','password','active'
    ];

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

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function articles(){
        return $this->belongsToMany(Article::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function statusOrders(){
        return $this->belongsToMany(StatusOrder::class);
    }

    public function hasRole($role)
    {
        if ($this->role()->where('role',$role)->first()){
            return true;
        }
//        return "El rol no esta disponible";
        return false;
    }
}
