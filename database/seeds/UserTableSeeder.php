<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        user 1
        DB::table('users')->insert([
            'role_id' => 1,
            'ci' => '3553534',
            'first_name' => 'Sara',
            'second_name' => 'Sara',
            'last_name' => 'Mamani',
            'mother_last_name' => 'Calle',
            'gender' => 'F',
            'phone_number' => 76891219,
            'birthday' => date("Y-m-d H:i:s"),
            'user' => 'saracalle3553534',
            'password' => bcrypt('3553534'),
            'active' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

//        user 2
        DB::table('users')->insert([
            'role_id' => 2,
            'ci' => '3553534',
            'first_name' => 'Raul',
            'second_name' => 'Raul',
            'last_name' => 'Nanavarro',
            'mother_last_name' => 'Portuguez',
            'gender' => 'M',
            'phone_number' => 76891219,
            'birthday' => date("Y-m-d H:i:s"),
            'user' => 'raulportuguez3553534',
            'password' => bcrypt('3553534'),
            'active' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

//        user 3
        DB::table('users')->insert([
            'role_id' => 3,
            'ci' => '3553534',
            'first_name' => 'Julio',
            'second_name' => 'Pedro',
            'last_name' => 'Gomez',
            'mother_last_name' => 'Perales',
            'gender' => 'M',
            'phone_number' => 76891219,
            'birthday' => date("Y-m-d H:i:s"),
            'user' => 'julio'.'@gmail.com',
            'password' => bcrypt('12345678'),
            'active' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

//        user 4
        DB::table('users')->insert([
            'role_id' => 4,
            'ci' => '3553534',
            'first_name' => 'Pedro',
            'second_name' => 'Lucas',
            'last_name' => 'Martinez',
            'mother_last_name' => 'Perez',
            'gender' => 'M',
            'phone_number' => 76891219,
            'birthday' => date("Y-m-d H:i:s"),
            'user' => 'pedro'.'@gmail.com',
            'password' => bcrypt('12345678'),
            'active' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

//        user 5
        DB::table('users')->insert([
            'role_id' => 5,
            'ci' => '3553534',
            'first_name' => 'Josh',
            'second_name' => 'Josh',
            'last_name' => 'Gomez',
            'mother_last_name' => 'Perez',
            'gender' => 'M',
            'phone_number' => 76891219,
            'birthday' => date("Y-m-d H:i:s"),
            'user' => 'joshperez3553534',
            'password' => bcrypt('3553534'),
            'active' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

//        user 6
        DB::table('users')->insert([
            'role_id' => 5,
            'ci' => '3553534',
            'first_name' => 'Drake',
            'second_name' => 'Drake',
            'last_name' => 'Perales',
            'mother_last_name' => 'Martinez',
            'gender' => 'M',
            'phone_number' => 76891219,
            'birthday' => date("Y-m-d H:i:s"),
            'user' => 'drakemartinez3553534',
            'password' => bcrypt('3553534'),
            'active' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
