@extends('layouts.app')

@section('title', 'Модерация комментариев')

@section('content')
    <h1>Модерация комментариев</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($comments->isEmpty())
        <p>Нет новых комментариев на проверку.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Статья</th>
                    <th>Текст</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>
                            <a href="{{ route('articles.show', $comment->commentable_id) }}">
                                Статья #{{ $comment->commentable_id }}
                            </a>
                        </td>
                        <td>{{ $comment->body }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <form action="{{ route('admin.comments.approve', $comment) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-success btn-sm">Одобрить</button>
                                </form>
                                <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection