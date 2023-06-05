<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatusController;

use App\Http\Controllers\TestController;

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::group(['prefix' => 'todo', 'middleware' => 'login.check'], function () {
    Route::get('list', [TodoController::class, 'list']);
    
    Route::post('delete/{id}/', [TodoController::class, 'delete']); // 削除

    Route::get('detail/{id}/', [TodoController::class, 'detail']); // 詳細

    Route::get('create', [TodoController::class, 'create']);    // 入力
    Route::post('create-confirm', [TodoController::class, 'create_confirm']); // 確認
    Route::post('create-complete', [TodoController::class, 'create_complete']);  // 完了
    Route::get('create-complete', [TodoController::class, 'create_complete_view']);  // 完了画面表示


    Route::get('edit/{id}/', [TodoController::class, 'edit']);    // 編集
    Route::post('edit-confirm/{id}/', [TodoController::class, 'edit_confirm']); // 確認
    Route::post('edit-complete/{id}/', [TodoController::class, 'edit_complete']);  // 完了
    Route::get('edit-complete', [TodoController::class, 'edit_complete_view']);  // 完了
    
});

Route::group(['prefix' => 'user'], function () {
    Route::get('list', [UserController::class, 'list']);

    Route::post('delete/{id}/', [UserController::class, 'delete']); // 削除

    Route::get('detail/{id}/', [UserController::class, 'detail']); // 詳細

    Route::get('create', [UserController::class, 'create']);    // 入力
    Route::post('create-confirm', [UserController::class, 'create_confirm']); // 確認
    Route::post('create-complete', [UserController::class, 'create_complete']);  // 完了
    Route::get('create-complete', [UserController::class, 'create_complete_view']);  // 完了画面表示


    Route::get('edit/{id}/', [UserController::class, 'edit']);    // 編集
    Route::post('edit-confirm/{id}/', [UserController::class, 'edit_confirm']); // 確認
    Route::post('edit-complete/{id}/', [UserController::class, 'edit_complete']);  // 完了
    Route::get('edit-complete', [UserController::class, 'edit_complete_view']);  // 完了
});

Route::group(['prefix' => 'login'], function () {
    Route::get('/', [LoginController::class, 'login']);
    Route::post('/', [LoginController::class, 'post_login'])->name('login');
    Route::get('logout', [LoginController::class, 'logout']);
});


Route::group(['middleware' => 'login.check'], function(){
    Route::get('/', [MenuController::class, 'menu']);
});

Route::group(['prefix' => 'category', 'middleware' => 'login.check'], function () {
    Route::get('list', [CategoryController::class, 'list']);
    
    Route::post('delete/{id}/', [CategoryController::class, 'delete']); // 削除

    Route::get('detail/{id}/', [CategoryController::class, 'detail']); // 詳細

    Route::get('create', [CategoryController::class, 'create']);    // 入力
    Route::post('create-confirm', [CategoryController::class, 'create_confirm']); // 確認
    Route::post('create-complete', [CategoryController::class, 'create_complete']);  // 完了
    Route::get('create-complete', [CategoryController::class, 'create_complete_view']);  // 完了画面表示


    Route::get('edit/{id}/', [CategoryController::class, 'edit']);    // 編集
    Route::post('edit-confirm/{id}/', [CategoryController::class, 'edit_confirm']); // 確認
    Route::post('edit-complete/{id}/', [CategoryController::class, 'edit_complete']);  // 完了
    Route::get('edit-complete', [CategoryController::class, 'edit_complete_view']);  // 完了
    
});

Route::group(['prefix' => 'status', 'middleware' => 'auth.login.check'], function () {
    Route::get('list', [StatusController::class, 'list']);
    
    Route::post('delete/{id}/', [StatusController::class, 'delete']); // 削除

    Route::get('detail/{id}/', [StatusController::class, 'detail']); // 詳細

    Route::get('create', [StatusController::class, 'create']);    // 入力
    Route::post('create-confirm', [StatusController::class, 'create_confirm']); // 確認
    Route::post('create-complete', [StatusController::class, 'create_complete']);  // 完了
    Route::get('create-complete', [StatusController::class, 'create_complete_view']);  // 完了画面表示


    Route::get('edit/{id}/', [StatusController::class, 'edit']);    // 編集
    Route::post('edit-confirm/{id}/', [StatusController::class, 'edit_confirm']); // 確認
    Route::post('edit-complete/{id}/', [StatusController::class, 'edit_complete']);  // 完了
    Route::get('edit-complete', [StatusController::class, 'edit_complete_view']);  // 完了
    
});

Route::group(['prefix' => 'test', 'middleware' => 'login.check'], function () {
    Route::get('list', [TestController::class, 'list']);
    
    Route::post('delete/{id}/', [TestController::class, 'delete']); // 削除

    Route::get('detail/{id}/', [TestController::class, 'detail']); // 詳細

    Route::get('create', [TestController::class, 'create']);    // 入力
    Route::post('create-confirm', [TestController::class, 'create_confirm']); // 確認
    Route::post('create-complete', [TestController::class, 'create_complete']);  // 完了
    Route::get('create-complete', [TestController::class, 'create_complete_view']);  // 完了画面表示


    Route::get('edit/{id}/', [TestController::class, 'edit']);    // 編集
    Route::post('edit-confirm/{id}/', [TestController::class, 'edit_confirm']); // 確認
    Route::post('edit-complete/{id}/', [TestController::class, 'edit_complete']);  // 完了
    Route::get('edit-complete', [TestController::class, 'edit_complete_view']);  // 完了
    
});