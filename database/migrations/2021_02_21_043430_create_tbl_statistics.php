<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblStatistics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_statistics', function (Blueprint $table) {
            $table->increments('stat_id');
            $table->string('stat_date');
            $table->string('stat_sales');
            $table->string('stat_profits');
            $table->integer('total_quantities');
            $table->integer('total_orders');
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
        Schema::dropIfExists('tbl_statistics');
    }
}
