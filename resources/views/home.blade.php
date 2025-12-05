@extends('layouts.app')

@section('title', 'Главная - MyBlog')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Добро пожаловать в сюда</h1>
            <p class="col-md-8 fs-4">Я как новый марк цукенберг и не придумала ничего нового кроме как багованный яндекс дзен на коленке моего авторства</p>
            
            <div class="mt-4">
                <a href="{{ route('articles.index') }}" class="btn btn-primary btn-lg me-2" type="button">Читать статьи</a>
                <a href="{{ route('feedback.create') }}" class="btn btn-outline-secondary btn-lg" type="button">Написать нам</a> <!-- мне и моей шизе-->
            </div>
        </div>
    </div>

    <div class="row align-items-md-stretch">
        <div class="col-md-6">
            <div class="h-100 p-5 text-bg-dark rounded-3">
                <h2>Свежий контент</h2>
                <p>Мы публикуем актуальные новости (нет). Заходите в раздел блога.</p>
                <a href="{{ route('articles.index') }}" class="btn btn-outline-light" type="button">Перейти в блог</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                <h2>Ваше мнение важно (нет.)</h2>
                <p>Нашли ошибку или хотите предложить тему для новой статьи? Воспользуйтесь формой обратной связи (программист не переносит критики не пишите ей)</p>
                <a href="{{ route('feedback.create') }}" class="btn btn-outline-secondary" type="button">Оставить сообщение</a>
            </div>
        </div>
    </div>
@endsection