<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;


Route::get('/',[AuthController::class,'login'])->name('login');
Route::post('/',[AuthController::class,'handeLogin'])->name('handeLogin');
//Route securiser

Route::middleware('auth')->group(function(){

Route::get('/dashboard',[AppController::class,'index'])->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/validate-account/{email}', [AdminController::class, 'defineAccess']);
Route::post('/validate-account/{email}', [AdminController::class, 'submitDefineAccess'])->name('submitDefineAccess');


Route::prefix('departement')->group(function(){
  Route::get('/',[DepartementController::class,'index'])->name('departements.index');
  Route::get('/create',[DepartementController::class,'create'])->name('departements.create');
  Route::post('/create',[DepartementController::class,'store'])->name('departements.store');
  Route::get('/edit/{departement}',[DepartementController::class,'edit'])->name('departements.edit');
  Route::put('/update/{departement}',[DepartementController::class,'update'])->name('departements.update');
  Route::get('/{departement}',[DepartementController::class,'delete'])->name('departements.delete');

});

Route::prefix('employers')->group(function(){
    Route::get('/', [EmployeController::class, 'index'])->name('employers.index');
    Route::get('/create', [EmployeController::class, 'create'])->name('employers.create');
    Route::post('/store', [EmployeController::class, 'store'])->name('employers.store');
    Route::get('/edit/{employe}', [EmployeController::class, 'edit'])->name('employers.edit');
    Route::put('/update/{employe}', [EmployeController::class, 'update'])->name('employers.update');
    Route::delete('/delete/{employe}', [EmployeController::class, 'delete'])->name('employers.delete');
});

Route::prefix('configurations')->group(function(){
    Route::get('/', [ConfigurationController::class, 'index'])->name('configurations');
    Route::get('/create', [ConfigurationController::class, 'create'])->name('configurations.create');
    Route::post('/store', [ConfigurationController::class, 'store'])->name('configurations.store');
    Route::delete('/delete/{configuration}', [ConfigurationController::class, 'delete'])->name('configurations.delete');
});

//Route pour l'admin

Route::prefix('administrateurs')->group(function (){
    Route::get('/',[AdminController::class, 'index'])->name('administrateurs.index');
    Route::get('/create', [AdminController::class, 'create'])->name('administrateurs.create');
    Route::post('/store', [AdminController::class, 'store'])->name('administrateurs.store');
   // Route::get('/edit/{administrateur}', [AdminController::class, 'edit'])->name('administrateurs.edit');
   // Route::put('/update/{administrateur}', [AdminController::class, 'update'])->name('administrateurs.update');
    Route::delete('/delete/{user}', [AdminController::class, 'delete'])->name('administrateurs.delete');
});

Route::prefix('payments')->group(function (){
    Route::get('/',[PaymentController::class,'index'])->name('payments');
    Route::get('/make',[PaymentController::class,'initPayment'])->name('payments.init');
    Route::get('/payment-invoice/{payment}',[PaymentController::class,'downloadInvoice'])->name('payments.download');
});

});

