@extends('layouts.app')

@section('title', 'Все отзывы')

@section('content')
    <h2>Полученные данные</h2>

    @if(empty($feedbacks))
        <p>Записей пока нет.</p>
    @else
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Сообщение</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feedbacks as $item)
                    <tr>
                        <td>{{ $item['timestamp'] ?? '-' }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['email'] }}</td>
                        <td>{{ $item['message'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection