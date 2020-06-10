<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

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

    public function privilegesUsers($user_db){
        DB::statement("CREATE USER '$user_db'@'localhost' IDENTIFIED BY '';");

        DB::statement("GRANT SELECT ON wonderful_laravel.users TO '$user_db'@'localhost';");
        DB::statement("GRANT SELECT ON wonderful_laravel.user_status_orders TO '$user_db'@'localhost';");
        DB::statement("GRANT SELECT ON wonderful_laravel.status_orders TO '$user_db'@'localhost';");
        DB::statement("GRANT SELECT ON wonderful_laravel.process_orders TO '$user_db'@'localhost';");
        DB::statement("GRANT SELECT ON wonderful_laravel.orders TO '$user_db'@'localhost';");

        DB::statement("GRANT UPDATE ON wonderful_laravel.status_orders TO '$user_db'@'localhost';");
        DB::statement("GRANT SELECT ON wonderful_laravel.user_status_orders TO '$user_db'@'localhost';");
        DB::statement("FLUSH PRIVILEGES;");
    }

    public function privilegesUsersAdmins($user_db){
        DB::statement("CREATE USER '$user_db'@'localhost' IDENTIFIED BY '';");

        DB::statement("GRANT ALL PRIVILEGES ON wonderful_laravel.* TO '$user_db'@'localhost';");
        DB::statement("GRANT ALL PRIVILEGES ON payment_online.* TO '$user_db'@'localhost';");
        DB::statement("FLUSH PRIVILEGES;");
    }

    public function deleteUsersAndPrivileges($user_db)
    {
        DB::statement("DROP USER '$user_db'@'localhost';");
        DB::statement("FLUSH PRIVILEGES;");
    }
}
