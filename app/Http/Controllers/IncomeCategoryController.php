<?php

namespace App\Http\Controllers;

use App\Income;
use App\IncomeCategory;
use App\User;
use Illuminate\Http\Request;

class IncomeCategoryController extends Controller
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
//        $income_categories = IncomeCategory::all();
//        return view('admin.income_categories.index', compact('income_categories'));

        $created_by_id = auth()->user()->id;
        $user = User::findOrFail($created_by_id);
        return view('user.income_categories.index')->with('income_categories', $user->income_categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $created_bies = User::get()->pluck('name', 'id')->prepend(trans('Odaberite korisnika'), '');
        return view('user.income_categories.create', compact('created_bies'));
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
        $income_category = new IncomeCategory;
        $income_category->name = $request->input('name');
        $income_category->created_by_id = auth()->user()->id;
        $income_category->save();

        return redirect('/income_categories')->with('success', 'Kategorija uspešno kreirana');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $created_bies = User::get()->pluck('name', 'id')->prepend(trans('Odaberite korisnika'), '');
        $income_category = IncomeCategory::findOrFail($id);

        // Provera ispravnog korisnika
        if (auth()->user()->id !== $income_category->created_by_id) {
            return redirect('/income_categories')->with('error', 'Nemate pravo da vidite ovu stranu');
        }

        $incomes = Income::where('income_category_id', $id)->get();
        return view('user.income_categories.show', compact('income_category', 'incomes'));
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
        $income_category = IncomeCategory::findOrFail($id);

        // Provera ispravnog korisnika
        if (auth()->user()->id !== $income_category->created_by_id) {
            return redirect('/income_categories')->with('error', 'Nemate pravo da vidite ovu stranu');
        }

        return view('user.income_categories.edit', compact('income_category', 'created_bies'));
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
        $income_category = IncomeCategory::findOrFail($id);
        $income_category->name = $request->input('name');
        $income_category->save();

        return redirect('/income_categories')->with('success', 'Kategorija uspešno ažurirana');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $income_category = IncomeCategory::findOrFail($id);

        // Provera ispravnog korisnika
        if (auth()->user()->id !== $income_category->created_by_id) {
            return redirect('/income_categories')->with('error', 'Nemate pravo da vidite ovu stranu');
        }

        $income_category->delete();
        return redirect('/income_categories')->with('success', 'Kategorija uspešno uklonjena');
    }
}
