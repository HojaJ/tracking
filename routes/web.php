<?php

use App\Http\Controllers\ShippingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\StorageController;
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

Route::get('redirects',[SiteController::class, 'redirects']);

// Route::get('folder.php',function () {
//     require __DIR__.'folder.php';
// });



Route::group(
    ['middleware' => ['localizationRedirect', 'localize'], 
    'prefix' => LaravelLocalization::setLocale()],
    function(){
        require __DIR__.'/auth.php';
        Route::get('/', function () {return view('track');});

        Route::get('/dashboard', [SiteController::class, 'index'])->middleware('role:2')->name('dashboard');

        Route::get('/live_search', [CargoController::class, 'action'])->name('live_search');
        Route::get('/live_search_by_code', [CargoController::class, 'live_search_by_code'])->name('live_search_by_code');
        Route::get('/privacy', [CargoController::class, 'privacy'])->name('privacy');
        Route::get('/term-of-use', [CargoController::class, 'termOfUse'])->name('term_of_use');
        Route::get('/show_cargo/{id}', [CargoController::class, 'show_cargo'])->name('show_cargo');
    }
);

Route::group(
    ['middleware' => ['role:1','localizationRedirect', 'localize'],
        'prefix' => LaravelLocalization::setLocale() .'/admin'],

    function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::resource('/users', UserController::class, ['as'=> 'admin']);

    Route::get('user_code',[UserController::class, 'user_code'] )->name('user_code');
    Route::post('update_cargo',[CargoController::class, 'update_cargo'] )->name('update_cargo');

    Route::resource('/shipping', ShippingController::class, ['as'=> 'admin']);
    Route::resource('/cargo', CargoController::class, ['as'=> 'admin']);
    Route::post('archive_cargo',[CargoController::class, 'archive_cargo'] )->name('admin.archive_cargo.store');

    Route::post('cargo/delete',[CargoController::class, 'delete'] )->name('admin.cargo.delete');
    Route::post('container/delete',[ContainerController::class, 'delete'] )->name('admin.container.delete');
    Route::post('container/arhive',[ContainerController::class, 'arhive'] )->name('admin.container.arhive');


    Route::get('archive/{container}/edit',[ContainerController::class, 'edit'] )->name('admin.archive.edit');
    Route::put('container/{container}',[ContainerController::class, 'update'] )->name('admin.container.update');
    Route::post('container/editcon',[ContainerController::class, 'editContainer'] )->name('admin.container.editcon');


    Route::post('cargo/toContainer',[CargoController::class, 'toContainer'] )->name('admin.cargo.container');
    
    Route::get('/excel',[CargoController::class, 'excel'] )->name('admin.cargo.excel');

    Route::get('/excelcontainer',[ContainerController::class, 'excel'] )->name('admin.container.excel');

    Route::get('/archive',[ContainerController::class, 'inArchive'] )->name('admin.inArchive');
    
    Route::resource('/container', ContainerController::class, ['as'=> 'admin']);
    Route::get('storage/{id}/edit', [StorageController::class, 'index'])->name('admin.storage');
});