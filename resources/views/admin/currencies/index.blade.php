@extends('layouts.app')

@section('content')
    <h1>Valute</h1>
    <a href="/currencies/create" class="btn btn-success mb-2">Kreiraj novu valutu</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Naziv</th>
                <th>Simbol</th>
                <th>Opcije</th>
            </tr>
        </thead>
        <tbody>
            @if(count($currencies) > 0)
                @foreach($currencies as $currency)
                    <tr>
                        <td>{{$currency->title}}</td>
                        <td>{{$currency->symbol}}</td>
                        <td>
                            <a href="/currencies/{{$currency->id}}" class="btn btn-primary">Pregled</a>
                        </td>
                    </tr>
                @endforeach
                {{$currencies->links()}}
            @else
                <tr>
                    <td colspan="6">Ne postoje valute</td>
                </tr>
            @endif
        </tbody>
    </table>
    {{--@foreach($currencies as $currency)--}}
        {{--<div class="card">--}}
            {{--<h3>{{$currency->title}}</h3>--}}
        {{--</div>--}}
    {{--@endforeach--}}
    {{--<ul class="list-group">--}}
        {{--@foreach($currencies as $currency)--}}
            {{--<li class="list-group-item">{{$currency->title}}</li>--}}
        {{--@endforeach--}}
    {{--</ul>--}}
@endsection