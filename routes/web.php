<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ErrorController;

use Illuminate\Support\Facades\Route;

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
})->middleware('guest');

Auth::routes(['verify' => true, 'guest']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['verified', 'userChecked']);

Route::middleware(['verified', 'userChecked'])->group(function () {

    Route::get('userMana', [UserController::class, 'index'])->name('userMana.index');

    Route::get('userMana/create', [UserController::class, 'create'])->name('userMana.create');

    Route::post('userMana', [UserController::class, 'store'])->name('userMana.store');

    Route::get('userMana/{userMana}', [UserController::class, 'show'])->name('userMana.show');

    Route::get('userMana/{userMana}/edit', [UserController::class, 'edit'])->name('userMana.edit');

    Route::put('userMana/{userMana}', [UserController::class, 'update'])->name('userMana.update');
    
    Route::post('userMana/destroy', [UserController::class, 'destroy'])->name('userMana.destroy');

    Route::post('userMana/changeVerify', [UserController::class, 'verify'])->name('userMana.verify');

    Route::post('userMana/requestChangeEmail', [UserController::class, 'requestChangeEmail'])->name('userMana.requestChangeEmail');

    Route::get('userMana/confirmChangeEmail/{token}', [UserController::class, 'confirmChangeEmail'])->name('userMana.confirmChangeEmail');

    Route::post('userMana/changePassword', [UserController::class, 'changePassword'])->name('userMana.changePassword');

    Route::post('userMana/changeAvatar', [UserController::class, 'changeAvatar'])->name('userMana.changeAvatar');
});

Route::middleware(['verified', 'userChecked'])->group(function () {

    Route::get('invoiceMana', [InvoiceController::class, 'index'])->name('invoiceMana.index');

    Route::get('invoiceMana/create', [InvoiceController::class, 'create'])->name('invoiceMana.create');

    Route::post('invoiceMana', [InvoiceController::class, 'store'])->name('invoiceMana.store');

    Route::get('invoiceMana/{invoiceMana}', [InvoiceController::class, 'show'])->name('invoiceMana.show');

    Route::get('invoiceMana/{invoiceMana}/edit', [InvoiceController::class, 'edit'])->name('invoiceMana.edit');

    Route::post('invoiceMana/update', [InvoiceController::class, 'update'])->name('invoiceMana.update');

    Route::post('invoiceMana/destroy', [InvoiceController::class, 'destroy'])->name('invoiceMana.destroy');

    Route::get('/downloadInvoice', [InvoiceController::class, 'downloadInvoice'])->name('downloadInvoice');

    Route::post('/previewInvoiceHTML', [InvoiceController::class, 'previewInvoiceHTML'])->name('previewInvoiceHTML');

    Route::post('/invoiceMana/changeInvoiceStatus', [InvoiceController::class, 'changeInvoiceStatus'])->name('invoiceMana.changeInvoiceStatus');

});

// ProjectController Routes
Route::middleware(['verified', 'userChecked'])->group(function () {

    Route::get('projectMana', [ProjectController::class, 'index'])->name('projectMana.index');

    Route::get('projectMana/create', [ProjectController::class, 'create'])->name('projectMana.create');

    Route::post('projectMana', [ProjectController::class, 'store'])->name('projectMana.store');

    Route::get('projectMana/{projectMana}', [ProjectController::class, 'show'])->name('projectMana.show');

    Route::get('projectMana/{projectMana}/edit', [ProjectController::class, 'edit'])->name('projectMana.edit');

    Route::post('projectMana/update', [ProjectController::class, 'update'])->name('projectMana.update');

    Route::post('projectMana/destroy', [ProjectController::class, 'destroy'])->name('projectMana.destroy');

});

// DepositController Routes
Route::middleware(['verified', 'userChecked'])->group(function () {

    Route::get('depositMana', [DepositController::class, 'index'])->name('depositMana.index');

    Route::get('depositMana/create', [DepositController::class, 'create'])->name('depositMana.create');

    Route::post('depositMana', [DepositController::class, 'store'])->name('depositMana.store');

    Route::get('depositMana/{depositMana}', [DepositController::class, 'show'])->name('depositMana.show');

    Route::get('depositMana/{id}/edit', [DepositController::class, 'edit'])->name('depositMana.edit');

    Route::post('depositMana/update', [DepositController::class, 'update'])->name('depositMana.update');

    Route::post('depositMana/delete', [DepositController::class, 'destroy'])->name('depositMana.delete');

});

// WithdrawController Routes
Route::middleware(['verified', 'userChecked'])->group(function () {

    Route::get('withdrawMana', [WithdrawController::class, 'index'])->name('withdrawMana.index');

    Route::get('withdrawMana/create', [WithdrawController::class, 'create'])->name('withdrawMana.create');

    Route::post('withdrawMana', [WithdrawController::class, 'store'])->name('withdrawMana.store');

    Route::get('withdrawMana/{withdrawMana}', [WithdrawController::class, 'show'])->name('withdrawMana.show');

    // Route::get('withdrawMana/{id}/edit', [WithdrawController::class, 'edit'])->name('withdrawMana.edit');

    Route::post('withdrawMana/update', [WithdrawController::class, 'update'])->name('withdrawMana.update');

    Route::post('withdrawMana/delete', [WithdrawController::class, 'destroy'])->name('withdrawMana.delete');

});

Route::get('/error/401', [ErrorController::class, 'error_401'])->name('error_401');
