@extends('layouts.admin')
@section('content')
    @can('learning_plan_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.learning-plans.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.learningPlan.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">


        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-LearningPlan">
                    <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.learningPlan.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.learningPlan.fields.lecture_hours') }}
                        </th>
                        <th>
                            {{ trans('cruds.learningPlan.fields.practice_hours') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($learningPlans as $key => $learningPlan)
                        <tr data-entry-id="{{ $learningPlan->id }}">

                            <td>
                                {{ $learningPlan->name ?? '' }}
                            </td>
                            <td>
                                {{ $learningPlan->lecture_hours ?? '' }}
                            </td>
                            <td>
                                {{ $learningPlan->practice_hours ?? '' }}
                            </td>
                            <td>
                                @can('learning_plan_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.learning-plans.show', $learningPlan->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('learning_plan_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.learning-plans.edit', $learningPlan->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('learning_plan_delete')
                                    <form action="{{ route('admin.learning-plans.destroy', $learningPlan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            $('.datatable-LearningPlan:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        })

    </script>
@endsection