<?php

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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::middleware(['auth','verify'])->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');

    /* USERS ROUTE */
    Route::middleware(['user-auth'])->group(function (){
        Route::get('/settings/edit_user/{user}', 'UserController@edit')->name('edit.user');
        Route::post('/settings/update/{user}', 'UserController@update')->name('update.user');
        Route::post('/settings/add_photo/{user}', 'UserController@add_photo')->name('add_photo.user');
        Route::post('/user/create/company/store/{user}', 'UserController@company_store')->name('user.company.store');
        Route::post('/settings/update_image/{image}', 'UserController@updateProfileImage')->name('update_profile_image.user');
        Route::post('/settings/change_active/{image}', 'UserController@changeActiveImage')->name('change_Active_Image.user');
        Route::post('/user/create/company/edit/{company}', 'UserController@company_edit')->name('user.company.edit');
        Route::post('/settings/delete_image/{image}', 'UserController@deleteImage')->name('delete_image.user');
    });
    Route::get('/user/{user}', 'UserController@show')->name('user.show');

    Route::get('/user/create/company/create', 'UserController@company_create')->name('user.company.create');



    /*END USER ROUTES*/
    /*ADMIN ROUTE */
    Route::middleware(['admin_dashboard'])->group(function (){
        Route::get('/admin_dashboard/', 'AdminController@index')->name('admin.index');
        /* USER TABLE */
        Route::get('/user/{user}/permission', 'AdminController@userPermission');
        Route::post('/user/{user}/change_permission', 'AdminController@userChangePermission')->name('admin.change_permission');
        Route::post('/user/delete/{user}', 'AdminController@deleteUser')->name('admin.delete_user');
        Route::get('/admin_dashboard/user/{term}', 'AdminController@showUser')->name('admin.show_user');
        /*END USER TABLE */

        /* COMPANY TABLE */
        Route::get('admin_dashboard/get/company/{company}', 'AdminController@getCompany');
        Route::get('admin_dashboard/company/{term}', 'AdminController@showCompany')->name('admin.show_company');
        Route::post('admin_dashboard/company/edit/{company}', 'AdminController@editCompany');
        /* END COMPANY TABLE */
        Route::post('report/accept', 'ReportController@accept')->name('reports.accept');
        Route::post('report/unaccept', 'ReportController@unaccept')->name('reports.unaccept');

        Route::get('other_reports/{report}', 'ReportController@getOtherReports');
        Route::post('reports/delete', 'ReportController@delete')->name('reports.delete');
        Route::post('reports/mark_seen', 'ReportController@markSeen')->name('reports.mark-seen');
        Route::post('reports/mark_unseen', 'ReportController@markUnSeen')->name('reports.mark-unseen');
        Route::post('reports/all_mark_seen', 'ReportController@AllMarkSeen')->name('reports.all-mark-seen');

    });


    /*END ADMIN ROUTE */


    /* POST ROUTES */
    Route::group(['middleware' => 'user-auth'], function (){

    });
    Route::get('/post/create', 'PostController@create')->name('post.create');
    Route::post('/post/store', 'PostController@store')->name('post.store');
    Route::get('/post/edit/{post}', 'PostController@edit')->name('post_edit')->middleware('post_permission');
    Route::post('/post/update/{post}', 'PostController@update')->name('post_update')->middleware('post_permission');
    Route::post('/post/destroy/{post}', 'PostController@destroy')->name('post_destroy')->middleware('post_permission');




    /* COMMENTS */
    Route::post('comment/store', 'CommentController@store')->name('comment.store');
    Route::post('comment/update/{comment}', 'CommentController@update')->name('comment.update');
    Route::post('comment/delete/{comment}', 'CommentController@delete')->name('comment.delete');

    /*END COMMENTS */

    /* RATE */
    Route::post('rate/store', 'RateController@store')->name('rate.store');
    Route::post('rate/update/{rate}', 'RateController@update')->name('rate.update');
    Route::get('users_rate/{post}/{rate}', 'RateController@users_rate')->name('users_rate')->middleware('post_permission');


    /*END RATE*/

    /*  EDUCATION ROUTE */

    Route::post('/education/{user}', 'EducationController@store')->name('education.store');
    Route::post('/education/delete/{education}', 'EducationController@delete')->name('education.delete');
    Route::post('/education/update/{education}', 'EducationController@update')->name('education.update');
    Route::get('/education/edit/{education}', 'EducationController@edit')->name('education.edit');


    /*FRIEND ROUTES */
    Route::get('/friends', 'FriendController@index')->name('friends.index');
    Route::get('/friends/{term}', 'FriendController@searchFriends');
    Route::post('/friends/store', 'FriendController@store')->name('friends.store');
    Route::post('/friends/delete', 'FriendController@delete')->name('friends.delete');
    Route::post('/friends/accept', 'FriendController@accept')->name('friends.accept');
    Route::post('/friends/decline', 'FriendController@decline')->name('friends.decline');


    /*END FRIEND ROUTES*/

    /*END EDUCATION ROUTE*/

    /*REPORT ROUTE*/
    Route::post('report/store', 'ReportController@store')->name('report.store');


    /*END REPORT ROUTE*/
    /*COMPANY ROUTE*/
    Route::get('/company/{company}', 'CompanyController@show');
    Route::post('/employer/add_employer', 'EmployeeController@store');
    Route::post('/confirm/employee/{employee}', 'CompanyController@confirmEmployee')->name('confirm.employee');
    Route::post('/employee/{employee}/rate/diligence', 'CompanyController@rateDiligenceEmployee')->name('rate.diligence');
    Route::post('/rate/{rate}/delete/{employee}', 'CompanyController@deleteRateDiligence')->name('delete.rate.diligence');
    Route::post('/delete/employee/{employee}', 'CompanyController@deleteEmployee')->name('delete.employee');
        /* COMPARE ROUTES */
        Route::get('/compare/autocomplete/employees/{employee}', 'CompareController@AutocompleteEmployees');
        Route::post('/compare/users', 'CompareController@index')->name('compare.index');
        /* END COMPARE ROUTES*/
    /*END COMPANY ROUTE*/
    /* SEARCH / AUTOCOMPLETE ROUTES */
        Route::get('autocomplete/users', 'SearchController@userAutocomplete');
        Route::get('autocomplete/companies', 'SearchController@companiesAutocomplete');

    /*  END SEARCH AUTOCOMPLETE ROUTES*/
    /* END POST ROUTES */
});

Route::get('/VerifyEmail/{tok}', 'VerifyController@verify')->name('verify');
Route::get('/verify', 'VerifyController@index');