<?php

use Illuminate\Support\Facades\DB;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

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
    $posts = Post::all();
    $comments = Comment::all();

    return view('dashboard', compact('posts','comments'));
})->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/dashboard',[PostController::class, 'likePost'] )->name('dashboard.likePost');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil e', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('posts', PostController::class);

Route::get('/allposts', [PostController::class, 'index'])->name('allposts.index');
Route::post('/allposts',[ProfileController::class, 'follow'] )->name('allposts.follow');


Route::get('/addPost', [PostController::class, 'create'])->name('insertPost.create');
Route::post('addPost', [PostController::class, 'store']);

Route::get('updatePost/{post}', [PostController::class, 'updateForm'])->name('updatePost.updateForm');
Route::post('updatePost/{post}', [PostController::class, 'update'])->name('updatePost.update');

Route::get('user/{id}', function ($id) {
    $posts = App\Models\Post::all()->where('user_id', $id);
    $first = Post::all()->where('user_id', $id)->first();
    return view('profile.otherUserProfile', compact('posts', 'first'));
});

Route::get('/profilePage', [PostController::class, 'userPosts'])->name('profilePage.userPosts');
Route::patch('/profilePage', [PostController::class, 'update'])->name('profilePage.update');
Route::delete('profilePage/{post}', [PostController::class, 'destroy'])->name('profilePage.destroy');


Route::get('Comment/{postid}', [CommentController::class,'store'])->name('addComment.store');
Route::post('Comment/{postid}', [CommentController::class, 'store'])->name('addComment.store');

Route::post('/all',[ProfileController::class, 'unfollow'] )->name('allposts.unfollow');

Route::get('/users',[PostController::class,'search'] )->name('users.search');

Route::get('/followers',[ProfileController::class,'viewfollowers'] )->name('followers.viewfollowers');
Route::get('/followed',[ProfileController::class,'viewFollowedBy'] )->name('followed.viewFollowedBy');
require __DIR__ . '/auth.php';
