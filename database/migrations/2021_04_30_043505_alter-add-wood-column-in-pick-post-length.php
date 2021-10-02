<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAddWoodColumnInPickPostLength extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pick_post_length_tbls', function (Blueprint $table) {
            $table->integer('wood_type_id')->default(0)->after('master_overhead_shades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pick_post_length_tbls', function (Blueprint $table) {
            //
        });
    }
}
