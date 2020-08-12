@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th> Дата</th>
                        <th> Время</th>
                        <th> Группа</th>
                        <th> Тема</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lectures as $lecture)
                        <tr>
                            <td>{{\Carbon\Carbon::parse($lecture->date)->format('Y-m-d')}}</td>
                            <td>{{$lecture->time}}</td>
                            <td>{{$lecture->group->name}}</td>
                            <td>{{$lecture->subject->name}}</td>
                            <td>
                                <a class="btn btn-xs btn-default"
                                   href="{{ route('admin.lecturer.show',$lecture->id) }}">
                                    Посещаемость
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection