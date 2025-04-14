<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskDetailController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/tasks'); // ログイン済みならタスク画面へ
    }
    return view('welcome'); // ゲストならそのままwelcome
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () { //ログインされている場合にのみルーティングされる

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('tasks',[TaskController::class,'index'])->name('tasks');//タスク一覧
Route::post('tasks',[TaskController::class,'storeTask'])->name('store_task');//タスク保存
Route::delete('task/{id}',[TaskController::class,'destroyTask'])->name('destroy_task');//タスク削除
Route::get('task/{id}',[TaskDetailController::class,'editTask'])->name('edit_task');//タスク編集画面(取得)
Route::put('task/{id}',[TaskDetailController::class,'updateTask'])->name('update_task');//編集したタスクを更新

Route::put('task/{id}/checkbox',[TaskController::class,'renewCheckbox'])->name('renew_checkbox');//チェックボックスの状態を更新

Route::get('lists',[ListController::class,'index'])->name('lists');//追加したリストを表示(リスト追加ページ)リスト一覧
Route::post('lists',[ListController::class,'storeList'])->name('store_list');//リスト保存
Route::get('lits/{id}/name',[ListController::class,'editListName'])->name('edit_list_name');//リスト名編集(取得)
Route::put('list/{id}/name',[ListController::class,'updateListName'])->name('update_list_name');//リスト名を更新
Route::delete('list/{id}',[ListController::class,'removeList'])->name('remove_list');//リスト削除
Route::get('list/{id}/',[TaskDetailController::class,'listSetting'])->name('list_setting');//リスト設定画面(取得)


Route::put('task/{id}/sort',[TaskController::class,'sortTask'])->name('sort_task');//タスク並び替え


});


require __DIR__.'/auth.php';
