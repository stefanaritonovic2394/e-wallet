@extends('layouts.app')

@section('content')
    <h1>Izmeni trošak</h1>
    {!! Form::open(['action' => ['ExpenseController@update', $expense->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('expense_category_id', 'Kategorija troška')}}
            {{Form::select('expense_category_id', $expense_categories, $expense->expense_category->id, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('entry_date', 'Datum unosa')}}
            {{Form::date('entry_date', $expense->entry_date, ['class' => 'form-control', 'placeholder' => ''])}}
        </div>
        <div class="form-group">
            {{Form::label('amount', 'Iznos')}}
            {{Form::text('amount', $expense->amount, ['class' => 'form-control', 'placeholder' => ''])}}
        </div>
        {{--<div class="form-group">--}}
            {{--{{Form::label('role_id', 'Rola')}}--}}
            {{--{{Form::select('role_id', $roles, $user->role->id, ['class' => 'form-control'])}}--}}
        {{--</div>--}}
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Izmeni', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection