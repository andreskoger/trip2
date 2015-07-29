<?php

// Frontpage

get('/', 'FrontpageController@index');

// Legacy paths

get('content/{legacy_path}', 'ContentController@redirect')
    ->where(['legacy_path' => '(.*)\.html(.*)']);

// Content

Route::group(['prefix' => 'content/{type}', 'as' => 'content.'], function () {
       
    get('/', ['middleware' => null, 'uses' => 'ContentController@index', 'as' => 'index']);

    get('create', ['middleware' => 'role:regular', 'uses' => 'ContentController@create', 'as' => 'create']);

    post('/', ['middleware' => 'role:regular', 'uses' => 'ContentController@store', 'as' => 'store']);

    get('{id}', ['middleware' => null, 'uses' => 'ContentController@show', 'as' => 'show']);

    get('{id}/edit', ['middleware' => 'role:admin,contentowner', 'uses' => 'ContentController@edit', 'as' => 'edit']);

    put('{id}', ['middleware' => 'role:admin,contentowner', 'uses' => 'ContentController@update', 'as' => 'update']);

    post('/filter', ['middleware' => null, 'uses' => 'ContentController@filter', 'as' => 'filter']);

});


// Comments

post('content/{type}/{id}/comment', ['middleware' => 'role:regular', 'uses' => 'CommentController@store', 'as' => 'comment.store']);

get('comment/{id}/edit', ['middleware' => 'role:admin,commentowner', 'uses' => 'CommentController@edit', 'as' => 'comment.edit']);

put('comment/{id}', ['middleware' => 'role:admin,commentowner', 'uses' => 'CommentController@update', 'as' => 'comment.update']);


// Users

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
       
    // get('/', ['uses' => 'UserController@index', 'as' => 'index']);

    // get('create', ['middleware' => 'auth', 'uses' => 'UserController@create', 'as' => 'create']);

    // post('/', ['middleware' => 'auth', 'uses' => 'UserController@store', 'as' => 'store']);

    get('{id}', ['uses' => 'UserController@show', 'as' => 'show']);

    get('{id}/edit', ['middleware' => 'role:admin,userowner', 'uses' => 'UserController@edit', 'as' => 'edit']);

    put('{id}', ['middleware' => 'role:admin,userowner', 'uses' => 'UserController@update', 'as' => 'update']);

    get('{id}/messages/{id2}', ['middleware' => 'role:superuser,userowner', 'uses' => 'UserController@showMessagesWith', 'as' => 'show.messages.with']);

    get('{id}/messages', ['middleware' => 'role:superuser,userowner', 'uses' => 'UserController@showMessages', 'as' => 'show.messages']);

    get('{id}/follows', ['middleware' => 'role:admin,userowner', 'uses' => 'UserController@showFollows', 'as' => 'show.follows']);

});

Route::group(['prefix' => 'message', 'as' => 'message.'], function () {

    post('{id}/to/{id2}', ['middleware' => 'role:superuser,userowner', 'uses' => 'MessageController@store', 'as' => 'store']);

});

// Registration

get('auth/register', 'Auth\AuthController@getRegister');

post('auth/register', 'Auth\AuthController@postRegister');


// Authentication

get('auth/login', 'Auth\AuthController@getLogin');

post('auth/login', 'Auth\AuthController@postLogin');

get('auth/logout', 'Auth\AuthController@getLogout');


// Password reset

get('password/email', 'Auth\PasswordController@getEmail');

post('password/email', 'Auth\PasswordController@postEmail');

get('password/reset/{token}', 'Auth\PasswordController@getReset');

post('password/reset', 'Auth\PasswordController@postReset');

// Ad debug

get('ads', ['middleware' => 'role:admin', 'uses' => 'AdController@index', 'as' => 'ads']);

// Destinations

get('destination/{id}', ['uses' => 'DestinationController@index', 'as' => 'destination.index']);

// Flags

get('flag/{flaggable_type}/{flaggable_id}/{flag_type}', ['middleware' => 'role:regular', 'uses' => 'FlagController@toggle', 'as' => 'flag.toggle']);