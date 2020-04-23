<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function articles(){
        return $this->belongsToMany(Article::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function authorizeRole($role){
        if ($this->hasRole($role)){
            return true;
        }
//        abort(403,"nos estas autorizado");
    }

//    public function hasAnyRoles($roles){
//        if (is_array($roles)){
//            foreach ($roles as $role){
//                if ($this->hasRole($role)){
//                    return true;
//                }
//            }
//        }else {
//            if ($this->hasRole($roles)){
//                return true;
//            }
//        }
//        return false;
//    }

    public function hasRole($role){
        if ($this->role()->where('role',$role)->first()){
            return true;
        }
        return false;
    }
}
