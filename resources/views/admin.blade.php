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
                        <div class="mt-5">
                            <a href="/delete-apply/{{ $apply->id }}" class="btn btn-danger">Удалить заявку</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
