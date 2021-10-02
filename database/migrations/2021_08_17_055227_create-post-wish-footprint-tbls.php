<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostWishFootprintTbls extends Migration
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
            $table->integer('wood_id')->after('post8_price');
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
