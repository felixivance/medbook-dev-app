<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            'firstName' => 'Super',
            'lastName' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'userType' => 'admin',
        ]);
    }
}
