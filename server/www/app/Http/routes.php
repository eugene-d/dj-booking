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

//This is a test mail queue route
Route::get('/qmail', function () {
    Mail::queue('emails.password', ['token' => 'token_value'], function ($message) {
        $message->from('lr@example.com', 'Laravel');
        $message->to('foo@example.com', 'John Smith')->subject('Welcome!');
    });
    return 'QUEUED ' . time()
    . '</br>Run queued jobs by: php artisan queue:listen --timeout=2 --tries=3'
    . '</br> also take a look at http://laravel.com/docs/5.0/artisan#scheduling-artisan-commands ';
});
