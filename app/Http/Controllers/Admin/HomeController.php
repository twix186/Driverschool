<?php

namespace App\Http\Controllers\Admin;

use App\Exam;
use App\User;
use App\StudentCard;
use App\Group;
use App\Car;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class HomeController
{
    public function index()
    {

        $user = \Auth::user();
        $roles = $user->roles()->orderBy('title')->get();

        $student_card = StudentCard::whereHas('student', function ($q) {
            $user = \Auth::user();
            $q->where('student_id', 2);
        })->first();

        $group = Group::find($student_card->group_id);
        $car = Car::find($student_card->car_id);
        $instructor = User::find($student_card->instructor_id);

        return view('home', ['user' => $user, 'roles' => $roles, 'group' => $group, 'car' => $car, 'instructor' => $instructor]);

    }
}