@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-body">
            <form class="form-inline" method="GET">
                <div class="form-group">
                    <label>Курсант         </label>
                    <select class="form-control select2" name="name" id="name" placeholder="Выберите курсанта">
                        <option value="">Выберите курсанта</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" >{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Дата с</label>
                    <input class="form-control date" type="text" name="date1" id="date1" value="" placeholder="Выберите дату">
                    <label>по</label>
                    <input class="form-control date" type="text" name="date2" id="date2" value="" placeholder="Выберите дату">
                    <button class="btn btn-dark" type="submit">Поиск</button>
                </div>
            </form>
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-LecturesAttendance">
                    <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.lecturesAttendance.fields.student') }}
                        </th>
                        <th>
                            {{ trans('cruds.lecturesAttendance.fields.date_of_lecture') }}
                        </th>
                        <th>
                            {{ trans('cruds.lecturesAttendance.fields.check') }}
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lecturesAttendances as $key => $lecturesAttendance)
                        <tr data-entry-id="{{ $lecturesAttendance->id }}">

                            <td>
                                {{ $lecturesAttendance->student->name ?? '' }}
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse( $lecturesAttendance->date_of_lecture->date)->format('Y-m-d') ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $lecturesAttendance->check ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $lecturesAttendance->check ? 'checked' : '' }}>
                            </td>

                        </tr>
                    @endforeach
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
