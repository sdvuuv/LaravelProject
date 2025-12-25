<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Events\CommentReceived;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $validated = $request->validate([
            'body' => 'required|min:3|max:500'
        ]);

        $comment = $article->comments()->create([
            'body' => $validated['body'],
            'is_approved' => false, // Скрыт по умолчанию
        ]);

        CommentReceived::dispatch($comment);

        return back()->with('success', 'Комментарий отправлен на модерацию!');
    }
}