@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.group.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.groups.update", [$group->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name">{{ trans('cruds.group.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $group->name) }}">
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.group.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="date_of_start">{{ trans('cruds.group.fields.date_of_start') }}</label>
                    <input class="form-control date {{ $errors->has('date_of_start') ? 'is-invalid' : '' }}" type="text" name="date_of_start" id="date_of_start" value="{{ old('date_of_start', $group->date_of_start) }}">
                    @if($errors->has('date_of_start'))
                        <span class="text-danger">{{ $errors->first('date_of_start') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.group.fields.date_of_start_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="date_of_end">{{ trans('cruds.group.fields.date_of_end') }}</label>
                    <input class="form-control date {{ $errors->has('date_of_end') ? 'is-invalid' : '' }}" type="text" name="date_of_end" id="date_of_end" value="{{ old('date_of_end', $group->date_of_end) }}">
                    @if($errors->has('date_of_end'))
                        <span class="text-danger">{{ $errors->first('date_of_end') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.group.fields.date_of_end_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="learning_plan_id">{{ trans('cruds.group.fields.learning_plan') }}</label>
                    <select class="form-control select2 {{ $errors->has('learning_plan') ? 'is-invalid' : '' }}" name="learning_plan_id" id="learning_plan_id">
                        @foreach($learning_plans as $id => $learning_plan)
                            <option value="{{ $id }}" {{ ($group->learning_plan ? $group->learning_plan->id : old('learning_plan_id')) == $id ? 'selected' : '' }}>{{ $learning_plan }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('learning_plan'))
                        <span class="text-danger">{{ $errors->first('learning_plan') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.group.fields.learning_plan_helper') }}</span>
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