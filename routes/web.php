<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;





Route::middleware(['guest'])->group(function(){
	
	Route::get('/', function () {
    return view('welcome');
});
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::get('/login', [UserController::class, 'login'])->name('login');

});



Route::get('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
Route::delete('/avatar/delete', [UserController::class, 'deleteAvatar'])->name('deleteAvatar');
Route::post('/password/update', [UserController::class, 'updatePassword'])->name('updatePassword');


Route::get('/notifications', [UserController::class, 'notifications'])->name('users.notifications');

Route::get('/profile', [UserController::class, 'show'])->name('profile.show');


Route::post('/new-user', [UserController::class, 'newUser'])->name('newUser');
Route::post('/authenticate', [UserController::class, 'authenticate'])->name('authenticate');


Route::resource('topics', TopicController::class);

Route::post('/comments/{topic}', [CommentController::class, 'store'])->name('comments.store');
Route::post('commentReply/{comment}', [CommentController::class, 'commentReply'])->name('comments.reply');

Route::post('/markAsSoultion/{topic}/{comment}', [CommentController::class, 'commentmarkAsSoultion'])
       ->name('comments.commentmarkAsSoultion');


