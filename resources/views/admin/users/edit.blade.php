@extends('layouts.app')

@section('content')
    <h1>Izmeni korisnika</h1>
    {!! Form::open(['action' => ['UserController@update', $user->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Ime')}}
            {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Unesite ime'])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email')}}
            {{Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Unesite email adresu'])}}
        </div>
        <div class="form-group">
            {{Form::label('password', 'Lozinka')}}
            {{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Unesite lozinku'])}}
        </div>
        <div class="form-group">
            {{Form::label('role_id', 'Rola')}}
            {{Form::select('role_id', $roles, $user->role->id, ['class' => 'form-control'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Izmeni', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection