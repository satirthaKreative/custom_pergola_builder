<?php

namespace App\Model\Admin\MasterWood;

use Illuminate\Database\Eloquent\Model;

class MasterWoodModel extends Model
{
    //
    protected $table = "master_wood_tbl";

    protected $fillable = [
        "wood_name", "wood_img", "wood_price", "wood_descriptions", "admin_action", "created_at", "updated_at"
    ];
}