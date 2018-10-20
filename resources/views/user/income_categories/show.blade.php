@extends('layouts.app')

@section('content')
    <a href="/income_categories" class="btn btn-secondary mb-2">Idi nazad</a>
    <div class="card">
        <div class="card-header">
            Kategorija prihoda {{--{{$role->title}}--}}
        </div>
        <div class="card-body">
            <h5 class="card-title">Ime: {{$income_category->name}}</h5>
            {{--<p class="card-text">Email: {{$user->email}}</p>--}}
        </div>
    </div>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $income_category->created_by_id)
            <a href="/income_categories/{{$income_category->id}}/edit" class="btn btn-info">Izmeni</a>

            {!! Form::open(['action' => ['IncomeCategoryController@destroy', $income_category->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Ukloni', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
    @endif
@endsection