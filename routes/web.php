<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentOrderController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Models\Order;
use App\Models\Period;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard', [
            'orders' => Order::with('user', 'status')->paginate(10),
            'status' => Status::all(),
        ]);
    })->name('dashboard');

    Route::resource('book', BookController::class);
    Route::resource('order', OrderController::class);
    Route::resource('user', UserController::class);
    Route::resource('period', PeriodController::class);

    Route::get('settings', [SettingController::class, 'index'])->name('setting.index');
    Route::post('settings', [SettingController::class, 'update'])->name('setting.update');
});

Route::prefix('student')->name('student.')->middleware(['auth', 'isStudent'])->group(function () {
    Route::get('dashboard', function () {
        return view('student.dashboard', [
            'period' => Period::where('active', true)->first(),
            'order' => Order::with('books')->where('user_id', Auth::user()->id)->latest()->first(),
        ]);
    })->name('dashboard');
    Route::resource('order', StudentOrderController::class);
    Route::post('order/add', [StudentOrderController::class, 'add'])->name('order.add');
});
