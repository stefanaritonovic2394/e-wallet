@extends('layouts.app')

@section('content')
    <h1>Kategorije troškova</h1>
    <a href="/expense_categories/create" class="btn btn-success mb-2">Kreiraj novu kategoriju</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ime</th>
                <th>Pregled</th>
            </tr>
        </thead>
        <tbody>
            @if(count($expense_categories) > 0)
                @foreach($expense_categories as $expense_category)
                    <tr>
                        <td>{{$expense_category->name}}</td>
                        <td>
                            <a href="/expense_categories/{{$expense_category->id}}" class="btn btn-primary">Pregled</a>
                        </td>
                    </tr>
                @endforeach
                {{--{{$roles->links()}}--}}
            @else
                <tr>
                    <td colspan="6">Ne postoje kategorije troškova</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection