@extends('layouts.app')

@section('content')
    <h1>Kreiraj valutu</h1>
    {!! Form::open(['action' => 'CurrencyController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', 'Naziv')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Unesite naziv'])}}
        </div>
        <div class="form-group">
            {{Form::label('symbol', 'Simbol')}}
            {{Form::text('symbol', '', ['class' => 'form-control', 'placeholder' => 'Unesite simbol'])}}
        </div>
        {{Form::submit('Kreiraj', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection