@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.studentCard.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.student-cards.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="student_id">{{ trans('cruds.studentCard.fields.student') }}</label>
                    <select class="form-control select2 {{ $errors->has('student') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                        @foreach($students as $id => $student)
                            <option value="{{ $id }}" {{ old('student_id') == $id ? 'selected' : '' }}>{{ $student }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('student'))
                        <span class="text-danger">{{ $errors->first('student') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.studentCard.fields.student_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="instructor_id">{{ trans('cruds.studentCard.fields.instructor') }}</label>
                    <select class="form-control select2 {{ $errors->has('instructor') ? 'is-invalid' : '' }}" name="instructor_id" id="instructor_id">
                        @foreach($instructors as $id => $instructor)
                            <option value="{{ $id }}" {{ old('instructor_id') == $id ? 'selected' : '' }}>{{ $instructor }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('instructor'))
                        <span class="text-danger">{{ $errors->first('instructor') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.studentCard.fields.instructor_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="group_id">{{ trans('cruds.studentCard.fields.group') }}</label>
                    <select class="form-control select2 {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group_id" id="group_id">
                        @foreach($groups as $id => $group)
                            <option value="{{ $id }}" {{ old('group_id') == $id ? 'selected' : '' }}>{{ $group }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('group'))
                        <span class="text-danger">{{ $errors->first('group') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.studentCard.fields.group_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="car_id">{{ trans('cruds.studentCard.fields.car') }}</label>
                    <select class="form-control select2 {{ $errors->has('car') ? 'is-invalid' : '' }}" name="car_id" id="car_id">
                        @foreach($cars as $id => $car)
                            <option value="{{ $id }}" {{ old('car_id') == $id ? 'selected' : '' }}>{{ $car }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('car'))
                        <span class="text-danger">{{ $errors->first('car') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.studentCard.fields.car_helper') }}</span>
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