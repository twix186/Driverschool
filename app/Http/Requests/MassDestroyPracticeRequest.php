<?php

namespace App\Http\Requests;

use App\Practice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPracticeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('practice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:practices,id',
        ];
    }
}