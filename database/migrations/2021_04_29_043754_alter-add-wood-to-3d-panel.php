<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAddWoodTo3dPanel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_3d_tbls', function (Blueprint $table) {
            $table->integer('wood_type_id')->default(0)->after('master_overhead');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video_3d_tbls', function (Blueprint $table) {
            //
        });
    }
}
