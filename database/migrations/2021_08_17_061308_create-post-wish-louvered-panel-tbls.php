<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostWishLouveredPanelTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('config_post_length_tbls', function (Blueprint $table) {
            //
            $table->integer('wood_id')->after('post12Length_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('config_post_length_tbls', function (Blueprint $table) {
            //
        });
    }
}
