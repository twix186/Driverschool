<?php

namespace App\Http\Requests;

use App\StudentCard;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStudentCardRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('student_card_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:student_cards,id',
        ];
    }
}