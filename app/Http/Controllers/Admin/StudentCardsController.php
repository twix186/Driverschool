<?php

namespace App\Http\Controllers\Admin;

use App\Car;
use App\Group;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStudentCardRequest;
use App\Http\Requests\StoreStudentCardRequest;
use App\Http\Requests\UpdateStudentCardRequest;
use App\StudentCard;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentCardsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('student_card_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentCards = StudentCard::all();

        return view('admin.studentCards.index', compact('studentCards'));
    }

    public function create()
    {
        abort_if(Gate::denies('student_card_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = User::whereHas('roles', function($q){
            $q->where('title', 'Student');
        })->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $instructors = User::whereHas('roles', function($q){
            $q->where('title', 'Instructor');
        })->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $groups = Group::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cars = Car::all()->pluck('license_plate', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.studentCards.create', compact('students', 'instructors', 'groups', 'cars'));
    }

    public function store(StoreStudentCardRequest $request)
    {
        $studentCard = StudentCard::create($request->all());

        return redirect()->route('admin.student-cards.index');
    }

    public function edit(StudentCard $studentCard)
    {
        abort_if(Gate::denies('student_card_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = User::whereHas('roles', function($q){
            $q->where('title', 'Student');
        })->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $instructors = User::whereHas('roles', function($q){
            $q->where('title', 'Instructor');
        })->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $groups = Group::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cars = Car::all()->pluck('license_plate', 'id')->prepend(trans('global.pleaseSelect'), '');

        $studentCard->load('student', 'instructor', 'group', 'car');

        return view('admin.studentCards.edit', compact('students', 'instructors', 'groups', 'cars', 'studentCard'));
    }

    public function update(UpdateStudentCardRequest $request, StudentCard $studentCard)
    {
        $studentCard->update($request->all());

        return redirect()->route('admin.student-cards.index');
    }

    public function show(StudentCard $studentCard)
    {
        abort_if(Gate::denies('student_card_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentCard->load('student', 'instructor', 'group', 'car');

        return view('admin.studentCards.show', compact('studentCard'));
    }

    public function destroy(StudentCard $studentCard)
    {
        abort_if(Gate::denies('student_card_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentCard->delete();

        return back();
    }

}