@extends('layouts.app')

@section('content')
    <h1>Izmeni prihod</h1>
    {!! Form::open(['action' => ['IncomeController@update', $income->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('income_category_id', 'Kategorija troška')}}
            {{Form::select('income_category_id', $income_categories, $income->income_category->id, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('entry_date', 'Datum unosa')}}
            {{Form::date('entry_date', $income->entry_date, ['class' => 'form-control', 'placeholder' => ''])}}
        </div>
        <div class="form-group">
            {{Form::label('amount', 'Iznos')}}
            {{Form::text('amount', $income->amount, ['class' => 'form-control', 'placeholder' => ''])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Izmeni', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection