<?php
/*
DB::listen(function($query) {
    var_dump($query->sql, $query->bindings);
    echo '<br>';
});
 * 
 */


Route::get('/', 'ImageController@imagesAll');
Route::get('/show-all-images', 'ImageController@imagesAll');
Route::get('/show-all-videos', 'VideoController@videosAll');

Route::post('ulogin', 'UloginController@login');

Route::get('/category/{id}', 'ImageController@imagesAllCategory');
Route::get('/category-video/{id}', 'VideoController@videosAllCategory');
Route::get('/show/image/{id}', 'ImageController@showImageOne');
Route::get('/show/video/{id}', 'VideoController@showVideoOne');

Route::get('/image/upload', 'ImageController@create')->middleware('verified');
Route::get('/video/upload', 'VideoController@create')->middleware('verified');

Route::post('/store-image', 'ImageController@storeImage')->middleware('verified');
Route::post('/store-video', 'VideoController@storeVideo')->middleware('verified');


Route::post('/store-comment', 'CommentController@storeComment')->middleware('verified');
Route::post('/store-comment-video', 'CommentController@storeCommentVideo')->middleware('verified');
Route::post('/store-comment-child', 'CommentChildController@storeCommentChild')->middleware('verified');




Route::get('/read-notif', 'CommentController@readNotification')->middleware('verified');
Route::get('/mark-notif-read/{id}', 'CommentController@markNotifRead')->middleware('verified');

Route::get('/my-profile', 'ProfileController@index')->middleware('verified');
Route::get('/profile-security', 'ProfileController@profileSecurity')->middleware('verified');
Route::post('/update-profile', 'ProfileController@update')->middleware('verified');
Route::post('/update-password', 'ProfileController@updatePassword')->middleware('verified');

//Auth::routes();

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');


