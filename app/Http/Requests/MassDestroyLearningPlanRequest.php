<?php

namespace App\Http\Requests;

use App\LearningPlan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLearningPlanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('learning_plan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:learning_plans,id',
        ];
    }
}