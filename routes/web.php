<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath'
    ]
], function() {

    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin', 'AdminController@index')->name('admin_dashboard');
    Route::get('/admin/staff/list', 'UserController@staffList')->name('staff_list')->middleware('user');
    Route::post('/admin/staff/filter/{dep}/{unit}/{grp}', 'UserController@filter')->name('portfolio_filter');
    Route::get('/admin/attendance/my-leave', 'AttendanceController@myLeave')->name('staff_my_leave')->middleware('user');
    Route::post('/admin/attendance/leave', 'AttendanceController@leave')->name('staff_leave')->middleware('user');
    Route::get('/admin/attendance/leave/{type}', 'AttendanceController@leave_type')->name('staff_leave_type')->middleware('user');
    Route::get('/admin/attendance/list/leave', 'AttendanceController@list')->name('staff_leave_list');
    Route::get('/admin/attendance/sort/leave/{status}', 'AttendanceController@sort_by_status')->name('staff_leave_sort');
    Route::get('/admin/attendance/team/leave', 'AttendanceController@teamLeave')->name('staff_leave_team');
    Route::post('/admin/attendance/approval', 'AttendanceController@approval')->name('staff_leave_app');
    Route::get('/admin/get-unit-by-department/{id}', 'UserController@get_unit_by_department');
    Route::get('/admin/get-group-by-unit/{id}', 'UserController@get_group_by_unit');
    Route::post('/admin/staff/search', 'UserController@staff_search')->name('user_search');
    Route::post('/admin/attendance/click/start', 'ClickAttendanceController@startWork')->name('staff_start_work');
    Route::post('/admin/attendance/staff/note', 'ClickAttendanceController@staffNote')->name('staff_note');
    Route::put('/admin/attendance/click/end', 'ClickAttendanceController@endWork')->name('staff_end_work');
    Route::get('/admin/all-genders', 'AdminController@chartJson');

    Route::group(['middleware' => ['admin']], function () {

        Route::get('/admin/user', 'UserController@index')->name('user_list');
        Route::get('/admin/user/detail/{id}', 'UserController@detail')->name('user_detail');
        Route::post('/admin/user/create', 'UserController@create')->name('user_create');
        Route::get('/admin/user/edit/{id}', 'UserController@edit')->name('user_edit');
        Route::put('/admin/user/update/{id}', 'UserController@update')->name('user_update');
        Route::put('/admin/user/password/{id}', 'UserController@changePassword')->name('user_password');
        Route::get('/admin/user/delete/{id}', 'UserController@delete')->name('user_delete');
        Route::post('/admin/user/search', 'UserController@search')->name('user_search');
        Route::get('/admin/user/notifications', 'UserController@notifications')->name('user_notification');

        Route::get('/admin/download/id-card/{id}', 'UserController@id_card_download')->name('user_id_card_download');
        Route::get('/admin/download/contact/{id}', 'UserController@contact_download')->name('user_contact_download');

        Route::get('/admin/department', 'DepartmentController@index')->name('department_list');
        Route::post('/admin/department/create', 'DepartmentController@create')->name('department_create');
        Route::get('/admin/department/edit/{id}', 'DepartmentController@edit')->name('department_edit');
        Route::put('/admin/department/update/{id}', 'DepartmentController@update')->name('department_update');
        Route::get('/admin/department/delete/{id}', 'DepartmentController@delete')->name('department_delete');
        Route::post('/admin/department/search', 'DepartmentController@search')->name('department_search');

        Route::get('/admin/unit', 'UnitController@index')->name('unit_list');
        Route::post('/admin/unit/create', 'UnitController@create')->name('unit_create');
        Route::get('/admin/unit/edit/{id}', 'UnitController@edit')->name('unit_edit');
        Route::put('/admin/unit/update/{id}', 'UnitController@update')->name('unit_update');
        Route::get('/admin/unit/delete/{id}', 'UnitController@delete')->name('unit_delete');
        Route::post('/admin/unit/search', 'UnitController@search')->name('unit_search');

        Route::get('/admin/group', 'GroupController@index')->name('group_list');
        Route::post('/admin/group/create', 'GroupController@create')->name('group_create');
        Route::get('/admin/group/edit/{id}', 'GroupController@edit')->name('group_edit');
        Route::put('/admin/group/update/{id}', 'GroupController@update')->name('group_update');
        Route::get('/admin/group/delete/{id}', 'GroupController@delete')->name('group_delete');
        Route::post('/admin/group/search', 'GroupController@search')->name('group_search');

        Route::get('/admin/position', 'PositionController@index')->name('position_list');
        Route::post('/admin/position/create', 'PositionController@create')->name('position_create');
        Route::get('/admin/position/edit/{id}', 'PositionController@edit')->name('position_edit');
        Route::put('/admin/position/update/{id}', 'PositionController@update')->name('position_update');
        Route::get('/admin/position/delete/{id}', 'PositionController@delete')->name('position_delete');
        Route::post('/admin/position/search', 'PositionController@search')->name('position_search');

        Route::get('/admin/attendance-click/list', 'ClickAttendanceController@list')->name('click_attendance_list');
        Route::put('/admin/attendance-click/hrnote/{id}', 'ClickAttendanceController@hrNote')->name('hr_note');
    });

    Route::get('/mark-as-read', function() {
        Auth::user()->unreadNotifications->markAsRead();
    });
});
