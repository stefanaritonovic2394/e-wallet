@extends('layouts.app')

@section('content')
    <h1>Korisnici</h1>
    <a href="/users/create" class="btn btn-success mb-2">Kreiraj novog korisnika</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ime</th>
                <th>Email</th>
                <th>Rola</th>
                <th>Pregled</th>
            </tr>
        </thead>
        <tbody>
            @if(count($users) > 0)
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role->name}}</td>
                        <td>
                            <a href="/users/{{$user->id}}" class="btn btn-primary">Pregled</a>
                        </td>
                    </tr>
                @endforeach
                {{--{{$roles->links()}}--}}
            @else
                <tr>
                    <td colspan="6">Ne postoje korisnici</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection