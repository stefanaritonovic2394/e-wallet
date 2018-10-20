@extends('layouts.app')

@section('content')
    <a href="/users" class="btn btn-secondary mb-2">Idi nazad</a>
    <div class="card">
        <div class="card-header">
            Korisnik {{--{{$role->title}}--}}
        </div>
        <div class="card-body">
            <h5 class="card-title">Ime: {{$user->name}}</h5>
            <p class="card-text">Email: {{$user->email}}</p>
            <p class="card-text">Rola: {{$user->role->name}}</p>
        </div>
    </div>
    <hr>
    <a href="/users/{{$user->id}}/edit" class="btn btn-info">Izmeni</a>

    {!! Form::open(['action' => ['UserController@destroy', $user->id], 'method' => 'POST', 'class' => 'float-right']) !!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Ukloni', ['class' => 'btn btn-danger'])}}
    {!! Form::close() !!}
@endsection