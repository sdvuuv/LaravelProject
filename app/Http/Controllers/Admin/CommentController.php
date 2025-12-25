<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Список комментариев на модерацию
    public function index()
    {
        $comments = Comment::where('is_approved', false)->with('commentable')->latest()->get();
        return view('admin.comments.index', compact('comments'));
    }

    // Одобрить
    public function approve(Comment $comment)
    {
        $comment->update(['is_approved' => true]);
        return back()->with('success', 'Комментарий одобрен.');
    }

    // Удалить
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Комментарий удален.');
    }
}