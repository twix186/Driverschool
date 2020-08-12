<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use \Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLectureRequest;
use App\Http\Requests\StoreLectureRequest;
use App\Http\Requests\UpdateLectureRequest;
use App\Lecture;
use App\Subject;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LecturesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lecture_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lectures = Lecture::all();

        return view('admin.lectures.index', compact('lectures'));
    }

    public function create()
    {
        abort_if(Gate::denies('lecture_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lecturers = User::whereHas('roles', function($q){
            $q->where('title', 'Lecturer');
        })->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subjects = Subject::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lectures.create', compact('groups', 'lecturers', 'subjects'));
    }

    public function store(StoreLectureRequest $request)
    {
        $lecture = Lecture::create($request->all());

        return redirect()->route('admin.lectures.index');
    }

    public function edit(Lecture $lecture)
    {
        abort_if(Gate::denies('lecture_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lecturers = User::whereHas('roles', function($q){
            $q->where('title', 'Lecturer');
        })->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subjects = Subject::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lecture->load('group', 'lecturer', 'subject');

        return view('admin.lectures.edit', compact('groups', 'lecturers', 'subjects', 'lecture'));
    }

    public function update(UpdateLectureRequest $request, Lecture $lecture)
    {
        $lecture->update($request->all());

        return redirect()->route('admin.lectures.index');
    }

    public function show($a)
    {
        abort_if(Gate::denies('lecture_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lecturers = User::whereHas('roles', function($q){
            $q->where('title', 'Lecturer');
        })->pluck('name', 'id');

        $groups = Group::all()->pluck('name', 'id');

        return view('admin.lectures.createall', compact('lecturers', 'groups'));
    }

    public function newschedule(Request $request)
    {
        abort_if(Gate::denies('lecture_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ourlecturers = User::whereIn('id', $request->lecturers)->get();
        $ourgroups = Group::whereIn('id', $request->groups)->get();
        $date = Carbon::now()->startOfWeek(Carbon::MONDAY)->addDays(7);

        for ($i = 0; $i < 6; $i++) {
            if ($date->format('l') == 'Monday' or $date->format('l') == 'Wednesday' or $date->format('l') == 'Friday') {
                if ((Lecture::where('subject_id', 1)->where('group_id', $ourgroups[0]->id)->count() * 2) < Subject::where('id', 1)->pluck('hours')[0]) {
                    $oursubject = Subject::where('id', 1)->first();

                } else {
                    $oursubject = Subject::where('id', 2)->first();
                }
                $lecture = Lecture::create(['date' => $date, 'audience' => 1, 'time' => '18:00', 'group_id' => $ourgroups[0]->id, 'lecturer_id' => $ourlecturers[0]->id, 'subject_id' => $oursubject->id]);
            } elseif ($date->format('l') == 'Saturday') {
                if ((Lecture::where('subject_id', 1)->where('group_id', $ourgroups[1]->id)->count() * 2) < Subject::where('id', 1)->pluck('hours')[0]) {
                    $oursubject = Subject::where('id', 1)->first();

                } else {
                    $oursubject = Subject::where('id', 2)->first();
                }
                $lecture = Lecture::create(['date' => $date, 'audience' => 1, 'time' => '10:00', 'group_id' => $ourgroups[1]->id, 'lecturer_id' => $ourlecturers[1]->id, 'subject_id' => $oursubject->id]);
            } elseif ($date->format('l') == 'Tuesday' or $date->format('l') == 'Thursday') {
                if ((Lecture::where('subject_id', 1)->where('group_id', $ourgroups[1]->id)->count() * 2) < Subject::where('id', 1)->pluck('hours')[0]) {
                    $oursubject = Subject::where('id', 1)->first();

                } else {
                    $oursubject = Subject::where('id', 2)->first();
                }
                $lecture = Lecture::create(['date' => $date, 'audience' => 1, 'time' => '18:00', 'group_id' => $ourgroups[1]->id, 'lecturer_id' => $ourlecturers[1]->id, 'subject_id' => $oursubject->id]);
            }
            $date->addDay();
        }

        return redirect()->route('admin.lectures.index');
    }

    public function destroy(Lecture $lecture)
    {
        abort_if(Gate::denies('lecture_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lecture->delete();

        return back();
    }

}