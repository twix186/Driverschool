@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.subject.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.subjects.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.subject.fields.id') }}
                        </th>
                        <td>
                            {{ $subject->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subject.fields.name') }}
                        </th>
                        <td>
                            {{ $subject->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.subject.fields.hours') }}
                        </th>
                        <td>
                            {{ $subject->hours }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.subjects.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection