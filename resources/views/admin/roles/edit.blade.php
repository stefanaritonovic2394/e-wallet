@extends('layouts.app')

@section('content')
    <h1>Izmeni rolu</h1>
    {!! Form::open(['action' => ['RoleController@update', $role->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Naziv')}}
            {{Form::text('name', $role->name, ['class' => 'form-control', 'placeholder' => 'Unesite naziv'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Izmeni', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection