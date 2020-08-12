<?php

namespace App\Http\Requests;

use App\LecturesAttendance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateLecturesAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('lectures_attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
        ];
    }
}