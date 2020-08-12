@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.exam.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.exams.update", [$exam->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="student_id">{{ trans('cruds.exam.fields.student') }}</label>
                    <select class="form-control select2 {{ $errors->has('student') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                        @foreach($students as $id => $student)
                            <option value="{{ $id }}" {{ ($exam->student ? $exam->student->id : old('student_id')) == $id ? 'selected' : '' }}>{{ $student }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('student'))
                        <span class="text-danger">{{ $errors->first('student') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.exam.fields.student_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="date">{{ trans('cruds.exam.fields.date') }}</label>
                    <input class="form-control datetime {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $exam->date) }}">
                    @if($errors->has('date'))
                        <span class="text-danger">{{ $errors->first('date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.exam.fields.date_helper') }}</span>
                </div>
                <div class="form-group">
                    <div class="form-check {{ $errors->has('theory') ? 'is-invalid' : '' }}">
                        <input type="hidden" name="theory" value="0">
                        <input class="form-check-input" type="checkbox" name="theory" id="theory" value="1" {{ $exam->theory || old('theory', 0) === 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="theory">{{ trans('cruds.exam.fields.theory') }}</label>
                    </div>
                    @if($errors->has('theory'))
                        <span class="text-danger">{{ $errors->first('theory') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.exam.fields.theory_helper') }}</span>
                </div>
                <div class="form-group">
                    <div class="form-check {{ $errors->has('training_ground') ? 'is-invalid' : '' }}">
                        <input type="hidden" name="training_ground" value="0">
                        <input class="form-check-input" type="checkbox" name="training_ground" id="training_ground" value="1" {{ $exam->training_ground || old('training_ground', 0) === 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="training_ground">{{ trans('cruds.exam.fields.training_ground') }}</label>
                    </div>
                    @if($errors->has('training_ground'))
                        <span class="text-danger">{{ $errors->first('training_ground') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.exam.fields.training_ground_helper') }}</span>
                </div>
                <div class="form-group">
                    <div class="form-check {{ $errors->has('town') ? 'is-invalid' : '' }}">
                        <input type="hidden" name="town" value="0">
                        <input class="form-check-input" type="checkbox" name="town" id="town" value="1" {{ $exam->town || old('town', 0) === 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="town">{{ trans('cruds.exam.fields.town') }}</label>
                    </div>
                    @if($errors->has('town'))
                        <span class="text-danger">{{ $errors->first('town') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.exam.fields.town_helper') }}</span>
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