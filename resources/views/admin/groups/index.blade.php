@extends('layouts.admin')
@section('content')
    @can('group_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.groups.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.group.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">


        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Group">
                    <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.group.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.date_of_start') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.date_of_end') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.learning_plan') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $key => $group)
                        <tr data-entry-id="{{ $group->id }}">

                            <td>
                                {{ $group->name ?? '' }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($group->date_of_start)->format('Y-m-d') ?? '' }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($group->date_of_end)->format('Y-m-d') ?? '' }}
                            </td>
                            <td>
                                {{ $group->learning_plan->name ?? '' }}
                            </td>
                            <td>
                                @can('group_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.groups.show', $group->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('group_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.groups.edit', $group->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('group_delete')
                                    <form action="{{ route('admin.groups.destroy', $group->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            $('.datatable-Group:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        })

    </script>
@endsection