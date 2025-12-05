@extends('layouts.app')

@section('title', 'Редактирование статьи')

@section('content')
<div class="container">
    <h1>Редактирование: {{ $article->title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', $article) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT') 

        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $article->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Категория</label>
            <select class="form-select" name="category_id" id="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ (old('category_id', $article->category_id) == $category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label d-block">Теги</label>
            @foreach($tags as $tag)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}"
                        @if(is_array(old('tags')))
                            {{ in_array($tag->id, old('tags')) ? 'checked' : '' }}
                        @else
                            {{ $article->tags->contains($tag->id) ? 'checked' : '' }}
                        @endif
                    >
                    <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Содержимое</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $article->content) }}</textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_published" name="is_published" 
                {{ old('is_published', $article->is_published) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_published">Опубликовано</label>
        </div>

        <button type="submit" class="btn btn-primary">Обновить</button>
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection