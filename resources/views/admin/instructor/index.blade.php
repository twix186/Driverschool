@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Ваши занятия на {{\Carbon\Carbon::parse($date)->format('Y-m-d') ?? date('Y-m-d')}}
                        <form class="form-inline float-right" method="GET">
                            <div class="form-group">
                                <label>Дата</label>
                                <select class="form-control select" name="date" id="date">
                                    @foreach($practicesdate as $key => $practice)
                                        <option value="{{ $practice->date }}" >{{ \Carbon\Carbon::parse($practice->date)->format('Y-m-d') }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-dark" type="submit">Поиск</button>
                            </div>
                        </form>
                    </h3>

                </div>
                <!-- /.card-header -->

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover ">
                        <thead>
                        <tr>
                            <th>{{ trans('cruds.reservation.fields.time') }}</th>
                            <th>Курсант</th>
                            <th>Телефон</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($practices as $key => $practice)
                            @foreach($practice->reservations as $key => $item)
                                <tr data-entry-id="{{ $practice->id }}">
                                    <td>
                                        {{ $item->time }}
                                    </td>
                                    <td>
                                        {{\App\User::find($item->student_id)->name ?? ''}}
                                    </td>
                                    <td>
                                        {{\App\User::find($item->student_id)->phone ?? ''}}
                                    </td>
                                    <td>
                                        @if($item->status == 'finished')
                                            <a class="btn btn-xs btn-outline-danger" href="{{ route("admin.instructor.edit", [$item->id]) }}">
                                                Отменить
                                            </a>
                                        @elseif($item->student_id != null)
                                            <a class="btn btn-xs btn-primary" href="{{ route("admin.instructor.update", [$item->id]) }}">
                                                Завершить занятие
                                            </a>
                                            @else
                                            Никто не записан
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection