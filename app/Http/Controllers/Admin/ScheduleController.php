<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPracticeRequest;
use App\Http\Requests\StorePracticeRequest;
use App\Http\Requests\UpdatePracticeRequest;
use App\Practice;
use App\Lecture;
use App\Reservation;
use App\User;
use App\StudentCard;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $students_group_id = StudentCard::whereHas('student', function ($q) {
            $q->where('student_id', \Auth::user()->id);
        })->pluck('group_id');


        $lectures = Lecture::where('group_id',$students_group_id)
            ->where('date','<=',Carbon::now()->endOfWeek(Carbon::SUNDAY)->toDateString(),'and')
            ->where('date', '>=', Carbon::now()->startOfWeek(Carbon::MONDAY)->toDateString())
            ->OrderBy('date','Asc')
            ->get();

        $monday = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $currentdate = Carbon::now()->startOfWeek(Carbon::MONDAY);

        if ($request->input('date') == 1) {
            $monday = Carbon::now()->startOfWeek(Carbon::MONDAY)->addDays(7);
            $currentdate = Carbon::now()->startOfWeek(Carbon::MONDAY)->addDays(7);
        }
        else{

        }

        return view('admin.student.schedule', compact('lectures', 'students_group_id', 'monday', 'currentdate'));
    }
}