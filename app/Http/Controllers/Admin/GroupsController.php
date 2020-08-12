<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGroupRequest;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\LearningPlan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::all();

        return view('admin.groups.index', compact('groups'));
    }

    public function create()
    {
        abort_if(Gate::denies('group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $learning_plans = LearningPlan::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.groups.create', compact('learning_plans'));
    }

    public function store(StoreGroupRequest $request)
    {
        $group = Group::create($request->all());

        return redirect()->route('admin.groups.index');
    }

    public function edit(Group $group)
    {
        abort_if(Gate::denies('group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $learning_plans = LearningPlan::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $group->load('learning_plan');

        return view('admin.groups.edit', compact('learning_plans', 'group'));
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($request->all());

        return redirect()->route('admin.groups.index');
    }

    public function show(Group $group)
    {
        abort_if(Gate::denies('group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $group->load('learning_plan');

        return view('admin.groups.show', compact('group'));
    }

    public function destroy(Group $group)
    {
        abort_if(Gate::denies('group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $group->delete();

        return back();
    }

}