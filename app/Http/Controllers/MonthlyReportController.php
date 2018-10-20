<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MonthlyReportController extends Controller
{
    public function index(Request $request)
    {
        $date = date("d.m.Y");

        $get_api = Expense::get_json_api($date);
        $srednji = $get_api->result->eur->sre;
        $kupovni = $get_api->result->eur->kup;
        $prodajni = $get_api->result->eur->pro;

        $from = Carbon::parse(sprintf(
            '%s-%s-01',
            $request->query('y', Carbon::now()->year),
            $request->query('m', Carbon::now()->month)
        ));

        $to = clone $from;
        $to->day = $to->daysInMonth;

        $created_by_id = auth()->user()->id;

        $exp_q = Expense::with('expense_category')->where('created_by_id', $created_by_id)->whereBetween('entry_date', [$from, $to]);
        $inc_q = Income::with('income_category')->where('created_by_id', $created_by_id)->whereBetween('entry_date', [$from, $to]);

        $exp_total = $exp_q->sum('amount');
        $inc_total = $inc_q->sum('amount');
        $exp_group = $exp_q->orderBy('amount', 'desc')->get()->groupBy('expense_category_id');
        $inc_group = $inc_q->orderBy('amount', 'desc')->get()->groupBy('income_category_id');
        $profit = $inc_total - $exp_total;

        $exp_summary = [];
        foreach ($exp_group as $exp) {
            foreach ($exp as $line) {
                if (!isset($exp_summary[$line->expense_category->name])) {
                    $exp_summary[$line->expense_category->name] = [
                        'name'   => $line->expense_category->name,
                        'amount' => 0,
                    ];
                }
                $exp_summary[$line->expense_category->name]['amount'] += $line->amount;
            }
        }

        $inc_summary = [];
        foreach ($inc_group as $inc) {
            foreach ($inc as $line) {
                if (! isset($inc_summary[$line->income_category->name])) {
                    $inc_summary[$line->income_category->name] = [
                        'name'   => $line->income_category->name,
                        'amount' => 0,
                    ];
                }
                $inc_summary[$line->income_category->name]['amount'] += $line->amount;
            }
        }

        return view('user.monthly_reports.index', compact('exp_summary', 'inc_summary', 'exp_total', 'inc_total', 'profit', 'srednji', 'kupovni', 'prodajni'));
    }
}
