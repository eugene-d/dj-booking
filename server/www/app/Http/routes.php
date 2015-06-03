<?php

Route::get('/', 'DashboardController@index');

/*Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);*/

/*Route::group(array('prefix' => 'v1'), function () {
    Route::resource('dj', 'DjController', ['except' => ['create', 'edit']]);
});*/