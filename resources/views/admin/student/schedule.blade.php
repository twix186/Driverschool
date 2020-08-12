@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-header">
                    <form class="form-inline float-left" method="GET">
                        <div class="form-group">
                            <label for="date">Расписание на: </label>
                            <select class="form-control select" name="date" id="date">
                                <option value="0" >Текущая неделя</option>
                                <option value="1" >Следующая неделя</option>
                            </select>
                            <button class="btn btn-dark" type="submit">Показать</button>
                        </div>
                    </form>

                </div>
                <div class="card-body table-responsive p-0">

                    <div class="timetable">
                        <div class="week-names">
                            <div>Понедельник<br>{{$monday->format('Y-m-d')}}</div>
                            <div>Вторник<br>{{$monday->addDays(1)->format('Y-m-d')}}</div>
                            <div>Среда<br>{{$monday->addDays(1)->format('Y-m-d')}}</div>
                            <div>Четверг<br>{{$monday->addDays(1)->format('Y-m-d')}}</div>
                            <div>Пятница<br>{{$monday->addDays(1)->format('Y-m-d')}}</div>
                            <div>Суббота<br>{{$monday->addDays(1)->format('Y-m-d')}}</div>
                        </div>
                        <div class="time-interval">
                            <div>10:00 - 12:00</div>
                            <div>18:00 - 20:00</div>
                        </div>
                        <div class="content">
                            <?php $newdate = $currentdate?>
                            @for($i = 0; $i < 6; $i++)
                                @if($lecture = App\Lecture::where('date', $newdate)->where('time', '10:00')->where('group_id',$students_group_id)->first())
                                    <div>
                                        <div class="accent-orange-gradient">
                                            <table class="">
                                                <tr>
                                                    <td>Лектор: {{$lecture->lecturer->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Аудитория: {{$lecture->audience}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <div></div>
                                @endif
                                <?php $newdate->addDays(1)?>
                            @endfor

                            {{------------}}
                            <?php $newdate->subDays(6)?>

                            @for($i = 0; $i < 6; $i++)
                                @if($lecture = App\Lecture::where('date', $newdate)->where('time', '18:00')->where('group_id',$students_group_id)->first())
                                    <div>
                                        <div class="accent-orange-gradient">
                                            <table class="">
                                                <tr>
                                                    <td>Лектор: {{$lecture->lecturer->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Аудитория: {{$lecture->audience}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <div></div>
                                @endif
                                <?php $newdate->addDays(1)?>
                            @endfor

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
