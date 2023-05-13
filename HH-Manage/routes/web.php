<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MyJobController;



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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware('auth')->group(function () {

    //route phần điều khiển
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('dashboard.logout');

    //route phần quản lí nhân viên
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employee/add', [EmployeeController::class, 'create'])->name('employee.add')->middleware('checkRole');
    Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store')->middleware('checkRole');
    Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('/employee/update/{id}', [EmployeeController::class, 'update'])->name('employee.update')->middleware('checkRole');
    Route::get('/employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.delete')->middleware('checkRole');
    
    //route phần dự án
    Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/add', [ProjectController::class, 'create'])->name('project.add')->middleware('checkRole');
    Route::post('/project/store', [ProjectController::class, 'store'])->name('project.store')->middleware('checkRole');
    Route::get('/project/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::post('/project/update/{id}', [ProjectController::class, 'update'])->name('project.update')->middleware('checkRole');
    Route::get('/project/delete/{id}', [ProjectController::class, 'destroy'])->name('project.delete')->middleware('checkRole');

    //route phần công việc
    Route::get('/task', [taskController::class, 'index'])->name('task.index');
    Route::get('/task/add', [taskController::class, 'create'])->name('task.add')->middleware('checkRole');
    Route::post('/task/store', [taskController::class, 'store'])->name('task.store')->middleware('checkRole');
    Route::get('/task/edit/{id}', [taskController::class, 'edit'])->name('task.edit');
    Route::post('/task/update/{id}', [taskController::class, 'update'])->name('task.update')->middleware('checkRole');
    Route::get('/task/delete/{id}', [taskController::class, 'destroy'])->name('task.delete')->middleware('checkRole');



    //route phần công việc của tôi
    Route::get('/myjob', [MyJobController::class, 'showMyjob'])->name('myjob.index');


});
