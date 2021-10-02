<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigMountBracketTbls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_mount_bracket_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('mount_bracket4_price',12,2);
            $table->double('mount_bracket6_price',12,2);
            $table->double('mount_bracket8_price',12,2);
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
        Schema::dropIfExists('config_mount_bracket_tbls');
    }
}
