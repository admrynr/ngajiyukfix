<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Auction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->string('auction_type')->nullable();
            $table->integer('max_price')->nullable();
            $table->integer('min_price')->nullable();
            $table->integer('scale')->nullable();
            $table->integer('fixed_price')->nullable();
            $table->string('bid_start')->nullable();
            $table->string('bid_end')->nullable();
            $table->integer('winner_id')->nullable();
            $table->integer('winner_bid')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('auction');
    }
}
