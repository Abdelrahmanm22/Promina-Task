<?php

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
    return redirect()->route('album.index');
});

Route::group(['prefix'=>'album'],function (){
   Route::get('/',[\App\Http\Controllers\Web\AlbumController::class,'index'])->name('album.index');
   Route::get('/create',[\App\Http\Controllers\Web\AlbumController::class,'store'])->name('album.store');
   Route::post('/store',[\App\Http\Controllers\Web\AlbumController::class,'create'])->name('album.create');
   Route::get('/edit/{id}',[\App\Http\Controllers\Web\AlbumController::class,'edit'])->name('album.edit');
   Route::post('/update/{id}',[\App\Http\Controllers\Web\AlbumController::class,'update'])->name('album.update');
    Route::delete('/delete/{id}', [\App\Http\Controllers\Web\AlbumController::class, 'destroy'])->name('album.delete');


    Route::delete('/delete-all-pictures/{id}', [\App\Http\Controllers\Web\PictureController::class, 'deleteAllPictures'])->name('album.deleteAllPictures');
    Route::post('/move-pictures/{id}', [\App\Http\Controllers\Web\PictureController::class, 'movePictures'])->name('album.movePictures');
   Route::delete('/delete-picture/{id}',[\App\Http\Controllers\Web\PictureController::class,'delete'])->name('album.picture.delete');

});
