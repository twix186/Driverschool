@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.reservation.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.reservations.update", [$reservation->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="student_id">{{ trans('cruds.reservation.fields.student') }}</label>
                    <select class="form-control select2 {{ $errors->has('student') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                        @foreach($students as $id => $student)
                            <option value="{{ $id }}" {{ ($reservation->student ? $reservation->student->id : old('student_id')) == $id ? 'selected' : '' }}>{{ $student }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('student'))
                        <span class="text-danger">{{ $errors->first('student') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.reservation.fields.student_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="time">{{ trans('cruds.reservation.fields.time') }}</label>
                    <input class="form-control {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" id="time" value="{{ old('time', $reservation->time) }}">
                    @if($errors->has('time'))
                        <span class="text-danger">{{ $errors->first('time') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.reservation.fields.time_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.reservation.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Reservation::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status', $reservation->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('status'))
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.reservation.fields.status_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection