@extends('layouts.admin')
@section('content')
    @can('reservation_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.reservations.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.reservation.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Reservation">
                    <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.reservation.fields.student') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.time') }}
                        </th>
                        <th>
                            {{ trans('cruds.reservation.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reservations as $key => $reservation)
                        <tr data-entry-id="{{ $reservation->id }}">

                            <td>
                                {{ $reservation->student->name ?? '' }}
                            </td>
                            <td>
                                {{ $reservation->time ?? '' }}
                            </td>
                            <td>
                                {{ App\Reservation::STATUS_SELECT[$reservation->status] ?? '' }}
                            </td>
                            <td>
                                @can('reservation_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.reservations.show', $reservation->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('reservation_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.reservations.edit', $reservation->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('reservation_delete')
                                    <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            $('.datatable-Reservation:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        })

    </script>
@endsection