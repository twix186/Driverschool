<?php

namespace App\Http\Requests;

use App\Group;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreGroupRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'date_of_start' => [
                'date_format:' . config('panel.date_format'),
                'nullable'],
            'date_of_end'   => [
                'date_format:' . config('panel.date_format'),
                'nullable'],
        ];
    }
}