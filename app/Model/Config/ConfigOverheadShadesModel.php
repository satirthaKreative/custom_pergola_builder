<?php

namespace App\Model\Config;

use Illuminate\Database\Eloquent\Model;

class ConfigOverheadShadesModel extends Model
{
    //
    protected $table = "config_regular_tbls";

    protected $fillable = [
        "regular_price", "open_price", "sunblocker_price"
    ];
}
