<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
            ],
            [
                'id'    => 2,
                'title' => 'Manager',
            ],
            [
                'id'    => 3,
                'title' => 'Student',
            ],
            [
                'id'    => 4,
                'title' => 'Instructor',
            ],
            [
                'id'    => 5,
                'title' => 'Lecturer',
            ],
        ];

        Role::insert($roles);
    }
}