<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPracticeRequest;
use App\Http\Requests\StorePracticeRequest;
use App\Http\Requests\UpdatePracticeRequest;
use App\Practice;
use App\Reservation;
use App\StudentCard;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstructorController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('instructor'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $date = $request->query('date');

        if ($date) {
            $practices = Practice::where('instructor_id', \Auth::user()->id)->whereDate('date', $date)->get();
        } else {
            $practices = Practice::where('instructor_id', \Auth::user()->id)->whereDate('date', date('Y-m-d'))->get();
        }

        $practicesdate = Practice::where('instructor_id', \Auth::user()->id)->where('date','<=',Carbon::now()->addDays(7)->toDateString(),'and')->where('date', '>=', Carbon::now()->toDateString())->OrderBy('date','Asc')->get(['date']);

        return view('admin.instructor.index', compact('practices', 'date', 'practicesdate'));
    }

    public function show($id)
    {
        $reservation = Reservation::find($id);
        $reservation->update(['status' => 'finished']);

        return redirect()->route('admin.instructor.index');
    }

    public function edit($id)
    {
        $reservation = Reservation::find($id);
        $reservation->update(['status' => 'approved']);

        return redirect()->route('admin.instructor.index');
    }

}