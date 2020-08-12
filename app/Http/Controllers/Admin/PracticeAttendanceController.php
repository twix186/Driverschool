<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use Carbon\Carbon;
use App\Group;
use App\Http\Controllers\Controller;
use App\Lecture;
use App\Practice;
use App\Reservation;
use App\StudentCard;
use App\LearningPlan;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PracticeAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $students = User::whereHas('roles', function ($q) {
            $q->where('title', 'Student');
        })->get();
        $group = Group::where('id', 1)->first();
        $groups =Group::all();
        $students_group_id = 1;

        $lectures_amount = Lecture::where('group_id',$students_group_id)->where('date', '<', Carbon::now()->toDateString())->get();

        $practices_amount =Practice::whereHas('reservations', function ($q) {
            $q->where('student_id', \Auth::user()->id)->where('status', 'finished');
        })->count();

        if ($request->input('group')) {
            $student_cards = StudentCard::where('group_id', $request->input('group'))->get('student_id');
            $students = User::whereIn('id', $student_cards)->get();
            $learning_plan_id = Group::where('id', $request->input('group'))->pluck('learning_plan_id');
            $hours = LearningPlan::where('id', $learning_plan_id)->first(['lecture_hours', 'practice_hours']);
            $group = Group::where('id', $request->input('group'))->first();
            $lectures_amount = Lecture::where('group_id',$group->id)->where('date', '<', Carbon::now()->toDateString())->get();


        }
        if ($request->input('date1') && $request->input('date2') && $request->input('name')) {
            $practices =Practice::whereHas('reservations', function($q){
                $q->where('student_id', $_REQUEST['name']);
            })->where('date', '>=', \Carbon\Carbon::parse($_REQUEST['date1'])->format('Y-m-d'), 'and')
                ->where('date', '<=', \Carbon\Carbon::parse($_REQUEST['date2'])->format('Y-m-d'))->get();
        }
        elseif ($request->input('date1') && $request->input('date2')) {
            $practices =Practice::where('date', '>=', \Carbon\Carbon::parse($_REQUEST['date1'])->format('Y-m-d'), 'and')
                ->where('date', '<=', \Carbon\Carbon::parse($_REQUEST['date2'])->format('Y-m-d'))->get();

        }
        elseif ($request->input('date1') && $request->input('name')) {
            $practices =Practice::whereHas('reservations', function($q){
                $q->where('student_id', $_REQUEST['name']);
            })->where('date', '>=', \Carbon\Carbon::parse($_REQUEST['date1'])->format('Y-m-d'))->get();

        }
        elseif ($request->input('name') && $request->input('date2')) {
            $practices =Practice::whereHas('reservations', function($q){
                $q->where('student_id', $_REQUEST['name']);
            })->where('date', '<=', \Carbon\Carbon::parse($_REQUEST['date2'])->format('Y-m-d'))->get();

        }
        elseif ($request->input('date1')) {
            $practices =Practice::where('date', '>=', \Carbon\Carbon::parse($_REQUEST['date1'])->format('Y-m-d'))->get();

        }
        elseif ($request->input('date2')) {
            $practices =Practice::where('date', '<=', \Carbon\Carbon::parse($_REQUEST['date2'])->format('Y-m-d'))->get();

        }
        elseif ($request->input('name')) {
            $practices =Practice::whereHas('reservations', function($q){
                $q->where('student_id', $_REQUEST['name']);
            })->get();
        }
        else {
            $practices =Practice::all();
        }


        return view('admin.practiceAttendances.index', compact('practices','students', 'groups', 'hours', 'lectures_amount', 'group'));
    }
}