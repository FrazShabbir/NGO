<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ApprovePostController;


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

Route::get('/',[HomeController::class,'index'])->name('public.index');

Route::group(['middleware' => ['auth'],'prefix'=>'admin/dashboard'], function () {
    Route::get('/',[DashboardController::class,'isAdmin'])->name('isAdmin');
    Route::resource('post', PostController::class);
});


Route::group(['middleware'=>['auth'],'prefix'=>'user/dashboard'],function(){
    Route::get('/',[DashboardController::class,'isUser'])->name('isUser');
    Route::resource('admin-post', PostController::class);

});


Route::get('/dashboard', [DashboardController::class,'dashboard'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
