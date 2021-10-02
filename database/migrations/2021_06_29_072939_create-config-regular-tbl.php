<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigRegularTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_regular_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('regular_price',4,2)->default(0);
            $table->float('open_price',4,2)->default(0);
            $table->float('sunblocker_price',4,2)->default(0);
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
        Schema::dropIfExists('config_regular_tbls');
    }
}
