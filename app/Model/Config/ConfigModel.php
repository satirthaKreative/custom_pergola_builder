<?php

namespace App\Model\Config;

use Illuminate\Database\Eloquent\Model;

class ConfigModel extends Model
{
    //
    protected $table = "config_a_footprint_tbl";

    protected $fillable = [
        "post4_price", "post6_price", "post4double_price", "post8_price"
    ];
}
