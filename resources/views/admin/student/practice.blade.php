@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <label>Ваш {{ trans('cruds.practice.fields.instructor') }}:</label>
                    {{ $instructor->name}} {{ $instructor->phone}}
                </h3>
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
            <!-- /.card-header -->

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
                        <div>9:00 - 11:00</div>
                        <div>11:00 - 13:00</div>
                        <div>15:00 - 17:00</div>
                        <div>17:00 - 19:00</div>
                    </div>
                    <div class="content">
                        <?php $newdate = $currentdate?>

                            @for($i = 0; $i < 6; $i++)
                                @if($reservation = App\Practice::where('date' , $newdate)->where('instructor_id', $instructor->id)->first())
                                    <?php $item = $reservation->reservations->where('time', '9:00')->where('student_id', \Auth::user()->id)->first()?>
                                    @if($item)
                                        <div class="accent-orange-gradient">
                                            <table class="">
                                                <tr>
                                                    <td>Время: {{$item->time}}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        @if($item->student_id == \Auth::user()->id)
                                                            <a class="btn btn-xs btn-outline-light" href="{{ route("admin.student.edit", $item->id) }}">
                                                                Отменить занятие
                                                            </a>

                                                        @else
                                                            <a class="btn btn-xs btn-primary" href="{{ route("admin.student.update", $item->id) }}">
                                                                Записаться
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    @else<div></div>
                                    @endif
                                @else
                                    <div></div>
                                @endif
                                <?php $newdate->addDays(1)?>
                            @endfor

                        {{------------}}
                            <?php $newdate->subDays(6)?>
                            @for($i = 0; $i < 6; $i++)
                                @if($reservation = App\Practice::where('date' , $newdate)->where('instructor_id', $instructor->id)->first())
                                    <?php $item = $reservation->reservations->where('time', '11:00')->where('student_id', \Auth::user()->id)->first()?>
                                    @if($item)
                                        <div class="accent-orange-gradient">
                                        <table class="">
                                            <tr>
                                                <td>Время: {{$item->time}}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @if($item->student_id == \Auth::user()->id)
                                                        <a class="btn btn-xs btn-outline-light" href="{{ route("admin.student.edit", $item->id) }}">
                                                            Отменить занятие
                                                        </a>

                                                    @else
                                                        <a class="btn btn-xs btn-primary" href="{{ route("admin.student.update", $item->id) }}">
                                                            Записаться
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                        @else<div></div>
                                    @endif
                                @else
                                    <div></div>
                                @endif
                                <?php $newdate->addDays(1)?>
                            @endfor
                            {{------------}}
                            <?php $newdate->subDays(6)?>
                            @for($i = 0; $i < 6; $i++)
                                @if($reservation = App\Practice::where('date' , $newdate)->where('instructor_id', $instructor->id)->first())
                                    <?php $item = $reservation->reservations->where('time', '15:00')->where('student_id', \Auth::user()->id)->first()?>
                                    @if($item)
                                        <div class="accent-orange-gradient">
                                            <table class="">
                                                <tr>
                                                    <td>Время: {{$item->time}}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        @if($item->student_id == \Auth::user()->id)
                                                            <a class="btn btn-xs btn-outline-light" href="{{ route("admin.student.edit", $item->id) }}">
                                                                Отменить занятие
                                                            </a>

                                                        @else
                                                            <a class="btn btn-xs btn-primary" href="{{ route("admin.student.update", $item->id) }}">
                                                                Записаться
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    @else<div></div>
                                    @endif
                                @else
                                    <div></div>
                                @endif
                                <?php $newdate->addDays(1)?>
                            @endfor
                            {{------------}}
                            <?php $newdate->subDays(6)?>
                            @for($i = 0; $i < 6; $i++)
                                @if($reservation = App\Practice::where('date' , $newdate)->where('instructor_id', $instructor->id)->first())
                                    <?php $item = $reservation->reservations->where('time', '17:00')->where('student_id', \Auth::user()->id)->first();
                                    $item1 = $reservation->reservations->where('time', '17:00')->where('status','created')->first();?>
                                    @if($item)
                                        <div class="accent-orange-gradient">
                                            <table class="">
                                                <tr>
                                                    <td>Время: {{$item->time}}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                            <a class="btn btn-xs btn-outline-light" href="{{ route("admin.student.edit", $item->id) }}">
                                                                Отменить занятие
                                                            </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    @elseif($item1)
                                            <div class="accent-green-gradient">
                                                <table class="">
                                                    <tr>
                                                        <td>Время: {{$item1->time}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                                <a class="btn btn-xs btn-outline-light" href="{{ route("admin.student.update", $item1->id) }}">
                                                                    Записаться
                                                                </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        @else
                                        <div></div>
                                    @endif
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