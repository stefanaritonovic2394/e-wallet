<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
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
//        $expenses = Expense::all();
//        return view('admin.expenses.index', compact('expenses'));

        $created_by_id = auth()->user()->id;
        $user = User::findOrFail($created_by_id);
        return view('user.expenses.index')->with('expenses', $user->expenses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $created_by_id = auth()->user()->id;
        $expense_categories = ExpenseCategory::get()->where('created_by_id', $created_by_id)->pluck('name', 'id')->prepend(trans('Odaberite kategoriju'), '');
        $created_bies = User::get()->pluck('name', 'id')->prepend(trans('Odaberite korisnika'), '');
        return view('user.expenses.create', compact('expense_categories', 'created_bies'));
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
            'expense_category_id' => 'required',
//            'created_by_id' => 'required'
        ]);

        // Kreiranje troska
        $expense = new Expense;
        $expense->entry_date = $request->input('entry_date');
        $expense->amount = $request->input('amount');
        $expense->currency_id = auth()->user()->currency_id;
        $expense->expense_category_id = $request->input('expense_category_id');
        $expense->created_by_id = auth()->user()->id;
//        $expense->created_by_id = $request->input('created_by_id');
        $expense->save();

        return redirect('/expenses')->with('success', 'Trošak uspešno kreiran');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::findOrFail($id);

        // Provera ispravnog korisnika
        if (auth()->user()->id !== $expense->created_by_id) {
            return redirect('/expenses')->with('error', 'Nemate pravo da vidite ovu stranu');
        }

        return view('user.expenses.show', compact('expense'));
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
        $expense_categories = ExpenseCategory::get()->where('created_by_id', $created_by_id)->pluck('name', 'id')->prepend(trans('Odaberite kategoriju'), '');
        $created_bies = User::get()->pluck('name', 'id')->prepend(trans('Odaberite korisnika'), '');

        $expense = Expense::findOrFail($id);

        // Provera ispravnog korisnika
        if (auth()->user()->id !== $expense->created_by_id) {
            return redirect('/expenses')->with('error', 'Nemate pravo da vidite ovu stranu');
        }

        return view('user.expenses.edit', compact('expense', 'expense_categories', 'created_bies'));
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
            'expense_category_id' => 'required',
//            'created_by_id' => 'required'
        ]);

        // Azuriranje troska
        $expense = Expense::findOrFail($id);
        $expense->entry_date = $request->input('entry_date');
        $expense->amount = $request->input('amount');
        $expense->expense_category_id = $request->input('expense_category_id');
        $expense->save();

        return redirect('/expenses')->with('success', 'Trošak uspešno ažuriran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);

        // Provera ispravnog korisnika
        if (auth()->user()->id !== $expense->created_by_id) {
            return redirect('/expenses')->with('error', 'Nemate pravo da vidite ovu stranu');
        }

        $expense->delete();
        return redirect('/expenses')->with('success', 'Trošak uspešno uklonjen');
    }
}
