<?php

use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\ServiceSubmittionController;
use App\Http\Controllers\SubmittedProductsController;
use App\Models\Service;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Home', [
        'services' => Service::query()->pending()->get(),
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');

    Route::get('products', [SubmittedProductsController::class, 'index'])->name('products.index');
    Route::get('products/create', [SubmittedProductsController::class, 'create'])->name('products.create');
    Route::post('products', [SubmittedProductsController::class, 'store'])->name('products.store');
    Route::get('products/{service:uuid}', [ServiceSubmittionController::class, 'show'])->name('submittion.product.details');
    Route::post('products/{service:uuid}', [ServiceSubmittionController::class, 'submitReport'])->name('submittion.product.details');

    Route::prefix('analyst')->as('analyst.')->middleware('checkRole:analyst')->group(function () {
        Route::get('services', [ServiceController::class, 'index'])->name('services.index');
        Route::post('services/{service:uuid}', [ServiceController::class, 'action'])->name('services.action');
    });
});

require __DIR__.'/auth.php';
