<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PlusTimeIT\EasyForms\Controllers\Users;

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

// User Access / Auth Routes
Route::middleware(['auth:user'])
    ->controller(UserController::class)
    ->prefix('auth')
    ->group(function () {
        Route::get('/logout', 'logout')->name('auth.logout');
    });

Route::get('/users/all', fn () => Users::getAllUsers());

Route::get('/forms/1', [PageController::class, 'form1']);
