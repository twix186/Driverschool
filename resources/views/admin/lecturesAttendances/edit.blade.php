@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.lecturesAttendance.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.lectures-attendances.update", [$lecturesAttendance->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="student_id">{{ trans('cruds.lecturesAttendance.fields.student') }}</label>
                    <select class="form-control select2 {{ $errors->has('student') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                        @foreach($students as $id => $student)
                            <option value="{{ $id }}" {{ ($lecturesAttendance->student ? $lecturesAttendance->student->id : old('student_id')) == $id ? 'selected' : '' }}>{{ $student }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('student'))
                        <span class="text-danger">{{ $errors->first('student') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lecturesAttendance.fields.student_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="date_of_lecture_id">{{ trans('cruds.lecturesAttendance.fields.date_of_lecture') }}</label>
                    <select class="form-control select2 {{ $errors->has('date_of_lecture') ? 'is-invalid' : '' }}" name="date_of_lecture_id" id="date_of_lecture_id">
                        @foreach($date_of_lectures as $id => $date_of_lecture)
                            <option value="{{ $id }}" {{ ($lecturesAttendance->date_of_lecture ? $lecturesAttendance->date_of_lecture->id : old('date_of_lecture_id')) == $id ? 'selected' : '' }}>{{ \Carbon\Carbon::parse(strtotime($date_of_lecture))->format('Y-m-d') }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('date_of_lecture'))
                        <span class="text-danger">{{ $errors->first('date_of_lecture') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lecturesAttendance.fields.date_of_lecture_helper') }}</span>
                </div>
                <div class="form-group">
                    <div class="form-check {{ $errors->has('check') ? 'is-invalid' : '' }}">
                        <input type="hidden" name="check" value="0">
                        <input class="form-check-input" type="checkbox" name="check" id="check" value="1" {{ $lecturesAttendance->check || old('check', 0) === 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="check">{{ trans('cruds.lecturesAttendance.fields.check') }}</label>
                    </div>
                    @if($errors->has('check'))
                        <span class="text-danger">{{ $errors->first('check') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lecturesAttendance.fields.check_helper') }}</span>
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