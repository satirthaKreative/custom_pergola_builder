<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterConfigAFootprintTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('config_a_footprint_tbl', function (Blueprint $table) {
            $table->float('post4double_price')->default(0)->after('post4_price');
            $table->float('post8_price')->default(0)->after('post6_price');
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
