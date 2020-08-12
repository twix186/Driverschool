@extends('layouts.admin')
@section('content')
    @can('subject_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.subjects.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.subject.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">


        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Subject">
                    <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.subject.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.subject.fields.hours') }}
                        </th>
                        <th>
                            &nbsp;Учебный план
                        </th>
                        <th>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subjects as $key => $subject)
                        <tr data-entry-id="{{ $subject->id }}">

                            <td>
                                {{ $subject->name ?? '' }}
                            </td>
                            <td>
                                {{ $subject->hours ?? '' }}
                            </td>
                            <td>
                                1
                            </td>
                            <td>
                                @can('subject_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.subjects.show', $subject->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('subject_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.subjects.edit', $subject->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('subject_delete')
                                    <form action="{{ route('admin.subjects.destroy', $subject->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            $('.datatable-Subject:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        })

    </script>
@endsection