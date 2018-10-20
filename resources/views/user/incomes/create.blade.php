@extends('layouts.app')

@section('content')
    <h1>Kreiraj prihod</h1>
    {!! Form::open(['action' => 'IncomeController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('income_category_id', 'Kategorija prihoda')}}
            {{Form::select('income_category_id', $income_categories, old('income_category_id'), ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('entry_date', 'Datum unosa')}}
            {{Form::date('entry_date', old('entry_date'), ['class' => 'form-control', 'placeholder' => ''])}}
        </div>
        <div class="form-group">
            {{Form::label('amount', 'Iznos')}}
            {{Form::text('amount', old('amount'), ['class' => 'form-control', 'placeholder' => ''])}}
        </div>
        {{Form::submit('Kreiraj', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection