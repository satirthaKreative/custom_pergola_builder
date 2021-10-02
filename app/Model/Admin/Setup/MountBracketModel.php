<?php

namespace App\Model\Admin\Setup;

use Illuminate\Database\Eloquent\Model;

class MountBracketModel extends Model
{
    protected $table = "setup_mount_bracket_tbls";

    protected $fillable = [
        "piller_post_id", "video_link_data", "mount_bracket_data", "mount_bracket_img", "admin_action"
    ];
}