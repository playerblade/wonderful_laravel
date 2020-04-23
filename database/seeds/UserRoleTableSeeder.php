<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        seeder 1
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

//        seeder 2
        DB::table('role_user')->insert([
            'role_id' => 2,
            'user_id' => 2,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

//        seeder 3
        DB::table('role_user')->insert([
            'role_id' => 3,
            'user_id' => 3,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

//        seeder 4
        DB::table('role_user')->insert([
            'role_id' => 4,
            'user_id' => 4,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        // seeder 5
        DB::table('role_user')->insert([
            'role_id' => 5,
            'user_id' => 5,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        // seeder 5
        DB::table('role_user')->insert([
            'role_id' => 5,
            'user_id' => 6,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
