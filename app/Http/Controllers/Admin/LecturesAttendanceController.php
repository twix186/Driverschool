<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLecturesAttendanceRequest;
use App\Http\Requests\StoreLecturesAttendanceRequest;
use App\Http\Requests\UpdateLecturesAttendanceRequest;
use App\Lecture;
use App\LecturesAttendance;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LecturesAttendanceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('lectures_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = User::whereHas('roles', function ($q) {
            $q->where('title', 'Student');
        })->get();

        if ($request->input('date1') && $request->input('date2') && $request->input('name')) {
            $lecturesAttendances = LecturesAttendance::whereHas('date_of_lecture', function ($q) {
                $q->where('date', '>=', \Carbon\Carbon::parse($_REQUEST['date1'])->format('Y-m-d'), 'and')
                    ->where('date', '<=', \Carbon\Carbon::parse($_REQUEST['date2'])->format('Y-m-d'));
            })->where('student_id', $_REQUEST['name'])->get();
        }
        elseif ($request->input('date1') && $request->input('date2')) {
            $lecturesAttendances = LecturesAttendance::whereHas('date_of_lecture', function ($q) {
                $q->where('date', '>=', \Carbon\Carbon::parse($_REQUEST['date1'])->format('Y-m-d'), 'and')
                    ->where('date', '<=', \Carbon\Carbon::parse($_REQUEST['date2'])->format('Y-m-d'));
            })->get();
        }
        elseif ($request->input('date1') && $request->input('name')) {
            $lecturesAttendances = LecturesAttendance::whereHas('date_of_lecture', function ($q) {
                $q->where('date', '>=', \Carbon\Carbon::parse($_REQUEST['date1'])->format('Y-m-d'));
            })->where('student_id', $_REQUEST['name'])->get();
        }
        elseif ($request->input('name') && $request->input('date2')) {
            $lecturesAttendances = LecturesAttendance::whereHas('date_of_lecture', function ($q) {
                $q->where('date', '<=', \Carbon\Carbon::parse($_REQUEST['date2'])->format('Y-m-d'));
            })->where('student_id', $_REQUEST['name'])->get();
        }
        elseif ($request->input('date1')) {
            $lecturesAttendances = LecturesAttendance::whereHas('date_of_lecture', function ($q) {
                $q->where('date', '>=', \Carbon\Carbon::parse($_REQUEST['date1'])->format('Y-m-d'));
            })->get();
        }
        elseif ($request->input('date2')) {
            $lecturesAttendances = LecturesAttendance::whereHas('date_of_lecture', function ($q) {
                $q->where('date', '<=', \Carbon\Carbon::parse($_REQUEST['date2'])->format('Y-m-d'));
            })->get();
        }
        elseif ($request->input('name')) {
            $lecturesAttendances = LecturesAttendance::where('student_id', $_REQUEST['name'])->get();
        }
        else {
            $lecturesAttendances = LecturesAttendance::all();
        }



        return view('admin.lecturesAttendances.index', compact('lecturesAttendances','students'));
    }

    public function create()
    {
        abort_if(Gate::denies('lectures_attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = User::whereHas('roles', function($q){
            $q->where('title', 'Student');
        })->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $date_of_lectures = Lecture::all()->pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lecturesAttendances.create', compact('students', 'date_of_lectures'));
    }

    public function store(StoreLecturesAttendanceRequest $request)
    {
        $lecturesAttendance = LecturesAttendance::create($request->all());

        return redirect()->route('admin.lectures-attendances.index');
    }

    public function edit(LecturesAttendance $lecturesAttendance)
    {
        abort_if(Gate::denies('lectures_attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $date_of_lectures = Lecture::all()->pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lecturesAttendance->load('student', 'date_of_lecture');

        return view('admin.lecturesAttendances.edit', compact('students', 'date_of_lectures', 'lecturesAttendance'));
    }

    public function update(UpdateLecturesAttendanceRequest $request, LecturesAttendance $lecturesAttendance)
    {
        $lecturesAttendance->update($request->all());

        return redirect()->route('admin.lectures-attendances.index');
    }

    public function show(LecturesAttendance $lecturesAttendance)
    {
        abort_if(Gate::denies('lectures_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lecturesAttendance->load('student', 'date_of_lecture');

        return view('admin.lecturesAttendances.show', compact('lecturesAttendance'));
    }

    public function destroy(LecturesAttendance $lecturesAttendance)
    {
        abort_if(Gate::denies('lectures_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lecturesAttendance->delete();

        return back();
    }

}