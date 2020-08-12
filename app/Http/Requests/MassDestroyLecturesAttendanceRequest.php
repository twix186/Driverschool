<?php

namespace App\Http\Requests;

use App\LecturesAttendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLecturesAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('lectures_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:lectures_attendances,id',
        ];
    }
}