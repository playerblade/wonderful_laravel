<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MakerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('makers')->insert([
            'name' => 'Brasilera',
            'location' => 'Brsil c231',
            'phone_number' => 232321123,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('makers')->insert([
            'name' => 'Compania Japonesa',
            'location' => 'Japo 12112 c231',
            'phone_number' => 232321123,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('makers')->insert([
            'name' => 'Compania Boliviana',
            'location' => 'Bolivia C-123',
            'phone_number' => 232321123,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('makers')->insert([
            'name' => 'EEUU',
            'location' => 'Ca. Canasas',
            'phone_number' => 232321123,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('makers')->insert([
            'name' => 'Compania Coreana',
            'location' => 'Calle #23',
            'phone_number' => 232321123,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
