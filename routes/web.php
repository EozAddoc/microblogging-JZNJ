<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostsController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil e', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('posts', PostController::class);
Route::get('/allposts', [PostController::class, 'index'])->name('allposts.index');
Route::get('/addPost', [PostController::class, 'create'])->name('insertPost.create');
Route::post('addPost', [PostController::class, 'store']);

Route::get('allposts/{id}', function ($id) {
    $posts = App\Models\Post::all()->where('user_id', $id);
    return view('posts.index', compact('posts'));
});

Route::get('profilePage',[PostController::class, 'userPosts'] )->name('profilePage.userPosts');

require __DIR__.'/auth.php';
