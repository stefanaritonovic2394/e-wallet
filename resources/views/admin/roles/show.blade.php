@extends('layouts.app')

@section('content')
    <a href="/roles" class="btn btn-secondary mb-2">Idi nazad</a>
    <div class="card">
        <div class="card-header">
            Rola {{--{{$role->title}}--}}
        </div>
        <div class="card-body">
            <h5 class="card-title">Naziv: {{$role->name}}</h5>
        </div>
    </div>
    <hr>
    <a href="/roles/{{$role->id}}/edit" class="btn btn-info">Izmeni</a>

    {!! Form::open(['action' => ['RoleController@destroy', $role->id], 'method' => 'POST', 'class' => 'float-right']) !!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Ukloni', ['class' => 'btn btn-danger'])}}
    {!! Form::close() !!}

    {{--<table class="table table-striped">--}}
        {{--<thead>--}}
            {{--<tr>--}}
                {{--<th>Ime</th>--}}
                {{--<th>Email</th>--}}
                {{--<th>Rola</th>--}}
                {{--<th>Pregled</th>--}}
                {{--<th>Izmeni</th>--}}
            {{--</tr>--}}
        {{--</thead>--}}
        {{--<tbody>--}}
            {{--@if(count($users) > 0)--}}
                {{--@foreach($users as $user)--}}
                    {{--<tr>--}}
                        {{--<td>{{$user->name}}</td>--}}
                        {{--<td>{{$user->email}}</td>--}}
                        {{--<td>{{$user->role->title}}</td>--}}
                        {{--<td>--}}
                            {{--<a href="/users/{{$user->id}}" class="btn btn-primary">Pregled</a>--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--<a href="/users/{{$user->id}}/edit" class="btn btn-info">Izmeni</a>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
            {{--@else--}}
                {{--<tr>--}}
                    {{--<td colspan="6">Ne postoje podaci</td>--}}
                {{--</tr>--}}
            {{--@endif--}}
        {{--</tbody>--}}
    {{--</table>--}}
@endsection