@extends('layouts.app')

@section('content')
    <h1>Kategorije prihoda</h1>
    <a href="/income_categories/create" class="btn btn-success mb-2">Kreiraj novu kategoriju</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ime</th>
                <th>Pregled</th>
            </tr>
        </thead>
        <tbody>
            @if(count($income_categories) > 0)
                @foreach($income_categories as $income_category)
                    <tr>
                        <td>{{$income_category->name}}</td>
                        <td>
                            <a href="/income_categories/{{$income_category->id}}" class="btn btn-primary">Pregled</a>
                        </td>
                    </tr>
                @endforeach
                {{--{{$roles->links()}}--}}
            @else
                <tr>
                    <td colspan="6">Ne postoje kategorije prihoda</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection