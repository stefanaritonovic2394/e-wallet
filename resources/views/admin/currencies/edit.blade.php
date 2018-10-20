@extends('layouts.app')

@section('content')
    <h1>Izmeni valutu</h1>
    {!! Form::open(['action' => ['CurrencyController@update', $currency->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', 'Naziv')}}
            {{Form::text('title', $currency->title, ['class' => 'form-control', 'placeholder' => 'Unesite naziv'])}}
        </div>
        <div class="form-group">
            {{Form::label('symbol', 'Simbol')}}
            {{Form::text('symbol', $currency->symbol, ['class' => 'form-control', 'placeholder' => 'Unesite simbol'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Izmeni', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection