<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseCategoryController extends Controller
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
//        $expense_categories = ExpenseCategory::all();
//        return view('admin.expense_categories.index', compact('expense_categories'));

        $created_by_id = auth()->user()->id;
        $user = User::findOrFail($created_by_id);
        return view('user.expense_categories.index')->with('expense_categories', $user->expense_categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $created_bies = User::get()->pluck('name', 'id')->prepend(trans('Odaberite korisnika'), '');
        return view('user.expense_categories.create', compact('created_bies'));
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
            'name' => 'required'
        ]);

        // Kreiranje kategorije
        $expense_category = new ExpenseCategory;
        $expense_category->name = $request->input('name');
        $expense_category->created_by_id = auth()->user()->id;
        $expense_category->save();

        return redirect('/expense_categories')->with('success', 'Kategorija uspešno kreirana');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense_category = ExpenseCategory::findOrFail($id);

        // Provera ispravnog korisnika
        if (auth()->user()->id !== $expense_category->created_by_id) {
            return redirect('/expense_categories')->with('error', 'Nemate pravo da vidite ovu stranu');
        }

        $created_bies = User::get()->pluck('name', 'id')->prepend(trans('Odaberite korisnika'), '');
        $expenses = Expense::where('expense_category_id', $id)->get();
        return view('user.expense_categories.show', compact('expense_category', 'expenses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $created_bies = User::get()->pluck('name', 'id')->prepend(trans('Odaberite korisnika'), '');
        $expense_category = ExpenseCategory::findOrFail($id);

        // Provera ispravnog korisnika
        if (auth()->user()->id !== $expense_category->created_by_id) {
            return redirect('/expense_categories')->with('error', 'Nemate pravo da vidite ovu stranu');
        }

        return view('user.expense_categories.edit', compact('expense_category', 'created_bies'));
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
            'name' => 'required'
        ]);

        // Azuriranje kategorije
        $expense_category = ExpenseCategory::findOrFail($id);
        $expense_category->name = $request->input('name');
        $expense_category->save();

        return redirect('/expense_categories')->with('success', 'Kategorija uspešno ažurirana');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense_category = ExpenseCategory::findOrFail($id);

        // Provera ispravnog korisnika
        if (auth()->user()->id !== $expense_category->created_by_id) {
            return redirect('/expense_categories')->with('error', 'Nemate pravo da vidite ovu stranu');
        }

        $expense_category->delete();
        return redirect('/expense_categories')->with('success', 'Kategorija uspešno uklonjena');
    }
}
