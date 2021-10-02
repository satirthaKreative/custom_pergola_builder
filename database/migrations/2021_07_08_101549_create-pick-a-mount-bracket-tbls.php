<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePickAMountBracketTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_config_pick_a_mount_bracket_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mount_bracket_name')->nullable();
            $table->integer('width_length')->nullable();
            $table->integer('height_length')->nullable();
            $table->integer('post_length')->nullable();
            $table->double('mount_bracket_price',12,2)->nullable();
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
        Schema::dropIfExists('new_config_pick_a_mount_bracket_tbls');
    }
}
