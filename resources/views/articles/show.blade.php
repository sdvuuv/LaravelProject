@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="container">
    <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary mb-3">&larr; Вернуться к списку</a>

    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-2">
            <h1 class="display-5 fw-bold">{{ $article->title }}</h1>
            
            <div class="mb-3 text-muted">
                <span>Категория: <strong>{{ $article->category->name }}</strong></span> | 
                <span>Дата: {{ $article->created_at->format('d.m.Y H:i') }}</span>
            </div>

            @if($article->tags->count())
                <div class="mb-3">
                    @foreach($article->tags as $tag)
                        <span class="badge bg-secondary">#{{ $tag->name }}</span>
                    @endforeach
                </div>
            @endif

            <p class="fs-5">{{ $article->content }}</p>

            <hr>
            <div class="mt-4">
                <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning">Редактировать</a>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h3>Комментарии</h3>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('articles.comments.store', $article) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="body" class="form-label">Ваш комментарий</label>
                        <textarea class="form-control" name="body" id="body" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>

        @forelse($article->comments->where('is_approved', true) as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    <p class="mb-1">{{ $comment->body }}</p>
                    <div class="text-muted small">{{ $comment->created_at->diffForHumans() }}</div>
                </div>
            </div>
        @empty
            <p class="text-muted">Комментариев пока нет.</p>
        @endforelse
    </div>
</div>
@endsection