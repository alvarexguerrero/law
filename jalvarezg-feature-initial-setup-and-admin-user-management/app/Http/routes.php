<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes...
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');

// Registration Routes...
Route::get('register', 'Auth\AuthController@showRegistrationForm');
Route::post('register', 'Auth\AuthController@register');

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');

// Home route after login
Route::get('/home', 'HomeController@index');

// Admin Routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', ['as' => 'dashboard', function () {
        // Placeholder for admin dashboard - maybe redirect to users index for now
        return redirect()->route('admin.users.index');
    }]);

    // User management
    Route::resource('users', 'Admin\UserController', ['except' => ['show', 'create', 'store', 'destroy']]);
    // We've only implemented index, edit, update. Add others as needed.

    // Category management, etc. will go here later
});

// Lawyer Routes
Route::group(['middleware' => ['auth', 'lawyer'], 'prefix' => 'lawyer'], function () {
    Route::get('/', function () {
        // Placeholder for lawyer dashboard
        return "Lawyer Dashboard";
    });
    // View questions, answer questions, profile management, etc.
});

// Client Routes
Route::group(['middleware' => ['auth', 'client'], 'prefix' => 'client'], function () {
    Route::get('/', function () {
        // Placeholder for client dashboard
        return "Client Dashboard";
    });
    // Ask question, view own questions, payment history, etc.
});

?>
