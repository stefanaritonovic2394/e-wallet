@extends('layouts.app')

@section('content')
    <a href="/incomes" class="btn btn-secondary mb-2">Idi nazad</a>
    <div class="card">
        <div class="card-header">
            Prihod {{--{{$role->title}}--}}
        </div>
        <div class="card-body">
            <h5 class="card-title">Kategorija prihoda: {{$income->income_category->name}}</h5>
            <p class="card-text">Datum unosa: {{$income->entry_date}}</p>
            <p class="card-text">Valuta prihoda: {{$income->income_currency->symbol}}</p>
            <p class="card-text">Kreirao: {{$income->created_by->name}}</p>
        </div>
    </div>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $income->created_by_id)
            <a href="/incomes/{{$income->id}}/edit" class="btn btn-info">Izmeni</a>

            {!! Form::open(['action' => ['IncomeController@destroy', $income->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Ukloni', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
    @endif
@endsection