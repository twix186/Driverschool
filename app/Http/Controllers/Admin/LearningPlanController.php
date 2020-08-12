<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLearningPlanRequest;
use App\Http\Requests\StoreLearningPlanRequest;
use App\Http\Requests\UpdateLearningPlanRequest;
use App\LearningPlan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LearningPlanController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('learning_plan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $learningPlans = LearningPlan::all();

        return view('admin.learningPlans.index', compact('learningPlans'));
    }

    public function create()
    {
        abort_if(Gate::denies('learning_plan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.learningPlans.create');
    }

    public function store(StoreLearningPlanRequest $request)
    {
        $learningPlan = LearningPlan::create($request->all());

        return redirect()->route('admin.learning-plans.index');
    }

    public function edit(LearningPlan $learningPlan)
    {
        abort_if(Gate::denies('learning_plan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.learningPlans.edit', compact('learningPlan'));
    }

    public function update(UpdateLearningPlanRequest $request, LearningPlan $learningPlan)
    {
        $learningPlan->update($request->all());

        return redirect()->route('admin.learning-plans.index');
    }

    public function show(LearningPlan $learningPlan)
    {
        abort_if(Gate::denies('learning_plan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.learningPlans.show', compact('learningPlan'));
    }

    public function destroy(LearningPlan $learningPlan)
    {
        abort_if(Gate::denies('learning_plan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $learningPlan->delete();

        return back();
    }

}