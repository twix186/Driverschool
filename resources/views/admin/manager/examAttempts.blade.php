@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form-inline" method="GET">
                <div class="form-group">
                    <label>Группа</label>
                    <select class="form-control select2" name="group" id="group" placeholder="Выберите группу">
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" >{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Дата</label>
                    <input class="form-control date" type="text" name="date1" id="date1" value="" placeholder="Выберите дату">
                </div>
                <button class="btn btn-dark" type="submit">Поиск</button>
            </form>
            <br>
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover">
                    <thead style="text-align: center;">
                    <tr>
                        <th style="vertical-align: middle;" rowspan="3">Курсант</th>
                        <th colspan="6">Этап экзамена</th>
                        <th style="vertical-align: middle;" rowspan="3">Итого попыток</th>

                    </tr>
                    <tr>
                        <th colspan="2">Теория</th>
                        <th colspan="2">Автодром</th>
                        <th colspan="2">Город</th>
                    </tr>
                    <tr>
                        <th colspan="6">Результат/Количество попыток</th>
                    </tr>
                    </thead>
                        <tbody style="vertical-align: middle; text-align: center;">
                        <? $exam_success = 0;
                        $exam_amount_success = 0;
                        $students_amount_success = 0;?>
                        @foreach($exams as $exam)
                        <tr>
                            <td align="left" width="290">{{$exam->student->name}}</td>
                            <td width="80">{{$theory = App\Exam::where('student_id',$exam->student->id)->where('exam_type', 'theory')->where('result', True)->first() ?  'Сдан' : 'Не сдан'}}</td>
                            <td>{{App\Exam::where('student_id',$exam->student->id)->where('exam_type', 'theory')->count()}}</td>
                            <td width="80">{{$polygone = App\Exam::where('student_id',$exam->student->id)->where('exam_type', 'polygon')->where('result', True)->first() ?  'Сдан' : 'Не сдан'}}</td>
                            <td>{{App\Exam::where('student_id',$exam->student->id)->where('exam_type', 'polygon')->count()}}</td>
                            <td width="80">{{$city = App\Exam::where('student_id',$exam->student->id)->where('exam_type', 'city')->where('result', True)->first() ?  'Сдан' : 'Не сдан'}}</td>
                            <td>{{App\Exam::where('student_id',$exam->student->id)->where('exam_type', 'city')->count()}}</td>
                            <td>{{$all = App\Exam::where('student_id',$exam->student->id)->count()}}</td>

                            @if($theory == 'Сдан' && $polygone == 'Сдан' && $city == 'Сдан' && $all == 3)
                                <? $exam_success += 1; ?>
                            @else
                            @endif
                            @if($theory == 'Сдан' && $polygone == 'Сдан' && $city == 'Сдан')
                                <? $exam_amount_success += $all;
                                $students_amount_success += 1;?>
                            @endif
                        </tr>
                        @endforeach
                        <tr>
                            <td align="left" colspan="7">ВСЕГО</td>
                            <td>{{$count}}</td>

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
