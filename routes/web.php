<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // To show profile info
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
});

require __DIR__.'/auth.php';
Route::get('products', 'ProductController@index')->name('products.index');

Route::resource('products', ProductController::class);

Route::get('/products/{id}/lend/{lender}/{days}', [LendingController::class, 'lend']);
Route::get('/products/{id}/return', [LendingController::class, 'return']);
Route::get('/{id}/accept', [LendingController::class, 'accept']);

Route::get('/reviews/create/{lending_id}', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews/store/{lending_id}', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('/block/{user}', [AdminController::class, 'blockUser']);
Route::get('/unblock/{user}', [AdminController::class, 'unblockUser']);
