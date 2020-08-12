@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <label>Группа: </label>
                        {{$group->name}}
                    </h3>
                    <h3 class="card-title">
                        <label>Дата лекции</label>
                        {{\Carbon\Carbon::parse($lecture->date)->format('Y-m-d') ?? date('Y-m-d')}}</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <form method="POST" action="{{ route("admin.lecturer.store") }}" enctype="multipart/form-data">
                        @csrf
                        <input style="display:none" name="lecture" type="text" value="{{$lecture->id}}">
                        <table class="table table table-hover">
                            <thead>
                            <tr>
                                <th> Ф.И.О.</th>
                                <th> Отметка</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students_id as $student_id)
                                @foreach(\App\User::where('id', $student_id)->get() as $student)
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <input style="display:none;" name="{{$student->id}}check[id]" type="text" value="{{$student->id}}">
                                                {{$student->name}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input type="hidden" name="{{$student->id}}check[value]" value="0">
                                                <input class="form-check-input" type="checkbox" name="{{$student->id}}check[value]"
                                                       id="check" value="1" {{ old('check', 0) == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection