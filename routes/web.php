<?php

use App\Http\Middleware\IsAdmin;
use App\Models\Order;
use App\Models\Status;
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

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard', [
            'orders' => Order::with('user', 'status')->paginate(10),
            'status' => Status::all(),
        ]);
    });
});

Route::prefix('student')->name('student.')->middleware('isStudent')->group(function () {
    Route::get('dashboard', function () {
        return view('student.dashboard');
    });
});
