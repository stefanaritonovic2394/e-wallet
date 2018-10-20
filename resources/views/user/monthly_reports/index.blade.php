@extends('layouts.app')

@section('content')
    <h1>Mesečni izveštaj</h1>

    {!! Form::open(['method' => 'GET']) !!}
        <div class="row">
            <div class="col-2 col-md-2 form-group">
                {!! Form::label('year', 'Godina', ['class' => 'control-label']) !!}
                {!! Form::select('y', array_combine(range(date("Y"), 1900), range(date("Y"), 1900)), old('y', Request::get('y', date('Y'))), ['class' => 'form-control']) !!}
            </div>
            <div class="col-2 col-md-2 form-group">
                {!! Form::label('month', 'Mesec', ['class' => 'control-label']) !!}
                {!! Form::select('m', cal_info(0)['months'], old('m', Request::get('m', date('m'))), ['class' => 'form-control']) !!}
            </div>
            <div class="col-4">
                <label class="control-label">&nbsp;</label><br>
                {!! Form::submit('Odaberite mesec', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Izveštaj
            </div>
            {!! Form::close() !!}
            <div class="card-body">
                <div class="row">
                    @if(auth()->user()->currency->symbol == 'din')
                        <div class="col-md-4">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Prihodi</th>
                                    <td>{{number_format($inc_total, 2) . ' ' . auth()->user()->currency->symbol . ' ('. number_format($inc_total / $srednji, 2) . ' eur' .')'}}</td>
                                </tr>
                                <tr>
                                    <th>Troškovi</th>
                                    <td>{{number_format($exp_total, 2) . ' ' . auth()->user()->currency->symbol . ' ('. number_format($exp_total / $srednji, 2) . ' eur' .')'}}</td>
                                </tr>
                                <tr>
                                    <th>Trenutno stanje</th>
                                    <td>{{number_format($profit, 2) . ' ' . auth()->user()->currency->symbol . ' ('. number_format($profit / $srednji, 2) . ' eur' .')'}}</td>
                                </tr>
                            </table>
                        </div>
                    @elseif(auth()->user()->currency->symbol == '€')
                        <div class="col-md-4">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Prihodi</th>
                                    <td>{{number_format($inc_total, 2) . ' ' . auth()->user()->currency->symbol . ' ('. number_format($inc_total * $srednji, 2) . ' din' .')'}}</td>
                                </tr>
                                <tr>
                                    <th>Troškovi</th>
                                    <td>{{number_format($exp_total, 2) . ' ' . auth()->user()->currency->symbol . ' ('. number_format($exp_total * $srednji, 2) . ' din' .')'}}</td>
                                </tr>
                                <tr>
                                    <th>Trenutno stanje</th>
                                    <td>{{number_format($profit, 2) . ' ' . auth()->user()->currency->symbol . ' ('. number_format($profit * $srednji, 2) . ' din' .')'}}</td>
                                </tr>
                            </table>
                        </div>
                    @else
                        <div class="col-md-4">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Prihodi</th>
                                    <td>{{number_format($inc_total, 2) . ' ' . auth()->user()->currency->symbol}}</td>
                                </tr>
                                <tr>
                                    <th>Troškovi</th>
                                    <td>{{number_format($exp_total, 2) . ' ' . auth()->user()->currency->symbol}}</td>
                                </tr>
                                <tr>
                                    <th>Trenutno stanje</th>
                                    <td>{{number_format($profit, 2) . ' ' . auth()->user()->currency->symbol}}</td>
                                </tr>
                            </table>
                        </div>
                    @endif
                    <div class="col-md-4">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Prihodi po kategoriji</th>
                                <th>{{number_format($inc_total, 2) . ' ' . auth()->user()->currency->symbol}}</th>
                            </tr>
                            @foreach($inc_summary as $inc)
                                <tr>
                                    <th>{{$inc['name']}}</th>
                                    <td>{{number_format($inc['amount'], 2) . ' ' . auth()->user()->currency->symbol}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Troškovi po kategoriji</th>
                                <th>{{number_format($exp_total, 2) . ' ' . auth()->user()->currency->symbol}}</th>
                            </tr>
                            @foreach($exp_summary as $exp)
                                <tr>
                                    <th>{{$exp['name']}}</th>
                                    <td>{{number_format($exp['amount'], 2) . ' ' . auth()->user()->currency->symbol}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                {{--<div class="row">--}}
                    {{--Srednji kurs: {{$srednji}}--}}
                    {{--Kupovni: {{$kupovni}}--}}
                    {{--Prodajni: {{$prodajni}}--}}
                {{--</div>--}}
            </div>
        </div>
@endsection