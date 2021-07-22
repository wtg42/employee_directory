<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DirectoryController;
use Illuminate\Support\Facades\Route;

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
// 部門頁面路由
Route::middleware(['auth:sanctum', 'verified'])->resource('/department', DepartmentController::class);

// 通訊錄頁面路由
Route::middleware(['auth:sanctum', 'verified'])->resource('/directory', DirectoryController::class, ['only' => [
    'create', 'edit',
]]);

Route::resource('/directory', DirectoryController::class, ['only' => [
    'index',
]]);

// 看 log 入口
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/', function () {
    return view('welcome');
    // return view('auth/login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum'])->get('/test', function () {
    return view('test');
});
