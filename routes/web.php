<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Regulations\CallStatusController;
use App\Http\Controllers\Regulations\OrderStatusController;
use App\Http\Controllers\Regulations\SourceController;
use App\Http\Controllers\Orders\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customers\CustomerSourceController;
use App\Http\Controllers\Customers\CustomerController;
use App\Http\Controllers\General\GeneralController;
use App\Http\Controllers\General\MediaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::post("status/change",[\App\Http\Controllers\General\GeneralController::class,'changeStatus'])->name('general.statusChange');

    //call_statuses
    Route::prefix('call_statuses')->as('call_statuses.')->group(function() {
        Route::get('/', [CallStatusController::class, 'index'])->name('index');
        Route::get('/create', [CallStatusController::class, 'create'])->name('create');
        Route::post('/create', [CallStatusController::class, 'store'])->name('store');
        Route::get('/edit/{brand}', [CallStatusController::class, 'edit'])->name('edit');
        Route::put('/update/{brand}', [CallStatusController::class, 'update'])->name('update');
        Route::delete('/delete/{brand}', [CallStatusController::class, 'delete'])->name('delete');
        Route::get('data', [CallStatusController::class, 'getData'])->name('datatable');
    });

    //order_statuses
    Route::prefix('order_statuses')->as('order_statuses.')->group(function() {
        Route::get('/', [OrderStatusController::class, 'index'])->name('index');
        Route::get('/create', [OrderStatusController::class, 'create'])->name('create');
        Route::post('/create', [OrderStatusController::class, 'store'])->name('store');
        Route::get('/edit/{brand}', [OrderStatusController::class, 'edit'])->name('edit');
        Route::put('/update/{brand}', [OrderStatusController::class, 'update'])->name('update');
        Route::delete('/delete/{brand}', [OrderStatusController::class, 'delete'])->name('delete');
        Route::get('data', [OrderStatusController::class, 'getData'])->name('datatable');
    });

    //sources
    Route::prefix('sources')->as('sources.')->group(function() {
        Route::get('/', [SourceController::class, 'index'])->name('index');
        Route::get('/create', [SourceController::class, 'create'])->name('create');
        Route::post('/create', [SourceController::class, 'store'])->name('store');
        Route::get('/edit/{brand}', [SourceController::class, 'edit'])->name('edit');
        Route::put('/update/{brand}', [SourceController::class, 'update'])->name('update');
        Route::delete('/delete/{brand}', [SourceController::class, 'delete'])->name('delete');
        Route::get('data', [SourceController::class, 'getData'])->name('datatable');
    });

    //orders
    Route::prefix('orders')->as('orders.')->group(function() {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/create', [OrderController::class, 'create'])->name('create');
        Route::post('/create', [OrderController::class, 'store'])->name('store');
        Route::get('/edit/{brand}', [OrderController::class, 'edit'])->name('edit');
        Route::put('/update/{brand}', [OrderController::class, 'update'])->name('update');
        Route::delete('/delete/{brand}', [OrderController::class, 'delete'])->name('delete');
        Route::get('data', [OrderController::class, 'getData'])->name('datatable');
        Route::get('/show/{item}', [OrderController::class,'show'])->name('show');
    });

    //customer_sources
    Route::prefix('customer_sources')->as('customer_sources.')->group(function() {
        Route::get('/', [CustomerSourceController::class, 'index'])->name('index');
        Route::get('/create', [CustomerSourceController::class, 'create'])->name('create');
        Route::post('/create', [CustomerSourceController::class, 'store'])->name('store');
        Route::get('/edit/{brand}', [CustomerSourceController::class, 'edit'])->name('edit');
        Route::put('/update/{brand}', [CustomerSourceController::class, 'update'])->name('update');
        Route::delete('/delete/{brand}', [CustomerSourceController::class, 'delete'])->name('delete');
        Route::get('data', [CustomerSourceController::class, 'getData'])->name('datatable');
        Route::get('/show/{item}', [CustomerSourceController::class,'show'])->name('show');
    });

    
    //customers
    Route::prefix('customers')->as('customers.')->group(function() {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/create', [CustomerController::class, 'create'])->name('create');
        Route::post('/create', [CustomerController::class, 'store'])->name('store');
        Route::get('/edit/{brand}', [CustomerController::class, 'edit'])->name('edit');
        Route::put('/update/{brand}', [CustomerController::class, 'update'])->name('update');
        Route::delete('/delete/{brand}', [CustomerController::class, 'delete'])->name('delete');
        Route::get('data', [CustomerController::class, 'getData'])->name('datatable');
        Route::get('/show/{item}', [CustomerController::class,'show'])->name('show');
    });

    Route::post('/media/delete', [GeneralController::class, 'deleteFile'])->name('media.delete');

});
