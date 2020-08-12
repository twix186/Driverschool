<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
        <span class="brand-text font-weight-light ">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                    @can('user_access_lite')
                        <li class="nav-item">
                            <a href="{{ route("admin.manager.index") }}" class="nav-link {{ request()->is('admin/manager') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fa-fw nav-icon fas fa-user">

                                </i>
                                <p>
                                    {{ trans('cruds.user.title') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @can('car_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.cars.index") }}" class="nav-link {{ request()->is('admin/cars') || request()->is('admin/cars/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-car">

                            </i>
                            <p>
                                {{ trans('cruds.car.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('category_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.categories.index") }}" class="nav-link {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fab fa-amilia">

                            </i>
                            <p>
                                {{ trans('cruds.category.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('learning_plan_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.learning-plans.index") }}" class="nav-link {{ request()->is('admin/learning-plans') || request()->is('admin/learning-plans/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-align-justify">

                            </i>
                            <p>
                                Учебные планы
                            </p>
                        </a>
                    </li>
                @endcan
                @can('group_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.groups.index") }}" class="nav-link {{ request()->is('admin/groups') || request()->is('admin/groups/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-laptop">

                            </i>
                            <p>
                                {{ trans('cruds.group.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('subject_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.subjects.index") }}" class="nav-link {{ request()->is('admin/subjects') || request()->is('admin/subjects/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-align-center">

                            </i>
                            <p>
                                {{ trans('cruds.subject.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('lecture_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.lectures.index") }}" class="nav-link {{ request()->is('admin/lectures') || request()->is('admin/lectures/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-th-large">

                            </i>
                            <p>
                                {{ trans('cruds.lecture.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('attendance_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/practice-attendances') || request()->is('admin/manager/*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon far fa-calendar-alt">

                            </i>
                            <p>
                                Отчеты
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('lectures_attendance_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.practice-attendances.index") }}" class="nav-link {{ request()->is('admin/practice-attendances') || request()->is('admin/practice-attendances/*') ? 'active' : '' }}">

                                        <p>
                                            Отчет о посещаемости <br> занятий
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route("admin.manager.show", $a=0) }}" class="nav-link {{ request()->is('admin/manager') || request()->is('admin/manager/*') ? 'active' : '' }}">

                                        <p>
                                            Отчет о сдаче внутреннего <br> экзамена
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('student_card_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.student-cards.index") }}" class="nav-link {{ request()->is('admin/student-cards') || request()->is('admin/student-cards/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon far fa-address-card">

                            </i>
                            <p>
                                {{ trans('cruds.studentCard.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('practice_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.practices.index") }}" class="nav-link {{ request()->is('admin/practices') || request()->is('admin/practices/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon far fa-dot-circle">

                            </i>
                            <p>
                                {{ trans('cruds.practice.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                {{--@can('reservation_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.reservations.index") }}" class="nav-link {{ request()->is('admin/reservations') || request()->is('admin/reservations/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fab fa-adversal">

                            </i>
                            <p>
                                {{ trans('cruds.reservation.title') }}
                            </p>
                        </a>
                    </li>
                @endcan--}}
                @can('exam_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.exams.index") }}" class="nav-link {{ request()->is('admin/exams') || request()->is('admin/exams/*') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-flag-checkered">

                            </i>
                            <p>
                                {{ trans('cruds.exam.title') }}
                            </p>
                        </a>
                    </li>

                @endcan

                {{--@if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif--}}
                    @can('student')
                    <li class="nav-item">
                        <a href="{{ route("admin.student.index") }}" class="nav-link {{ request()->is('admin/student') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-flag-checkered">
                            </i>
                            <p>
                                Вождение
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.schedule.index") }}" class="nav-link {{ request()->is('admin/schedule') ? 'active' : '' }}">
                            <i class="fa-fw nav-icon fas fa-flag-checkered">
                            </i>
                            <p>
                                Лекции
                            </p>
                        </a>
                    </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.student.create") }}" class="nav-link {{ request()->is('admin/student/create') ? 'active' : '' }}">
                                <i class="fa-fw nav-icon fas fa-flag-checkered">
                                </i>
                                <p>
                                    Посещаемость
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('instructor')
                        <li class="nav-item">
                            <a href="{{ route("admin.instructor.index") }}" class="nav-link {{ request()->is('admin/instructor') ? 'active' : '' }}">

                                <p>
                                    Список занятий
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('lecturer')
                        <li class="nav-item">
                            <a href="{{ route("admin.lecturer.index") }}" class="nav-link {{ request()->is('admin/lecturer') ? 'active' : '' }}">

                                <p>
                                    Журнал посещаемости
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("admin.lecturer.create") }}" class="nav-link {{request()->is('admin/lecturer/create') ? 'active' : '' }}">

                                <p>
                                    Расписание
                                </p>
                            </a>
                        </li>
                    @endcan
                    @canany(['instructor', 'lecturer'])
                        <li class="nav-item">
                            <a href="{{ route("admin.manager.create") }}" class="nav-link {{ request()->is('admin/manager') || request()->is('admin/manager/*') ? 'active' : '' }}">

                                <p>
                                    Список курсантов
                                </p>
                            </a>
                        </li>
                    @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>