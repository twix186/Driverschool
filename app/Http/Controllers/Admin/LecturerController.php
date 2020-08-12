<?php

namespace App\Http\Controllers\Admin;

use App\LecturesAttendance;
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

class LecturerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lecturer'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lectures = Lecture::where('lecturer_id', \Auth::user()->id)
            ->where('date','<=',Carbon::now()->addDays(7)->toDateString(),'and')
            ->where('date', '>=', Carbon::now()->toDateString())
            ->get();

        return view('admin.lecturer.check', compact('lectures'));
    }

    public function show($lecture_id)
    {
        $id = Lecture::where('id', $lecture_id)->pluck('group_id');

        $students_id = StudentCard::where('group_id', $id)->pluck('student_id');

        $group = Group::where('id',$id)->first();

        $lecture = Lecture::find($lecture_id);
        return view('admin.lecturer.studentscheck', compact('lecture','students_id', 'group'));
    }

    public function store(Request $request)
    {

        foreach ($request->except('_token','lecture') as $one){
            $keys = array_keys($one);
            $student_id = LecturesAttendance::create([ 'check' => $one[$keys[1]] ,'student_id' => $one[$keys[0]], 'date_of_lecture_id' => $request->get('lecture')]);
            }

        return redirect()->route('admin.lecturer.index');
    }

    public function create(Request $request)
    {
        $lectures = Lecture::where('lecturer_id',\Auth::user()->id)
            ->where('date','<=',Carbon::now()->endOfWeek(Carbon::SUNDAY)->toDateString(),'and')
            ->where('date', '>=', Carbon::now()->startOfWeek(Carbon::MONDAY)->toDateString())
            ->where('time','18:00')
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
        return view('admin.lecturer.schedule', compact('lectures', 'monday', 'currentdate'));
    }
}