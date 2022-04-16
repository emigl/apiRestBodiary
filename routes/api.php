<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Routes for auth and login
Route::group([
    'middleware' => 'cors',
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signUp');

    Route::group([
      'middleware' => 'auth:sanctum'
    ], function() {
        Route::post('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

// Routes for admin control panel

Route::group([
    'middleware' => 'cors',
    // TODO: agregar el middleware auth:sanctum cuando esté el front listo.
     //   'middleware' => 'auth:sanctum'
    'prefix' => 'admin'
], function () {

        Route::post('createUser', 'AdminController@createUser');
        Route::get('getUsers', 'AdminController@getUsers');

        Route::get('getUserById/{id}', 'AdminController@showUserDetails');
        Route::put('updateUser/{id}', 'AdminController@updateUser');

        Route::put('disableUser/{id}', 'AdminController@disableUser');
        Route::put('activeUser/{id}', 'AdminController@activeUser');
        Route::delete('deleteUser/{id}', 'AdminController@deleteUser');
        
    });

    Route::group([
        'middleware' => 'cors',
        // TODO: agregar el middleware auth:sanctum cuando esté el front listo.
         //   'middleware' => 'auth:sanctum'
        'prefix' => 'dashboard'
    ], function () {
    
            Route::post('createWorkoutRegister', 'WorkoutController@createUser');
            Route::get('getWorkoutRegister', 'WorkoutController@getWorkoutRegister');

            Route::post('createBodyWeightRegister', 'WorkoutController@createBodyWeightRegister');
            Route::get('getBodyWeightRegister', 'WorkoutController@getBodyWeightRegister');

            Route::post('createImcRegister', 'WorkoutController@createImcRegister');
            Route::get('getImcRegister', 'WorkoutController@getImcRegister');
    
            
            
        });