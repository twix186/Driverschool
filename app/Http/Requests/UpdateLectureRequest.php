<?php

namespace App\Http\Requests;

use App\Lecture;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateLectureRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('lecture_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'date'     => [
                'date_format:' . config('panel.date_format'),
                'nullable'],
            'audience' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
        ];
    }
}