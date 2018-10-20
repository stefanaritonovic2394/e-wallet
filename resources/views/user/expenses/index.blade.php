@extends('layouts.app')

@section('content')
    <h1>Troškovi</h1>
    <a href="/expenses/create" class="btn btn-success mb-2">Kreiraj novi trošak</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Kategorija troška</th>
                <th>Datum unosa</th>
                <th>Iznos</th>
                <th>Pregled</th>
            </tr>
        </thead>
        <tbody>
            @if(count($expenses) > 0)
                @foreach($expenses as $expense)
                    <tr>
                        <td>{{$expense->expense_category->name}}</td>
                        <td>{{$expense->entry_date}}</td>
                        <td>{{$expense->amount . ' ' . $expense->expense_currency->symbol}}</td>
                        <td>
                            <a href="/expenses/{{$expense->id}}" class="btn btn-primary">Pregled</a>
                        </td>
                    </tr>
                @endforeach
                {{--{{$roles->links()}}--}}
            @else
                <tr>
                    <td colspan="6">Ne postoje troškovi</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection