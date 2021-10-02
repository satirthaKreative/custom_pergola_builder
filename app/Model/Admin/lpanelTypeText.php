<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class lpanelTypeText extends Model
{
    //

    protected $table = "lpanel_type_text_tbls";

    protected $fillable = [
        "lpanel_id", "lpanel_text", "admin_action", "created_at", "updated_at"
    ];
}
