<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'car_create',
            ],
            [
                'id'    => '18',
                'title' => 'car_edit',
            ],
            [
                'id'    => '19',
                'title' => 'car_show',
            ],
            [
                'id'    => '20',
                'title' => 'car_delete',
            ],
            [
                'id'    => '21',
                'title' => 'car_access',
            ],
            [
                'id'    => '22',
                'title' => 'category_create',
            ],
            [
                'id'    => '23',
                'title' => 'category_edit',
            ],
            [
                'id'    => '24',
                'title' => 'category_show',
            ],
            [
                'id'    => '25',
                'title' => 'category_delete',
            ],
            [
                'id'    => '26',
                'title' => 'category_access',
            ],
            [
                'id'    => '27',
                'title' => 'learning_plan_create',
            ],
            [
                'id'    => '28',
                'title' => 'learning_plan_edit',
            ],
            [
                'id'    => '29',
                'title' => 'learning_plan_show',
            ],
            [
                'id'    => '30',
                'title' => 'learning_plan_delete',
            ],
            [
                'id'    => '31',
                'title' => 'learning_plan_access',
            ],
            [
                'id'    => '32',
                'title' => 'group_create',
            ],
            [
                'id'    => '33',
                'title' => 'group_edit',
            ],
            [
                'id'    => '34',
                'title' => 'group_show',
            ],
            [
                'id'    => '35',
                'title' => 'group_delete',
            ],
            [
                'id'    => '36',
                'title' => 'group_access',
            ],
            [
                'id'    => '37',
                'title' => 'subject_create',
            ],
            [
                'id'    => '38',
                'title' => 'subject_edit',
            ],
            [
                'id'    => '39',
                'title' => 'subject_show',
            ],
            [
                'id'    => '40',
                'title' => 'subject_delete',
            ],
            [
                'id'    => '41',
                'title' => 'subject_access',
            ],
            [
                'id'    => '42',
                'title' => 'lecture_create',
            ],
            [
                'id'    => '43',
                'title' => 'lecture_edit',
            ],
            [
                'id'    => '44',
                'title' => 'lecture_show',
            ],
            [
                'id'    => '45',
                'title' => 'lecture_delete',
            ],
            [
                'id'    => '46',
                'title' => 'lecture_access',
            ],
            [
                'id'    => '47',
                'title' => 'lectures_attendance_create',
            ],
            [
                'id'    => '48',
                'title' => 'lectures_attendance_edit',
            ],
            [
                'id'    => '49',
                'title' => 'lectures_attendance_show',
            ],
            [
                'id'    => '50',
                'title' => 'lectures_attendance_delete',
            ],
            [
                'id'    => '51',
                'title' => 'lectures_attendance_access',
            ],
            [
                'id'    => '52',
                'title' => 'attendance_access',
            ],
            [
                'id'    => '53',
                'title' => 'student_card_create',
            ],
            [
                'id'    => '54',
                'title' => 'student_card_edit',
            ],
            [
                'id'    => '55',
                'title' => 'student_card_show',
            ],
            [
                'id'    => '56',
                'title' => 'student_card_delete',
            ],
            [
                'id'    => '57',
                'title' => 'student_card_access',
            ],
            [
                'id'    => '58',
                'title' => 'practice_create',
            ],
            [
                'id'    => '59',
                'title' => 'practice_edit',
            ],
            [
                'id'    => '60',
                'title' => 'practice_show',
            ],
            [
                'id'    => '61',
                'title' => 'practice_delete',
            ],
            [
                'id'    => '62',
                'title' => 'practice_access',
            ],
            [
                'id'    => '63',
                'title' => 'reservation_create',
            ],
            [
                'id'    => '64',
                'title' => 'reservation_edit',
            ],
            [
                'id'    => '65',
                'title' => 'reservation_show',
            ],
            [
                'id'    => '66',
                'title' => 'reservation_delete',
            ],
            [
                'id'    => '67',
                'title' => 'reservation_access',
            ],
            [
                'id'    => '68',
                'title' => 'exam_create',
            ],
            [
                'id'    => '69',
                'title' => 'exam_edit',
            ],
            [
                'id'    => '70',
                'title' => 'exam_show',
            ],
            [
                'id'    => '71',
                'title' => 'exam_delete',
            ],
            [
                'id'    => '72',
                'title' => 'exam_access',
            ],
            [
                'id'    => '73',
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => '74',
                'title' => 'student',
            ],
            [
                'id'    => '75',
                'title' => 'lecturer',
            ],
            [
                'id'    => '76',
                'title' => 'instructor',
            ],
        ];

        Permission::insert($permissions);
    }
}