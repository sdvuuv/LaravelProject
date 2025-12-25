<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'tags'])->published()->paginate(5);
        return ArticleResource::collection($articles);
    }

    public function show($id)
    {
        $article = Article::with(['category', 'tags'])->findOrFail($id);
            return new ArticleResource($article);
    }
}