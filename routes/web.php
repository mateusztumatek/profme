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
    Route::get('/settings/edit_user/{user}', 'UserController@edit')->name('edit.user');
    Route::post('/settings/update/{user}', 'UserController@update')->name('update.user');
    Route::post('/settings/add_photo/{user}', 'UserController@add_photo')->name('add_photo.user');
    Route::post('/settings/update_image/{image}', 'UserController@updateProfileImage')->name('update_profile_image.user');
    Route::post('/settings/change_active/{image}', 'UserController@changeActiveImage')->name('change_Active_Image.user');
    Route::post('/settings/delete_image/{image}', 'UserController@deleteImage')->name('delete_image.user');
    /* USERS ROUTE */
    Route::get('/user/{user}', 'UserController@show')->name('user.show');

    /* POST ROUTES */
    Route::group(['middleware' => 'user-auth'], function (){

    });
    Route::get('posts/{user}', 'PostController@user_posts');
    Route::get('/post/create', 'PostController@create')->name('post.create');
    Route::post('/post/store', 'PostController@store')->name('post.store');
    Route::get('/post/edit/{post}', 'PostController@edit')->name('post_edit')->middleware('post_permission');
    Route::post('/post/update/{post}', 'PostController@update')->name('post_update')->middleware('post_permission');
    Route::post('/post/destroy/{post}', 'PostController@destroy')->name('post_destroy');




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


    /* END POST ROUTES */
});

Route::get('/VerifyEmail/{tok}', 'VerifyController@verify')->name('verify');
Route::get('/verify', 'VerifyController@index');