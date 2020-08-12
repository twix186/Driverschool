<?php

namespace App\Http\Requests;

use App\LearningPlan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreLearningPlanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('learning_plan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'lecture_hours'  => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'practice_hours' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
        ];
    }
}