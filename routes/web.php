<?php

use App\Http\Controllers\TeamController;
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

Route::get('/teams', [TeamController::class, 'index'])->name('team.index');

Route::get('/team/add', [TeamController::class, 'add'])->name('team.add');
Route::post('/team/add', [TeamController::class, 'store'])->name('team.store');

Route::get('/team/edit', [TeamController::class, 'edit'])->name('team.edit');
Route::put('/team/edit', [TeamController::class, 'update'])->name('team.update');

Route::delete('/team/delete', [TeamController::class, 'delete'])->name('team.delete');

Route::get('/team/search', [TeamController::class, 'search'])->name('team.search');
Route::get('/team/search-result', [TeamController::class, 'searchResult'])->name('team.searchResult');
Route::get('/team/export', [TeamController::class, 'export'])->name('team.export');




