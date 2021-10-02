<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLpanelTypeTextTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lpanel_type_text_tbls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lpanel_id');
            $table->longText('lpanel_text')->nullable();
            $table->enum('admin_action',['active','inacttive'])->default('active');
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
        Schema::dropIfExists('lpanel_type_text_tbls');
    }
}
