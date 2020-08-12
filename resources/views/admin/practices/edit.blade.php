@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.practice.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.practices.update", [$practice->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="instructor_id">{{ trans('cruds.practice.fields.instructor') }}</label>
                    <select class="form-control select2 {{ $errors->has('instructor') ? 'is-invalid' : '' }}" name="instructor_id" id="instructor_id">
                        @foreach($instructors as $id => $instructor)
                            <option value="{{ $id }}" {{ ($practice->instructor ? $practice->instructor->id : old('instructor_id')) == $id ? 'selected' : '' }}>{{ $instructor }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('instructor'))
                        <span class="text-danger">{{ $errors->first('instructor') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.practice.fields.instructor_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="date">{{ trans('cruds.practice.fields.date') }}</label>
                    <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $practice->date) }}">
                    @if($errors->has('date'))
                        <span class="text-danger">{{ $errors->first('date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.practice.fields.date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="reservations">{{ trans('cruds.practice.fields.reservation') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('reservations') ? 'is-invalid' : '' }}" name="reservations[]" id="reservations" multiple>
                        @foreach($reservations as $id => $reservation)
                            <option value="{{ $id }}" {{ (in_array($id, old('reservations', [])) || $practice->reservations->contains($id)) ? 'selected' : '' }}>{{ $reservation }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('reservations'))
                        <span class="text-danger">{{ $errors->first('reservations') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.practice.fields.reservation_helper') }}</span>
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