<?php

use App\User;
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
            'nick' => 'srios',
            'profile_id' => 1,
            'name' => 'Sergio Ríos',
            'email' => 'sergio@asdf.com',
            'password' => bcrypt('asdf1234'),
            'verified' => 1,
            'enabled' => '1'
        ]);

        DB::table('users')->insert([
            'nick' => 'eva12',
            'profile_id' => 2,
            'name' => 'Eva Álvarez',
            'email' => 'eva@asdf.com',
            'password' => bcrypt('asdf1234'),
            'verified' => 1,
            'enabled' => '1'
        ]);

        DB::table('users')->insert([
            'nick' => 'enriqueml',
            'profile_id' => 2,
            'name' => 'Enrique Múnoz',
            'email' => 'enriqueml@asdf.com',
            'password' => bcrypt('asdf1234'),
            'verified' => 1,
            'enabled' => '1'
        ]);
    }
}
