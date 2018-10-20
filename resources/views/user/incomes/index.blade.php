@extends('layouts.app')

@section('content')
    <h1>Prihodi</h1>
    <a href="/incomes/create" class="btn btn-success mb-2">Kreiraj novi prihod</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Kategorija prihoda</th>
                <th>Datum unosa</th>
                <th>Iznos</th>
                <th>Pregled</th>
            </tr>
        </thead>
        <tbody>
            @if(count($incomes) > 0)
                @foreach($incomes as $income)
                    <tr>
                        <td>{{$income->income_category->name}}</td>
                        <td>{{$income->entry_date}}</td>
                        <td>{{$income->amount . ' ' . $income->income_currency->symbol}}</td>
                        <td>
                            <a href="/incomes/{{$income->id}}" class="btn btn-primary">Pregled</a>
                        </td>
                    </tr>
                @endforeach
                {{--{{$roles->links()}}--}}
            @else
                <tr>
                    <td colspan="6">Ne postoje prihodi</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection