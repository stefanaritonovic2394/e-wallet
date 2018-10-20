@extends('layouts.app')

@section('content')
    <a href="/expenses" class="btn btn-secondary mb-2">Idi nazad</a>
    <div class="card">
        <div class="card-header">
            Trošak {{--{{$role->title}}--}}
        </div>
        <div class="card-body">
            <h5 class="card-title">Kategorija troška: {{$expense->expense_category->name}}</h5>
            <p class="card-text">Datum unosa: {{$expense->entry_date}}</p>
            <p class="card-text">Valuta troška: {{$expense->expense_currency->symbol}}</p>
            <p class="card-text">Kreirao: {{$expense->created_by->name}}</p>
        </div>
    </div>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $expense->created_by_id)
            <a href="/expenses/{{$expense->id}}/edit" class="btn btn-info">Izmeni</a>

            {!! Form::open(['action' => ['ExpenseController@destroy', $expense->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Ukloni', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
    @endif
@endsection