<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_expenses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('expense_id')->nullable();
            $table->foreign('expense_id')->references('id')->on('expenses');

            $table->unsignedBigInteger('refund_id')->nullable();
            $table->foreign('refund_id')->references('id')->on('refunds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('refund_expenses', function (Blueprint $table) {
            $table->dropForeign('refund_expenses_expense_id_foreign');
            $table->dropForeign('refund_expenses_refund_id_foreign');
        });
        Schema::dropIfExists('refund_expenses');
    }
}
