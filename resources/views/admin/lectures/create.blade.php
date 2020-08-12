@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.lecture.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.lectures.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="group_id">{{ trans('cruds.lecture.fields.group') }}</label>
                    <select class="form-control select2 {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group_id" id="group_id">
                        @foreach($groups as $id => $group)
                            <option value="{{ $id }}" {{ old('group_id') == $id ? 'selected' : '' }}>{{ $group }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('group'))
                        <span class="text-danger">{{ $errors->first('group') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lecture.fields.group_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="lecturer_id">{{ trans('cruds.lecture.fields.lecturer') }}</label>
                    <select class="form-control select2 {{ $errors->has('lecturer') ? 'is-invalid' : '' }}" name="lecturer_id" id="lecturer_id">
                        @foreach($lecturers as $id => $lecturer)
                            <option value="{{ $id }}" {{ old('lecturer_id') == $id ? 'selected' : '' }}>{{ $lecturer }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('lecturer'))
                        <span class="text-danger">{{ $errors->first('lecturer') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lecture.fields.lecturer_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="subject_id">{{ trans('cruds.lecture.fields.subject') }}</label>
                    <select class="form-control select2 {{ $errors->has('subject') ? 'is-invalid' : '' }}" name="subject_id" id="subject_id">
                        @foreach($subjects as $id => $subject)
                            <option value="{{ $id }}" {{ old('subject_id') == $id ? 'selected' : '' }}>{{ $subject }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('subject'))
                        <span class="text-danger">{{ $errors->first('subject') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lecture.fields.subject_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="date">{{ trans('cruds.lecture.fields.date') }}</label>
                    <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}">
                    @if($errors->has('date'))
                        <span class="text-danger">{{ $errors->first('date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lecture.fields.date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="time">{{ trans('cruds.lecture.fields.time') }}</label>
                    <input class="form-control {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" id="time" value="{{ old('time', '') }}">
                    @if($errors->has('time'))
                        <span class="text-danger">{{ $errors->first('time') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lecture.fields.time_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="audience">{{ trans('cruds.lecture.fields.audience') }}</label>
                    <input class="form-control {{ $errors->has('audience') ? 'is-invalid' : '' }}" type="number" name="audience" id="audience" value="{{ old('audience', '') }}" step="1">
                    @if($errors->has('audience'))
                        <span class="text-danger">{{ $errors->first('audience') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lecture.fields.audience_helper') }}</span>
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