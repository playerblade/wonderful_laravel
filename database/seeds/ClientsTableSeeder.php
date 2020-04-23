<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'ci' => '3553534',
            'first_name' => 'Josh',
            'second_name' => 'Josh',
            'last_name' => 'Gomez',
            'mother_last_name' => 'Perez',
            'gender' => 'F',
            'phone_number' => 76891219,
            'birthday' => date("Y-m-d H:i:s"),
            'email' => 'josh'.'@gmail.com',
            'password' => bcrypt('12345678'),
            'active' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

    }
}
