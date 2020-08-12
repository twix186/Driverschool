<?php

namespace App\Http\Requests;

use App\StudentCard;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateStudentCardRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('student_card_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
        ];
    }
}