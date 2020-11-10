<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('invoice_number');
            $table->string('shipping_type');
            $table->string('estimate_date');
            $table->string('address');
            $table->integer('province_id');
            $table->integer('city_id');
            $table->integer('total_weight');
            $table->integer('payment_type');
            $table->string('midtrans_payment_type');
            $table->string('midtrans_transaction_id');
            $table->string('midtrans_pdf_url')->nullable();
            $table->string('midtrans_finish_redirect_url');
            $table->string('payment_account')->nullable();
            $table->string('payment_number')->nullable();
            $table->integer('total_base_price');
            $table->integer('total_final_price');
            $table->integer('tax');
            $table->integer('shipping_price');
            $table->integer('total_price');
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}
