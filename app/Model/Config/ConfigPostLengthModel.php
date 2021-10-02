<?php

namespace App\Model\Config;

use Illuminate\Database\Eloquent\Model;

class ConfigPostLengthModel extends Model
{
    protected $table = "config_post_length_tbls";

    protected $fillable = [
        "post9Length_price", "post12Length_price"
    ];
}
