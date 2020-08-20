<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefundExpenses extends Model {
    protected $fillable = [ 'expense_id' ];

    public $timestamps = false;

    public function refund()
    {
        return $this->belongsTo('App\Refund');
    }

    public function expense()
    {
        return $this->belongsTo('App\Expense');
    }
}