@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.practice.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.practices.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.practice.fields.id') }}
                        </th>
                        <td>
                            {{ $practice->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.practice.fields.instructor') }}
                        </th>
                        <td>
                            {{ $practice->instructor->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.practice.fields.date') }}
                        </th>
                        <td>
                            {{ $practice->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.practice.fields.reservation') }}
                        </th>
                        <td>
                            @foreach($practice->reservations as $key => $reservation)
                                <span class="label label-info">{{ $reservation->time }}</span>
                            @endforeach
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.practices.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection