@extends('layouts.app')

@section('content')
    <h1>Kreiraj rolu</h1>
    {!! Form::open(['action' => 'RoleController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Naziv')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Unesite naziv'])}}
        </div>
        {{Form::submit('Kreiraj', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection