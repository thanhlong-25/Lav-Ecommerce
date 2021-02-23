<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreataTblProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('cate_id');
            $table->integer('brand_id');
            $table->string('product_name', 100);
            $table->text('product_slug');
            $table->text('product_description');
            $table->integer('product_inventory');
            $table->integer('product_sold');
            $table->integer('product_price');
            $table->string('product_image');
            $table->integer('product_status');
            $table->integer('product_views');
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
        Schema::dropIfExists('tbl_product');
    }
}
