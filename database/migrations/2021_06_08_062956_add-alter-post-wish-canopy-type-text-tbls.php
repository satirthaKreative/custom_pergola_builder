<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAlterPostWishCanopyTypeTextTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_wish_canopy_tbls', function (Blueprint $table) {
            $table->longText("canopy_type_text_description")->nullable()->after('video_link_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_wish_canopy_tbls', function (Blueprint $table) {
            //
        });
    }
}
