<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingPickAFootprintPriceRangePanel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('config_a_footprint_tbl', function (Blueprint $table) {
            //
            $table->double('less100_price',12,2)->nullable();
            $table->double('less100150_price',12,2)->nullable();
            $table->double('greater150_price'12,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('config_a_footprint_tbl', function (Blueprint $table) {
            //
        });
    }
}
