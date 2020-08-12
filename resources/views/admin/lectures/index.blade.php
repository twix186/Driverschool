@extends('layouts.admin')
@section('content')
    @can('lecture_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-secondary" href="{{ route("admin.lectures.create") }}">
                    Добавить лекционное занятие
                </a>
                <a class="btn btn-secondary" href="{{ route('admin.lectures.show', $a = 0) }}">
                    Сформировать расписание лекций
                </a>
            </div>
        </div>

    @endcan
    <div class="card">


        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Lecture">
                    <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.lecture.fields.group') }}
                        </th>
                        <th>
                            {{ trans('cruds.lecture.fields.lecturer') }}
                        </th>
                        <th>
                            {{ trans('cruds.lecture.fields.subject') }}
                        </th>
                        <th>
                            {{ trans('cruds.lecture.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.lecture.fields.time') }}
                        </th>
                        <th>
                            {{ trans('cruds.lecture.fields.audience') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lectures as $key => $lecture)
                        <tr data-entry-id="{{ $lecture->id }}">

                            <td>
                                {{ $lecture->group->name ?? '' }}
                            </td>
                            <td>
                                {{ $lecture->lecturer->name ?? '' }}
                            </td>
                            <td>
                                {{ $lecture->subject->name ?? '' }}
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse( $lecture->date)->format('Y-m-d') ?? '' }}
                            </td>
                            <td>
                                {{ $lecture->time ?? '' }}
                            </td>
                            <td>
                                {{ $lecture->audience ?? '' }}
                            </td>
                            <td>


                                @can('lecture_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.lectures.edit', $lecture->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('lecture_delete')
                                    <form action="{{ route('admin.lectures.destroy', $lecture->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
                pageLength: 100,
            });
            $('.datatable-Lecture:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        })

    </script>
@endsection