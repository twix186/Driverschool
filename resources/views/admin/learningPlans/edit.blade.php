@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.learningPlan.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.learning-plans.update", [$learningPlan->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name">{{ trans('cruds.learningPlan.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $learningPlan->name) }}">
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.learningPlan.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="lecture_hours">{{ trans('cruds.learningPlan.fields.lecture_hours') }}</label>
                    <input class="form-control {{ $errors->has('lecture_hours') ? 'is-invalid' : '' }}" type="number" name="lecture_hours" id="lecture_hours" value="{{ old('lecture_hours', $learningPlan->lecture_hours) }}" step="1">
                    @if($errors->has('lecture_hours'))
                        <span class="text-danger">{{ $errors->first('lecture_hours') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.learningPlan.fields.lecture_hours_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="practice_hours">{{ trans('cruds.learningPlan.fields.practice_hours') }}</label>
                    <input class="form-control {{ $errors->has('practice_hours') ? 'is-invalid' : '' }}" type="number" name="practice_hours" id="practice_hours" value="{{ old('practice_hours', $learningPlan->practice_hours) }}" step="1">
                    @if($errors->has('practice_hours'))
                        <span class="text-danger">{{ $errors->first('practice_hours') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.learningPlan.fields.practice_hours_helper') }}</span>
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