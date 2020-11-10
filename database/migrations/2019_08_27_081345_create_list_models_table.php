<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('brand');
            $table->integer('categories_id');
            $table->string('product_name');
            $table->text('product_description');
            $table->integer('is_featured')->default('0');
            $table->integer('base_price');
            $table->integer('final_price');
            $table->integer('stock');
            $table->integer('weight');
            $table->string('sku_code')->nullable();
            
            $table->integer('is_verified');
            $table->string('image')->default('default.png');
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
        Schema::dropIfExists('products');
    }
}
