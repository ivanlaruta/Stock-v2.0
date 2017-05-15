<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'usuario' => 'admin',
            'password' => bcrypt('12345'),
            'email'=> 'admin@toyosa.com',
            'nombre'=> 'ADMIN',
            'paterno'=> 'PRINCIPAL',
            ]);
    }
}
