<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', 'PageController@index');
Route::get('/about', 'PageController@about');

Route::resource('currencies', 'CurrencyController');

Route::resource('roles', 'RoleController');

Route::resource('users', 'UserController');

Route::resource('income_categories', 'IncomeCategoryController');

Route::resource('incomes', 'IncomeController');

Route::resource('expense_categories', 'ExpenseCategoryController');

Route::resource('expenses', 'ExpenseController');

Route::resource('monthly_reports', 'MonthlyReportController');

Auth::routes();

Route::get('/home', 'HomeController@index');
