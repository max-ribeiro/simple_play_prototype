<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('value', 8, 2)->notNull();
            $table->unsignedBigInteger('payer_id');
            $table->unsignedBigInteger('payee_id');
            $table->tinyInteger('aborted')->default(0);
            $table->timestamps();

            $table->foreign('payer_id')->references('id')->on('users');
            $table->foreign('payee_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function(Blueprint $table) {
            $table->dropForeign('transactions_payer_id_foreign');
            $table->dropForeign('transactions_payee_id_foreign');
        });
        Schema::dropIfExists('transactions');
    }
}
