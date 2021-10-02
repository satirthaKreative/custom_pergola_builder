<?php

namespace App\Model\Config;

use Illuminate\Database\Eloquent\Model;

class ConfigCanopyModel extends Model
{
    protected $table = "config_canopy_tbls";

    protected $fillable = [
        "canopy_price"
    ];
}
