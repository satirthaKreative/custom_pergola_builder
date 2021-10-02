<?php

namespace App\Model\Config;

use Illuminate\Database\Eloquent\Model;

class ConfigMountModel extends Model
{
    protected $table = "config_mount_bracket_tbls";

    protected $fillable = [
        "mount_bracket4_price", "mount_bracket6_price", "mount_bracket8_price"
    ];
}
