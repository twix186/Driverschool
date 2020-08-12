@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="tabs">
                        <input id="tab1" type="radio" name="tabs" checked>
                        <label for="tab1" title="Вкладка ">Лекции</label>
                        <input id="tab2" type="radio" name="tabs">
                        <label for="tab2" title="Вкладка ">Вождение</label>
                        <section id="content-tab1">
                                <div class="text-center">
                                <h3 class="card-title">Вы посетили: 3 из {{$lectures_amount}} лекций</h3>
                                    <h3 class="card-title">Всего: 36 лекций</h3>
                                </div>
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
                                    @foreach($lectures as $lecture)
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
                            <div class="text-center">
                                <h3 class="card-title">Ваш накат: {{$practices_amount*2}} из {{$hours->practice_hours}} часов</h3>
                            </div>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th> Дата </th>
                                        <th> Время </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($practices as $practice)
                                        @foreach($practice->reservations->where('status', 'finished')->where('student_id', \Auth::user()->id) as $reservation)
                                        <tr>
                                            <td>{{\Carbon\Carbon::parse($practice->date)->format('Y-m-d')}}</td>
                                            <td>{{$reservation->time}}</td>
                                        </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                        </section>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection