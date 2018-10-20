@extends('layouts.app')

@section('content')
    <a href="/expense_categories" class="btn btn-secondary mb-2">Idi nazad</a>
    <div class="card">
        <div class="card-header">
            Kategorija troškova {{--{{$role->title}}--}}
        </div>
        <div class="card-body">
            <h5 class="card-title">Ime: {{$expense_category->name}}</h5>
            {{--<p class="card-text">Email: {{$user->email}}</p>--}}
        </div>
    </div>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $expense_category->created_by_id)
            <a href="/expense_categories/{{$expense_category->id}}/edit" class="btn btn-info">Izmeni</a>

            {!! Form::open(['action' => ['ExpenseCategoryController@destroy', $expense_category->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Ukloni', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
    @endif
@endsection