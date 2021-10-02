<?php

namespace App\Model\Config;

use Illuminate\Database\Eloquent\Model;

class ConfigLouveredModel extends Model
{
    protected $table = "config_louvered_panel_tbls";

    protected $fillable = [
        "each_sqft_price"
    ];
}
