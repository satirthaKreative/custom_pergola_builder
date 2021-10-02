<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetupMountBracketTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setup_mount_bracket_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('piller_post_id');
            $table->longText('video_link_data');
            $table->longText('mount_bracket_data')->nullable();
            $table->longText('mount_bracket_img')->nullable();
            $table->enum('admin_action',['yes','no'])->default('yes');
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
        Schema::dropIfExists('setup_mount_bracket_tbls');
    }
}
