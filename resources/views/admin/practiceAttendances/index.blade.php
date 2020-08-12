@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">

            <form class="form-inline float-left" method="GET">
                <div class="form-group">
                    <label>Группа</label>
                    <select class="form-control select2" name="group" id="group" placeholder="Выберите группу">
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Дата</label>
                    <input class="form-control date" type="text" name="date2" id="date2" value="" placeholder="Выберите дату">
                    <button class="btn btn-dark" type="submit">Поиск</button>
                </div>
            </form>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover">
                    <thead align="center">
                    <tr>
                        <th style="vertical-align: middle;" rowspan="2">Курсант</th>
                        <th colspan="2">Теоритические занятия</th>
                        <th colspan="2">Практические занятия</th>
                        <th colspan="2">Процент посещаемости</th>
                    </tr>
                    <tr>
                        <th>Посещения</th>
                        <th>Всего</th>
                        <th>Посещения</th>
                        <th>Всего</th>
                        <th>Теория</th>
                        <th>Практика</th>
                    </tr>
                    </thead>
                    <tbody align="center">
                    <? $count_theory = 0;
                    $count_practice = 0;?>
                    @foreach($students as $student)
                        <tr>
                            <td align="left" width="290">
                                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="nav-item ">
                                    <a class="nav-link nav-dropdown-toggle" href="#">

                                        <p>
                                            {{$student->name}}
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <div class="tabs">
                                                    <input id="tab1" type="radio" name="tabs" checked>
                                                    <label for="tab1" title="Вкладка ">Лекции</label>
                                                    <input id="tab2" type="radio" name="tabs">
                                                    <label for="tab2" title="Вкладка ">Вождение</label>
                                                    <section id="content-tab1">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th> Дата </th>
                                                                <th> Время </th>
                                                                <th> Дисциплина </th>
                                                                <th> Лектор </th>
                                                                <th> Посещение </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($lectures_amount as $lecture)
                                                                <tr>
                                                                    <td>{{\Carbon\Carbon::parse($lecture->date)->format('Y-m-d')}}</td>
                                                                    <td>{{$lecture->time}}</td>
                                                                    <td>{{$lecture->subject->name}}</td>
                                                                    <td>{{$lecture->lecturer->name}}</td>
                                                                    <td>+</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>

                                                    </section>
                                                    <section id="content-tab2">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th> Дата </th>
                                                                <th> Время </th>
                                                                <th> Посещение </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach(\App\Practice::whereHas('reservations', function ($q) use ($student) {$q->where('student_id', $student->id);})->where('date', '<', \Carbon\Carbon::now()->toDateString())->get() as $practice)
                                                                @foreach($practice->reservations->where('student_id', $student->id) as $reservation)
                                                                    <tr>
                                                                        <td>{{\Carbon\Carbon::parse($practice->date)->format('Y-m-d')}}</td>
                                                                        <td>{{$reservation->time}}</td>
                                                                        <td>{{$reservation->status == 'finished' ? '+' : '-'}}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </section>
                                                </div>
                                            </li>
                                    </ul>
                                </li>
                                </ul>
                            </td>
                            <td>{{$t = \App\LecturesAttendance::where('student_id', $student->id)->where('check', true)->count()}}</td>
                            <td>{{$lectures_amount->count()}}</td>
                            <td>{{$p = \App\Reservation::where('student_id', $student->id)->where('status', 'finished')->count()}}</td>
                            <td>{{$planp = \App\Practice::whereHas('reservations', function ($q) use ($student) {$q->where('student_id', $student->id);})->where('date', '<', \Carbon\Carbon::now()->toDateString())->count()}}</td>
                            <td>{{round($t * 100 / $lectures_amount->count())}}<?$count_theory += round($t * 100 / $lectures_amount->count())?></td>
                            <td>{{round($p * 100 / $planp)}}<?$count_practice += round($p * 100 / $planp)?></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td align="left" colspan="5">Группа</td>
                        <td>{{round($count_theory / $students->count())}}</td>
                        <td>{{round($count_practice / $students->count())}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            });
            $('.datatable-LecturesAttendance:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        })

    </script>
@endsection
