<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(OrderController::class)->group(function(){
    Route::post('/order/{book}', 'order')->middleware(['auth'])->name('order');
    Route::get('/my-orders', 'user_orders')->middleware(['auth'])->name('my-orders');

    Route::get('/orders','index')->middleware(['admin','auth'])->name('order-dashboard');
    Route::get('/order/{order}', 'order_info')->middleware(['auth'])->name('order-info');
});

Route::controller(BookController::class)->group(function(){
    Route::get('/books', 'index')->middleware(['auth'])->name('books');
    Route::get('/dashboard', 'book_dashboard')->middleware(['auth', 'admin'])->name('dashboard');
    Route::get('/book/{book}', 'edit_book')->middleware(['auth', 'admin'])->name('edit-book');
    Route::patch('/book/{book}', 'save_book')->middleware(['auth','admin'])->name('save-book');
    Route::get('/create-book', 'create')->middleware(['auth','admin'])->name('add-book');
    Route::post('/create-book', 'create_book')->middleware(['auth','admin'])->name('create-book');
    Route::delete('/book/{book}','destroy')->middleware(['auth', 'admin'])->name('delete-book');
    Route::get('/featured', 'featured_books')->name('featured');
});

require __DIR__.'/auth.php';
