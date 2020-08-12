@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.lecturesAttendance.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.lectures-attendances.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lecturesAttendance.fields.id') }}
                        </th>
                        <td>
                            {{ $lecturesAttendance->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lecturesAttendance.fields.student') }}
                        </th>
                        <td>
                            {{ $lecturesAttendance->student->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lecturesAttendance.fields.date_of_lecture') }}
                        </th>
                        <td>
                            {{ $lecturesAttendance->date_of_lecture->date ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lecturesAttendance.fields.check') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $lecturesAttendance->check ? 'checked' : '' }}>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.lectures-attendances.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection