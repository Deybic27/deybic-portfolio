<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodosController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\FeeCreditController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostCategoriesController;
use App\Http\Controllers\GmailController;

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

// Autenticación para servicio de Google - Gmail
Route::get('/google/oauth', [GmailController::class, 'getCode']);
Route::get('/google/oauth/token', [GmailController::class, 'getToken']);

// Enviar email
// Route::get('/email/send', [GmailController::class, 'sendMail']);

// Default
Route::get('/', function () {
    return view('home_portfolio');
});

Route::get('/tecnología', function () {
    return view('home_technology');
})->name('technology');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Tareas
Route::get('/tareas', [TodosController::class, 'index'])->middleware(['auth'])->name('todos');
Route::post('/tareas',[TodosController::class, 'store'])->middleware(['auth'])->name('todos');
Route::get('/tareas/{id}',[TodosController::class, 'show'])->middleware(['auth'])->name('todos-show');
Route::patch('/tareas/{id}',[TodosController::class, 'update'])->middleware(['auth'])->name('todos-update');
Route::delete('/tareas/{id}',[TodosController::class, 'destroy'])->middleware(['auth'])->name('todos-destroy');

// Categorías
Route::resource('categories', CategoriesController::class)->middleware(['auth']);

// Peoples
Route::resource('peoples', PeopleController::class)->middleware(['auth']);
Route::get('/new-people', function () {
    return view('people.new');
})->middleware(['auth'])->name('newpeople');

// Credit
Route::resource('credits', CreditController::class)->middleware(['auth']);
Route::get('/credit', function () {
    return view('credit.simulator.index');
})->middleware(['auth'])->name('credit');
Route::get('/detailcredit', [CreditController::class, 'index'])->middleware(['auth'])->name('detailcredit');
Route::get('/feescredit/{id}',[FeeCreditController::class, 'store'])->middleware(['auth'])->name('storefee');

// Blog
Route::get('/blog', function () {
    return view('blog.app');
});
Route::resource('post-categories', PostCategoriesController::class)->middleware(['auth']);
Route::resource('posts', PostsController::class)->middleware(['auth']);
Route::get('/blog/{post}',[PostsController::class, 'show'])->name('blog-show');

// Auths
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin
Route::get('/admin-blog', [PostCategoriesController::class, "index"])->middleware(['auth'])->name('admin-blog');

require __DIR__.'/auth.php';
