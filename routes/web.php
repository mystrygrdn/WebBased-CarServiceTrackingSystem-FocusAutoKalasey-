<?php

use Illuminate\Support\Facades\Route;

// =======================
// CONTROLLERS
// =======================
use App\Http\Controllers\loginController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\customersController;
use App\Http\Controllers\vehiclesController;
use App\Http\Controllers\logincustController;
use App\Http\Controllers\ServiceTrackingController;
use App\Http\Controllers\RiwayatServiceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashboardminController;
use App\Http\Controllers\CustomerInvoiceController;
use App\Http\Controllers\CustomerRiwayatController;

/*
|--------------------------------------------------------------------------
| LOGIN CUSTOMER (Public Access)
|--------------------------------------------------------------------------
*/
Route::get('/logincustomer', [logincustController::class, 'showLoginForm'])
    ->name('logincustomer');

Route::post('/logincustomer', [logincustController::class, 'login'])
    ->name('logincustomer.post');

Route::post('/logincustomer/logout', [logincustController::class, 'logout'])
    ->name('customer.logout');

Route::get('/customer/dashboard', [logincustController::class, 'dashboard'])
    ->name('customer.dashboard');

/*
|--------------------------------------------------------------------------
| AREA CUSTOMER (Protected - Auth Required)
|--------------------------------------------------------------------------
*/
Route::middleware(['customer.auth', 'nocache'])->group(function () {
    Route::get('/dashboardcustomer', [ServiceTrackingController::class, 'customerTracking'])
        ->name('customer.servicetracking');
    
    Route::get('/riwayatcustomer', [CustomerRiwayatController::class, 'index'])
        ->name('customer.riwayat');
    
    Route::get('/invoice', [CustomerInvoiceController::class, 'index'])
        ->name('customer.invoice.index');
    
    Route::get('/invoice/{id}', [CustomerInvoiceController::class, 'show'])
        ->name('customer.invoice.show');
        
    //AJAX POOLING - NEAR REAL TIME
    Route::get('/customer/service-status-json', [ServiceTrackingController::class, 'getLatestStatus'])
    ->name('customer.service.status');
});

/*
|--------------------------------------------------------------------------
| LOGIN ADMIN (Public Access)
|--------------------------------------------------------------------------
*/
Route::get('/loginadmin', [loginController::class, 'index'])
    ->name('loginadmin');

Route::post('/loginadmin', [loginController::class, 'login'])
    ->name('loginadmin.post');

Route::post('/logoutadmin', [loginController::class, 'logout'])
    ->name('admin.logout');
    
/*
|--------------------------------------------------------------------------
| AREA ADMIN (Protected - Auth Required)
|--------------------------------------------------------------------------
*/
Route::middleware(['admin.auth','nocache'])->group(function () {
    
    // Dashboard
    Route::get('/dashboardadmin', [DashboardminController::class, 'index'])
        ->name('dashboardadmin');

    // Manajemen Admin
    Route::prefix('manajemenadmin')->group(function () {
        Route::get('/', [adminController::class, 'index'])->name('manajemenadmin');
        Route::get('/insert', [adminController::class, 'add'])->name('manajemenadmin.insert');
        Route::post('/store', [adminController::class, 'store'])->name('manajemenadmin.store');
        Route::get('/edit/{id}', [adminController::class, 'edit'])->name('manajemenadmin.edit');
        Route::post('/update/{id}', [adminController::class, 'update'])->name('manajemenadmin.update');
        Route::delete('/delete/{id}', [adminController::class, 'destroy'])->name('manajemenadmin.delete');
    });

    // Data Customer
    Route::get('/datapelanggan', [customersController::class, 'index'])->name('customer.index');
    Route::get('/customer/add', [customersController::class, 'create'])->name('customer.add');
    Route::post('/customer/store', [customersController::class, 'store'])->name('customer.store');
    Route::get('/customer/edit/{id}', [customersController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/update/{id}', [customersController::class, 'update'])->name('customer.update');
    Route::delete('/customer/delete/{id}', [customersController::class, 'destroy'])->name('customer.delete');

    // Data Vehicle
    Route::get('/vehicle/add', [vehiclesController::class, 'create'])->name('vehicle.add');
    Route::post('/vehicle/store', [vehiclesController::class, 'store'])->name('vehicle.store');

    // Service Tracking
    Route::prefix('prosesservice')->group(function () {
        Route::get('/', [ServiceTrackingController::class, 'create'])->name('tracking.create');
        Route::post('/store', [ServiceTrackingController::class, 'store'])->name('tracking.store');
        Route::get('/edit/{id}', [ServiceTrackingController::class, 'edit'])->name('tracking.edit');
        Route::put('/update/{id}', [ServiceTrackingController::class, 'update'])->name('tracking.update');
        Route::delete('/delete/{id}', [ServiceTrackingController::class, 'destroy'])->name('tracking.destroy');
    });

    // Riwayat Service
    Route::get('/riwayatservice', [RiwayatServiceController::class, 'index'])->name('riwayatservice');

    // Invoice
    Route::prefix('riwayatinvoice')->group(function () {
        Route::get('/createinvoice', [InvoiceController::class, 'index'])->name('invoice.index');
        Route::get('/createinvoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
        Route::post('/createinvoice/store', [InvoiceController::class, 'store'])->name('invoice.store');
        Route::get('/createinvoice/pdf/{id}', [InvoiceController::class, 'pdf'])->name('invoice.pdf');
        Route::get('/createinvoice/preview/{id}', [InvoiceController::class, 'preview'])->name('invoice.preview');
        Route::get('/', [InvoiceController::class, 'history'])->name('invoice.history');
        Route::get('/{id}/edit', [InvoiceController::class, 'edit'])->name('invoice.edit');
        Route::put('/{id}', [InvoiceController::class, 'update'])->name('invoice.update');
        Route::delete('/{id}', [InvoiceController::class, 'destroy'])->name('invoice.destroy');
    });
});