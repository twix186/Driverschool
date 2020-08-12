@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
<label>Создание расписания лекций</label>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ url("/newschedule") }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="lecturers">Выберите лектора(ов)</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('lecturer') ? 'is-invalid' : '' }}" name="lecturers[]" id="lecturers" multiple required>
                        @foreach($lecturers as $id => $lecturer)
                            <option value="{{ $id }}" >{{ $lecturer }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('lecturer'))
                        <span class="text-danger">{{ $errors->first('lecturer') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lecture.fields.lecturer_helper') }}</span>
                </div>

                <div class="form-group">
                    <label for="groups">Выберите группу(ы)</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 " name="groups[]" id="groups" multiple required>
                        @foreach($groups as $id => $group)
                            <option value="{{ $id }}" >{{ $group }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('lecturer'))
                        <span class="text-danger">{{ $errors->first('lecturer') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lecture.fields.lecturer_helper') }}</span>
                </div>

                <div class="form-group">
                    <button class="btn btn-secondary" type="submit">
                        Составить расписание
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection