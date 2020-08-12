<?php

Route::redirect('/', 'login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::post('/newschedule', 'Admin\LecturesController@newschedule');
Route::post('/newpracticeschedule', 'Admin\PracticeController@newpracticeschedule');

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('permissions', 'PermissionsController');
    Route::resource('roles', 'RolesController');
    Route::resource('users', 'UsersController');
    Route::resource('cars', 'CarsController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('learning-plans', 'LearningPlanController');
    Route::resource('groups', 'GroupsController');
    Route::resource('subjects', 'SubjectsController');
    Route::resource('lectures', 'LecturesController');
    Route::resource('lectures-attendances', 'LecturesAttendanceController');
    Route::resource('practice-attendances', 'PracticeAttendanceController');
    Route::resource('student-cards', 'StudentCardsController');
    Route::resource('practices', 'PracticeController');
    Route::resource('reservations', 'ReservationsController');
    Route::resource('exams', 'ExamController');
    Route::resource('student', 'StudentController');
    Route::resource('schedule', 'ScheduleController');
    Route::resource('instructor', 'InstructorController');
    Route::resource('lecturer', 'LecturerController');
    Route::resource('manager', 'ManagerController');

});
