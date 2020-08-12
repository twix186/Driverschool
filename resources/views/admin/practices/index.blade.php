@extends('layouts.admin')
@section('content')
    @can('practice_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-secondary" href="{{ route("admin.practices.create") }}">
                    Добавить занятие по вождению
                </a>
                <a class="btn btn-secondary" href="{{ route('admin.practices.show', $a = 0) }}">
                    Сформировать расписание занятий по вождению
                </a>
            </div>
        </div>

    @endcan
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Practice">
                    <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.practice.fields.instructor') }}
                        </th>
                        <th>
                            {{ trans('cruds.practice.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.practice.fields.reservation') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($practices as $key => $practice)
                        <tr data-entry-id="{{ $practice->id }}">

                            <td>
                                {{ $practice->instructor->name ?? '' }}
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse($practice->date)->format('Y-m-d') ?? '' }}
                            </td>
                            <td>
                                @foreach($practice->reservations as $key => $item)
                                    <span class="badge badge-info">{{ $item->time }}</span>
                                @endforeach
                            </td>
                            <td>


                                @can('practice_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.practices.edit', $practice->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('practice_delete')
                                    <form action="{{ route('admin.practices.destroy', $practice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            $('.datatable-Practice:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        })

    </script>
@endsection