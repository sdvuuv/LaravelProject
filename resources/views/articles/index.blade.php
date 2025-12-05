@extends('layouts.app')

@section('title', 'Список статей')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Статьи блога</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">Создать статью</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse($articles as $article)
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>
                            <span class="badge bg-primary">{{ $article->category->name ?? 'Без категории' }}</span>
                            @if($article->is_published)
                                <span class="badge bg-success">Опубликовано</span>
                            @else
                                <span class="badge bg-secondary">Черновик</span>
                            @endif
                        </span>
                        <small class="text-muted">{{ $article->created_at->format('d.m.Y H:i') }}</small>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->content, 150) }}</p>
                        
                        @if($article->tags->count())
                            <div class="mb-2">
                                @foreach($article->tags as $tag)
                                    <span class="badge text-bg-light border">#{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-3">
                            <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-info text-white">Читать</a>
                            <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Вы уверены?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">Статей нету</div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $articles->links() }}
    </div>
</div>
@endsection