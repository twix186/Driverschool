<?php

namespace App\Http\Controllers\Admin;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExamRequest;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExamController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('exam_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exams = Exam::all();

        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
        abort_if(Gate::denies('exam_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = User::whereHas('roles', function($q){
            $q->where('title', 'Student');
        })->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.exams.create', compact('students'));
    }

    public function store(StoreExamRequest $request)
    {
        $exam = Exam::create($request->all());

        return redirect()->route('admin.exams.index');
    }

    public function edit(Exam $exam)
    {
        abort_if(Gate::denies('exam_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $exam->load('student');

        return view('admin.exams.edit', compact('students', 'exam'));
    }

    public function update(UpdateExamRequest $request, Exam $exam)
    {
        $exam->update($request->all());

        return redirect()->route('admin.exams.index');
    }

    public function show(Exam $exam)
    {
        abort_if(Gate::denies('exam_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exam->load('student');

        return view('admin.exams.show', compact('exam'));
    }

    public function destroy(Exam $exam)
    {
        abort_if(Gate::denies('exam_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exam->delete();

        return back();
    }

}