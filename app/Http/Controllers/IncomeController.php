<?php

namespace App\Http\Controllers;

use App\Income;
use App\IncomeCategory;
use App\User;
use Illuminate\Http\Request;

class IncomeController extends Controller
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
//        $incomes = Income::all();
//        return view('admin.incomes.index', compact('incomes'));

        $created_by_id = auth()->user()->id;
        $user = User::findOrFail($created_by_id);
        return view('user.incomes.index')->with('incomes', $user->incomes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $created_by_id = auth()->user()->id;
        $income_categories = IncomeCategory::get()->where('created_by_id', $created_by_id)->pluck('name', 'id')->prepend(trans('Odaberite kategoriju'), '');
        $created_bies = User::get()->pluck('name', 'id')->prepend(trans('Odaberite korisnika'), '');
        return view('user.incomes.create', compact('income_categories', 'created_bies'));
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
            'entry_date' => 'required',
            'amount' => 'required',
//            'currency_id' => 'required',
            'income_category_id' => 'required',
//            'created_by_id' => 'required'
        ]);

        // Kreiranje prihoda
        $income = new Income;
        $income->entry_date = $request->input('entry_date');
        $income->amount = $request->input('amount');
        $income->currency_id = auth()->user()->currency_id;
        $income->income_category_id = $request->input('income_category_id');
        $income->created_by_id = auth()->user()->id;
//        $income->created_by_id = $request->input('created_by_id');
        $income->save();

        return redirect('/incomes')->with('success', 'Prihod uspešno kreiran');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $income = Income::findOrFail($id);

        // Provera ispravnog korisnika
        if (auth()->user()->id !== $income->created_by_id) {
            return redirect('/incomes')->with('error', 'Nemate pravo da vidite ovu stranu');
        }

        return view('user.incomes.show', compact('income'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $created_by_id = auth()->user()->id;
        $income_categories = IncomeCategory::get()->where('created_by_id', $created_by_id)->pluck('name', 'id')->prepend(trans('Odaberite kategoriju'), '');
        $created_bies = User::get()->pluck('name', 'id')->prepend(trans('Odaberite korisnika'), '');

        $income = Income::findOrFail($id);

        // Provera ispravnog korisnika
        if (auth()->user()->id !== $income->created_by_id) {
            return redirect('/incomes')->with('error', 'Nemate pravo da vidite ovu stranu');
        }

        return view('user.incomes.edit', compact('income', 'income_categories', 'created_bies'));
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
            'entry_date' => 'required',
            'amount' => 'required',
//            'currency_id' => 'required',
            'income_category_id' => 'required',
//            'created_by_id' => 'required'
        ]);

        // Azuriranje prihoda
        $income = Income::findOrFail($id);
        $income->entry_date = $request->input('entry_date');
        $income->amount = $request->input('amount');
        $income->income_category_id = $request->input('income_category_id');
        $income->save();

        return redirect('/incomes')->with('success', 'Prihod uspešno ažuriran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $income = Income::findOrFail($id);

        // Provera ispravnog korisnika
        if (auth()->user()->id !== $income->created_by_id) {
            return redirect('/incomes')->with('error', 'Nemate pravo da vidite ovu stranu');
        }

        $income->delete();
        return redirect('/incomes')->with('success', 'Prihod uspešno uklonjen');
    }
}
