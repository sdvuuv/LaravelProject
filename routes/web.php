<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');

Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/feedback/list', [FeedbackController::class, 'index'])->name('feedback.index');
Route::resource('articles', ArticleController::class);

Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('articles.comments.store');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments.index');
    Route::patch('/comments/{comment}/approve', [AdminCommentController::class, 'approve'])->name('comments.approve');
    Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');
});