@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Заявки</h1>
        <div class="cards">
            @foreach($applies as $apply)
                <div class="card mb-4">
                    <div class="card-header">Заявка №{{ $apply->id }}</div>
                    <div class="card-body">
                        <p>Машина - <b>{{ $apply->time->car->name }}</b></p>
                        <p>Время - <b>{{ $apply->time->name }}</b></p>
                        <p>Имя - <b>{{ $apply->name . ' ' . $apply->last_name }}</b></p>
                        <p>Телефон - <b>{{ $apply->phone }}</b></p>
                        <p>E-mail - <b>{{ $apply->email }}</b></p>
                        @if (!$apply->email_verified)
                            <p class="text-danger font-weight-bold">Не подтверждено</p>
                        @else
                            <p class="text-success font-weight-bold">Подтверждено</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
