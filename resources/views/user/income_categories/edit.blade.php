@extends('layouts.app')

@section('content')
    <h1>Izmeni kategoriju</h1>
    {!! Form::open(['action' => ['IncomeCategoryController@update', $income_category->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Naziv')}}
            {{Form::text('name', $income_category->name, ['class' => 'form-control', 'placeholder' => 'Unesite naziv'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Izmeni', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection