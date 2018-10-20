<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $currencies = Currency::orderBy('title', 'asc')->get();
        $currencies = Currency::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'symbol' => 'required'
        ]);

        // Kreiranje valute
        $currency = new Currency;
        $currency->title = $request->input('title');
        $currency->symbol = $request->input('symbol');
        $currency->save();

        return redirect('/currencies')->with('success', 'Valuta uspešno kreirana');

//        $currency = Currency::create($request->all());
//        return redirect()->route('admin.currencies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currency = Currency::findOrFail($id);
        return view('admin.currencies.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency = Currency::findOrFail($id);
        return view('admin.currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'symbol' => 'required'
        ]);

        // Azuriranje valute
        $currency = Currency::findOrFail($id);
        $currency->title = $request->input('title');
        $currency->symbol = $request->input('symbol');
        $currency->save();

        return redirect('/currencies')->with('success', 'Valuta uspešno ažurirana');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        $currency->delete();
        return redirect('/currencies')->with('success', 'Valuta uspešno uklonjena');
    }
}
