<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_loans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('consec_fee');
            $table->decimal('value_fee',15,2);
            $table->date('date_fee');
            $table->bigInteger('loan_id')->unsigned();
            $table
                ->foreign('loan_id')
                ->references('id')
                ->on('loans')
                ->after('date_fee');
            $table->bigInteger('user_id')->unsigned();
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->after('loan_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_loans');
    }
}
