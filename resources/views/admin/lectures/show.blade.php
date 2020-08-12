@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.lecture.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.lectures.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lecture.fields.id') }}
                        </th>
                        <td>
                            {{ $lecture->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lecture.fields.group') }}
                        </th>
                        <td>
                            {{ $lecture->group->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lecture.fields.lecturer') }}
                        </th>
                        <td>
                            {{ $lecture->lecturer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lecture.fields.subject') }}
                        </th>
                        <td>
                            {{ $lecture->subject->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lecture.fields.date') }}
                        </th>
                        <td>
                            {{ $lecture->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lecture.fields.time') }}
                        </th>
                        <td>
                            {{ $lecture->time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lecture.fields.audience') }}
                        </th>
                        <td>
                            {{ $lecture->audience }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.lectures.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection