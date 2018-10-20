@extends('layouts.app')

@section('content')
    <a href="/currencies" class="btn btn-secondary mb-2">Idi nazad</a>
    <div class="card">
        <div class="card-header">
            {{$currency->title}}
        </div>
        <div class="card-body">
            <h5 class="card-title">Naziv: {{$currency->title}}</h5>
            <p class="card-text">Simbol: {{$currency->symbol}}</p>
        </div>
    </div>
    <hr>
    <a href="/currencies/{{$currency->id}}/edit" class="btn btn-info">Izmeni</a>

    {!! Form::open(['action' => ['CurrencyController@destroy', $currency->id], 'method' => 'POST', 'class' => 'float-right']) !!}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Ukloni', ['class' => 'btn btn-danger']) }}
    {!! Form::close() !!}
    {{--<div class="card">--}}
        {{--<div class="card-header">--}}
            {{--{{$currency->title}}--}}
        {{--</div>--}}
        {{--<ul class="list-group list-group-flush">--}}
            {{--<li class="list-group-item">Naziv: {{$currency->title}}</li>--}}
            {{--<li class="list-group-item">Simbol: {{$currency->symbol}}</li>--}}
        {{--</ul>--}}
    {{--</div>--}}
@endsection