<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dummyAPI;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('data', [dummyAPI::class, 'getData']);
Route::get('lists', [DeviceController::class, 'lists']);
Route::get('list/{id}', [DeviceController::class, 'list']);
Route::post('list/add', [DeviceController::class, 'add_list']);
Route::put('list/update/{id}', [DeviceController::class, 'update_list']);
Route::delete('list/delete/{id}', [DeviceController::class, 'delete_list']);
Route::get('list/search/{name}', [DeviceController::class, 'search_list']);
Route::post('list/save', [DeviceController::class, 'save_list']);
Route::post('upload', [DeviceController::class, 'upload']);
Route::post('user/create', [UserController::class, 'create']);
Route::post('user/login', [UserController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::get('new-list', [DeviceController::class, 'new_lists']);
});
