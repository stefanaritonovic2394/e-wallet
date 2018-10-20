@extends('layouts.app')

@section('content')
    <h1>Kreiraj korisnika</h1>
    {!! Form::open(['action' => 'UserController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Ime')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Unesite ime'])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email')}}
            {{Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Unesite email adresu'])}}
        </div>
        <div class="form-group">
            {{Form::label('password', 'Lozinka')}}
            {{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Unesite lozinku'])}}
        </div>
        <div class="form-group">
            {{Form::label('role_id', 'Rola')}}
            {{Form::select('role_id', $roles, old('role_id'), ['class' => 'form-control'])}}
        </div>
        {{Form::submit('Kreiraj', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection