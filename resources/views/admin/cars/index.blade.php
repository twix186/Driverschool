@extends('layouts.admin')
@section('content')
    @can('car_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.cars.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.car.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">


        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Car">
                    <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.car.fields.license_plate') }}
                        </th>
                        <th>
                            {{ trans('cruds.car.fields.brand') }}
                        </th>
                        <th>
                            {{ trans('cruds.car.fields.model') }}
                        </th>
                        <th>
                            {{ trans('cruds.car.fields.gearbox_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.car.fields.year_of_issue') }}
                        </th>
                        <th>
                            {{ trans('cruds.learningPlan.fields.category') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cars as $key => $car)
                        <tr data-entry-id="{{ $car->id }}">

                            <td>
                                {{ $car->license_plate ?? '' }}
                            </td>
                            <td>
                                {{ $car->brand ?? '' }}
                            </td>
                            <td>
                                {{ $car->model ?? '' }}
                            </td>
                            <td>
                                {{ $car->gearbox_type ?? '' }}
                            </td>
                            <td>
                                {{ $car->year_of_issue ?? '' }}
                            </td>
                            <td>
                                {{ $car->category->name ?? '' }}
                            </td>
                            <td>
                                @can('car_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.cars.show', $car->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('car_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.cars.edit', $car->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('car_delete')
                                    <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            $('.datatable-Car:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        })

    </script>
@endsection