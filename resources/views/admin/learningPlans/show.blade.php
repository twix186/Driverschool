@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.learningPlan.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.learning-plans.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.learningPlan.fields.id') }}
                        </th>
                        <td>
                            {{ $learningPlan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.learningPlan.fields.name') }}
                        </th>
                        <td>
                            {{ $learningPlan->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.learningPlan.fields.lecture_hours') }}
                        </th>
                        <td>
                            {{ $learningPlan->lecture_hours }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.learningPlan.fields.practice_hours') }}
                        </th>
                        <td>
                            {{ $learningPlan->practice_hours }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.learning-plans.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection