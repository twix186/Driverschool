<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPracticeRequest;
use App\Http\Requests\StorePracticeRequest;
use App\Http\Requests\UpdatePracticeRequest;
use App\Practice;
use App\Reservation;
use App\User;
use App\Group;
use App\StudentCard;
use \Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PracticeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('practice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $practices = Practice::all();

        return view('admin.practices.index', compact('practices'));
    }

    public function create()
    {
        abort_if(Gate::denies('practice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instructors = User::whereHas('roles', function($q){
            $q->where('title', 'Instructor');
        })->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        $r = Reservation::create([ 'time' => '9:00' ]);
        $r1 = Reservation::create([ 'time' => '11:00' ]);
        $r2 = Reservation::create([ 'time' => '15:00' ]);
        $r3 = Reservation::create([ 'time' => '17:00' ]);


        $reservations = Reservation::where('status',null)->pluck('time', 'id');

        return view('admin.practices.create', compact('instructors', 'reservations'));
    }

    public function store(StorePracticeRequest $request)
    {

        foreach($request->reservations as $reservation){
            $reservation = Reservation::find($reservation);
            $reservation->update(['status' => 'created']);
        }

        $nullreservations = Reservation::where('status', null)->delete();;



        $practice = Practice::create($request->all());
        $practice->reservations()->sync($request->input('reservations', []));

        return redirect()->route('admin.practices.index');
    }

    public function edit(Practice $practice)
    {
        abort_if(Gate::denies('practice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instructors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reservations = Reservation::all()->pluck('time', 'id');

        $practice->load('instructor', 'reservations');

        return view('admin.practices.edit', compact('instructors', 'reservations', 'practice'));
    }

    public function update(UpdatePracticeRequest $request, Practice $practice)
    {
        $practice->update($request->all());
        $practice->reservations()->sync($request->input('reservations', []));

        return redirect()->route('admin.practices.index');
    }

    public function show($a)
    {

        $instructors = User::whereHas('roles', function($q){
            $q->where('title', 'Instructor');
        })->pluck('name', 'id');

        $groups = Group::all()->pluck('name', 'id');

        return view('admin.practices.createall', compact('instructors', 'groups'));
    }

    public function newpracticeschedule(Request $request)
    {
        $ourinstructors= User::whereIn('id', $request->instructors)->get();
        $date = Carbon::now()->startOfWeek(Carbon::MONDAY)->addDays(7);

        foreach($ourinstructors as $instructor){
            $reservations[] = [0 => null, 1 => null, 2 => null, 3 => null,];
            $students = StudentCard::where('instructor_id', $instructor->id)->whereIn('group_id', $request->groups)->pluck('student_id');
            $newdate = $date;
            for($i=0; $i <4;$i++) {
                $practice = Practice::create(['instructor_id' => $instructor->id, 'date' => $newdate]);
                $r1 = Reservation::create([ 'time' => '9:00', 'status' => 'approved', 'student_id' => $students[0]]);
                $reservations[0] = $r1->id;
                $r2 = Reservation::create([ 'time' => '11:00', 'status' => 'approved', 'student_id' => $students[1]]);
                $reservations[1] = $r2->id;
                $r3 = Reservation::create([ 'time' => '15:00', 'status' => 'approved',  'student_id' => $students[2]]);
                $reservations[2] = $r3->id;
                $r4 = Reservation::create([ 'time' => '17:00', 'status' => 'approved', 'student_id' => $students[3]]);
                $reservations[3] = $r4->id;
                $practice->reservations()->sync($reservations);
                $newdate->addDays(1);
            }

        }

        return redirect()->route('admin.practices.index');
    }

    public function destroy(Practice $practice)
    {
        abort_if(Gate::denies('practice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $practice->delete();

        return back();
    }

}