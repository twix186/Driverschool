@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.car.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.cars.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="license_plate">{{ trans('cruds.car.fields.license_plate') }}</label>
                    <input class="form-control {{ $errors->has('license_plate') ? 'is-invalid' : '' }}" type="text" name="license_plate" id="license_plate" value="{{ old('license_plate', '') }}">
                    @if($errors->has('license_plate'))
                        <span class="text-danger">{{ $errors->first('license_plate') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.car.fields.license_plate_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="brand">{{ trans('cruds.car.fields.brand') }}</label>
                    <input class="form-control {{ $errors->has('brand') ? 'is-invalid' : '' }}" type="text" name="brand" id="brand" value="{{ old('brand', '') }}">
                    @if($errors->has('brand'))
                        <span class="text-danger">{{ $errors->first('brand') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.car.fields.brand_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="model">{{ trans('cruds.car.fields.model') }}</label>
                    <input class="form-control {{ $errors->has('model') ? 'is-invalid' : '' }}" type="text" name="model" id="model" value="{{ old('model', '') }}">
                    @if($errors->has('model'))
                        <span class="text-danger">{{ $errors->first('model') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.car.fields.model_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="gearbox_type">{{ trans('cruds.car.fields.gearbox_type') }}</label>
                    <input class="form-control {{ $errors->has('gearbox_type') ? 'is-invalid' : '' }}" type="text" name="gearbox_type" id="gearbox_type" value="{{ old('gearbox_type', '') }}">
                    @if($errors->has('gearbox_type'))
                        <span class="text-danger">{{ $errors->first('gearbox_type') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.car.fields.gearbox_type_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="year_of_issue">{{ trans('cruds.car.fields.year_of_issue') }}</label>
                    <input class="form-control {{ $errors->has('year_of_issue') ? 'is-invalid' : '' }}" type="number" name="year_of_issue" id="year_of_issue" value="{{ old('year_of_issue', '') }}" step="1">
                    @if($errors->has('year_of_issue'))
                        <span class="text-danger">{{ $errors->first('year_of_issue') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.car.fields.year_of_issue_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="category_id">{{ trans('cruds.learningPlan.fields.category') }}</label>
                    <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id">
                        @foreach($categories as $id => $category)
                            <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('category'))
                        <span class="text-danger">{{ $errors->first('category') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.learningPlan.fields.category_helper') }}</span>
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