<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // просмотр списка 
    public function index()
    {
        $articles = Article::with(['category', 'tags'])
            ->published()
            ->latest()
            ->paginate(10);

        return view('articles.index', compact('articles'));
    }

    // форма создания
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('articles.create', compact('categories', 'tags'));
    }

    // созранение
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',           
            'tags.*' => 'exists:tags,id',
        ]);

        $article = Article::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'is_published' => $request->has('is_published'),
        ]);

        if ($request->has('tags')) {
            $article->tags()->attach($request->tags);
        }

        return redirect()->route('articles.index')->with('success', 'Статья создана');
    }

    public function show(Article $article)
    {
        $article->load('comments'); 
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('articles.edit', compact('article', 'categories', 'tags'));
    }

    // обновление
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
        ]);

        $article->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'is_published' => $request->has('is_published'),
        ]);

        $article->tags()->sync($request->tags ?? []);

        return redirect()->route('articles.index')->with('success', 'Статья обновлена');
    }

    public function destroy(Article $article)
    {
        $article->delete(); 
        return redirect()->route('articles.index')->with('success', 'Статья удалена');
    }
}





