<?php

use Illuminate\Http\Request;
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
Route::group(['prefix' => '/v1'], function () {
    //Login/Register

    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

    //Auth Check
    Route::get('/auth_alive', [\App\Http\Controllers\AuthController::class, 'authAlive']);
    Route::get('/unauthorized/user', function (){
        return response()->json(["status"=>false,"message"=>"unauthorized"])->setStatusCode(401);
    })->name("unauthorized");
});
Route::group(['prefix' => '/v1', 'middleware' => 'auth:api'], function () {
    //Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'getDashboard']);

    //Task
    Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'getTask']);
    Route::post('/add/task', [\App\Http\Controllers\TaskController::class, 'addTask']);
    Route::get('/get/task/{id}', [\App\Http\Controllers\TaskController::class, 'getSingleTask']);
    Route::put('/update/task', [\App\Http\Controllers\TaskController::class, 'updateTask']);
    Route::delete('/delete/task/{id}', [\App\Http\Controllers\TaskController::class, 'deleteTask']);

    //Project
    Route::get('/projects', [\App\Http\Controllers\ProjectController::class, 'getProject']);
    Route::post('/add/project', [\App\Http\Controllers\ProjectController::class, 'addProject']);
    Route::get('/get/project/{id}', [\App\Http\Controllers\ProjectController::class, 'getSingleProject']);
    Route::put('/update/project', [\App\Http\Controllers\ProjectController::class, 'updateProject']);
    Route::delete('/delete/project/{id}', [\App\Http\Controllers\ProjectController::class, 'deleteProject']);

    //Change Password
    Route::post('/change_password', [\App\Http\Controllers\UserController::class, 'changePassword']);

    //Profile
    Route::get('/profile', [\App\Http\Controllers\UserController::class, 'getProfile']);
    Route::put('/update/profile/headline', [\App\Http\Controllers\UserController::class, 'updateProfileHeadline']);
    Route::put('/update/profile/information', [\App\Http\Controllers\UserController::class, 'updateProfileInformation']);
    Route::post('/update/setting', [\App\Http\Controllers\UserController::class, 'updateSetting']);

    //logout
    Route::post('/logout', [\App\Http\Controllers\UserController::class, 'logoutUser']);
});
