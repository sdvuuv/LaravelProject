@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Добро пожаловать</h1>
            <a href="{{ route('feedback.create') }}" class="btn btn-primary btn-lg" type="button">Написать нам</a>
        </div>
    </div>
@endsection