@extends('layouts.admin')
@section('content')
    @can('student_card_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.student-cards.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.studentCard.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">


        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-StudentCard">
                    <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.studentCard.fields.student') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentCard.fields.instructor') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentCard.fields.group') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentCard.fields.car') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($studentCards as $key => $studentCard)
                        <tr data-entry-id="{{ $studentCard->id }}">

                            <td>
                                {{ $studentCard->student->name ?? '' }}
                            </td>
                            <td>
                                {{ $studentCard->instructor->name ?? '' }}
                            </td>
                            <td>
                                {{ $studentCard->group->name ?? '' }}
                            </td>
                            <td>
                                {{ $studentCard->car->license_plate ?? '' }}
                            </td>
                            <td>
                                @can('student_card_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.student-cards.show', $studentCard->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('student_card_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.student-cards.edit', $studentCard->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('student_card_delete')
                                    <form action="{{ route('admin.student-cards.destroy', $studentCard->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            $('.datatable-StudentCard:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        })

    </script>
@endsection