<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'entry_date',
        'amount',
        'currency_id',
        'expense_category_id',
        'created_by_id'
    ];

    public function setExpenseCategoryIdAttribute($input) {
        $this->attributes['expense_category_id'] = $input ? $input : null;
    }

    public function setCreatedByIdAttribute($input) {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }

    public function expense_category() {
        return $this->belongsTo('App\ExpenseCategory', 'expense_category_id');
    }

    public function expense_currency() {
        return $this->belongsTo('App\Currency', 'currency_id');
    }

    public function created_by() {
        return $this->belongsTo('App\User', 'created_by_id');
    }

    public static function get_json_api($date) {

//        $jsonurl = "https://api.kursna-lista.info/8d7d11050f0a5ffeb593a8a3fac1c00b/kl_na_dan/" . $date . "/json";
//        $json = file_get_contents($jsonurl);
//        $objs = json_decode($json);
//        return response()->json($objs);

        $opts = [
            'http' => [
                'method' => 'GET',
                'header' => [
                    'User-Agent: PHP'
                ]
            ]
        ];

        $context = stream_context_create($opts);
        $content = file_get_contents('https://api.kursna-lista.info/8d7d11050f0a5ffeb593a8a3fac1c00b/kl_na_dan/'.$date.'/json', false, $context);
        $objs = json_decode($content);
        return $objs;
    }

}
