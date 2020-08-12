@extends('layouts.admin')
@section('content')
    @can('exam_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.exams.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.exam.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">


        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Exam">
                    <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.exam.fields.student') }}
                        </th>
                        <th>
                            {{ trans('cruds.exam.fields.date') }}
                        </th>
                        <th>
                            Этап экзамена
                        </th>
                        <th>
                            Результат
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($exams as $key => $exam)
                        <tr data-entry-id="{{ $exam->id }}">

                            <td>
                                {{ $exam->student->name ?? '' }}
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse($exam->date)->format('Y-m-d')  ?? '' }}
                            </td>
                            <td>
                                {{ App\Exam::STATUS_SELECT[$exam->exam_type] ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $exam->result ?? '' }}</span>
                                {{ $exam->result ? 'Сдан' : 'Не сдан' }}
                            </td>

                            <td>

                                @can('exam_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.exams.edit', $exam->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('exam_delete')
                                    <form action="{{ route('admin.exams.destroy', $exam->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

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
                pageLength: 10,
            });
            $('.datatable-Exam:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        })

    </script>
@endsection