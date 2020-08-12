<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$Z67EiysC8PiD94gycFOFV.DJMou5zVB9f7MNTV2rofPkFDGGsdpdi',
                'remember_token' => null,
                'phone'          => '',
                'photo'          => '',
            ],
        ];

        User::insert($users);
    }
}