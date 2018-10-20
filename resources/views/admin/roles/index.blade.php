@extends('layouts.app')

@section('content')
    <h1>Role</h1>
    <a href="/roles/create" class="btn btn-success mb-2">Kreiraj novu rolu</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Naziv</th>
                <th>Pregled</th>
            </tr>
        </thead>
        <tbody>
            @if(count($roles) > 0)
                @foreach($roles as $role)
                    <tr>
                        <td>{{$role->name}}</td>
                        <td>
                            <a href="/roles/{{$role->id}}" class="btn btn-primary">Pregled</a>
                        </td>
                    </tr>
                @endforeach
                {{--{{$roles->links()}}--}}
            @else
                <tr>
                    <td colspan="6">Ne postoje role</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection