@extends('layouts.admin')
@section('content')

    <div class="card">


        <div class="card-body">
            <form method="POST" action="{{ route("admin.exams.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="student_id">{{ trans('cruds.exam.fields.student') }}</label>
                    <select class="form-control select2 {{ $errors->has('student') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                        @foreach($students as $id => $student)
                            <option value="{{ $id }}" {{ old('student_id') == $id ? 'selected' : '' }}>{{ $student }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('student'))
                        <span class="text-danger">{{ $errors->first('student') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.exam.fields.student_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="date">{{ trans('cruds.exam.fields.date') }}</label>
                    <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}">
                    @if($errors->has('date'))
                        <span class="text-danger">{{ $errors->first('date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.exam.fields.date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>Этап экзамена</label>
                    <select class="form-control select2{{ $errors->has('exam_type') ? 'is-invalid' : '' }}" name="exam_type" id="exam_type">
                        <option value disabled {{ old('exam_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Exam::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" >{{ $label }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">{{ trans('cruds.reservation.fields.status_helper') }}</span>
                </div>
                <div class="form-group">
                    <div class="form-check {{ $errors->has('result') ? 'is-invalid' : '' }}">
                        <input type="hidden" name="result" value="0">
                        <input class="form-check-input" type="checkbox" name="result" id="result" value="1" {{ old('result', 0) == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="theory">Сдан</label>
                    </div>
                    @if($errors->has('result'))
                        <span class="text-danger">{{ $errors->first('result') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.exam.fields.theory_helper') }}</span>
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