<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Practice;
use App\Exam;
use App\Group;
use App\StudentCard;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;

class ManagerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access_lite'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::whereHas('roles', function($q){
            $q->where('title', '!=','Admin');
        })->get();

        return view('admin.manager.index', compact('users'));
    }

    public function create()
    {

        $users = User::whereHas('roles', function($q){
            $q->where('title', 'Student' );
        })->get();

        return view('admin.manager.studentslist', compact('users'));
    }

    public function show(Request $request)
    {
        $chosengroup = '';

        if ($request->input('group')) {
            $students = StudentCard::where('group_id', $_REQUEST['group'])->get('student_id');
            $exams = Exam::select('student_id')->groupBy('student_id')->whereIn('student_id', $students)->get();
            $chosengroup = Group::where('id', $_REQUEST['group'])->first();
            $count = Exam::select('student_id')->whereIn('student_id', $students)->get()->count();
        } else {
            $exams = Exam::select('student_id')->groupBy('student_id')->get();
            $count = Exam::select('student_id')->get()->count();

        }

        $groups =Group::all();


return view('admin.manager.examAttempts', compact('exams','groups', 'chosengroup', 'count'));
    }

}