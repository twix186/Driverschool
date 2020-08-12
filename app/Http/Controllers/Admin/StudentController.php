<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use Carbon\Carbon;
use App\Group;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPracticeRequest;
use App\Http\Requests\StorePracticeRequest;
use App\Http\Requests\UpdatePracticeRequest;
use App\Lecture;
use App\Practice;
use App\Reservation;
use App\StudentCard;
use App\LearningPlan;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    public function index(Request $request)
    {

        abort_if(Gate::denies('student'), Response::HTTP_FORBIDDEN, '403 Forbidden');



        $instructor_id = StudentCard::whereHas('student', function ($q) {
            $q->where('student_id', \Auth::user()->id);
        })->pluck('instructor_id');

        $instructor = User::find($instructor_id)->first();

        $practices = Practice::where('instructor_id', $instructor_id)->get();
        $monday = Carbon::now()->startOfWeek(Carbon::MONDAY)->subDays(7);
        $currentdate = Carbon::now()->startOfWeek(Carbon::MONDAY)->subDays(7);

        if ($request->input('date') == 1) {
            $monday = Carbon::now()->startOfWeek(Carbon::MONDAY)->addDays(7);
            $currentdate = Carbon::now()->startOfWeek(Carbon::MONDAY)->addDays(7);

        }
        else{

        }

        return view('admin.student.practice', compact('practices', 'instructor', 'monday', 'currentdate'));
    }

    public function show($id)
    {
        $user = \Auth::user();

        $reservation = Reservation::find($id);
        $reservation->update(['status' => 'approved', 'student_id' => $user->id]);

        return redirect()->route('admin.student.index');
    }

    public function edit($id)
    {
        $reservation = Reservation::find($id);

        $reservation->update(['status' => 'created', 'student_id' => null]);

        return redirect()->route('admin.student.index');
    }

    public function create()
    {
        $students_group_id = StudentCard::whereHas('student', function ($q) {
            $q->where('student_id', \Auth::user()->id);
        })->pluck('group_id');

        $lectures = Lecture::where('group_id',$students_group_id)->where('date', '<', Carbon::now()->toDateString())->orderBy('date', 'desc')->get();
        $lectures_amount = Lecture::where('group_id',$students_group_id)->where('date', '<', Carbon::now()->toDateString())->count();

        $learning_plan_id = Group::where('id', $students_group_id)->pluck('learning_plan_id');
        $hours = LearningPlan::where('id', $learning_plan_id)->first(['lecture_hours', 'practice_hours']);

        $practices =Practice::whereHas('reservations', function ($q) {
            $q->where('student_id', \Auth::user()->id);
        })->get();

        $practices_amount =Practice::whereHas('reservations', function ($q) {
            $q->where('student_id', \Auth::user()->id)->where('status', 'finished');
        })->count();


        return view('admin.student.attendance', compact('lectures', 'hours', 'practices', 'lectures_amount', 'practices_amount'));
    }
}