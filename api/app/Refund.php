<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $fillable = [
        'name', 'price', 'status'
    ];

    public function refundExpenses () {
        return $this->hasMany('App\RefundExpenses');
    }

    public function expenses () {
        return $this->belongsToMany('App\Expense', 'App\RefundExpenses');
    }
}
