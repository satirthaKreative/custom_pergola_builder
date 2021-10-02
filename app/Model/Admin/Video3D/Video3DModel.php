<?php

namespace App\Model\Admin\Video3D;

use Illuminate\Database\Eloquent\Model;

class Video3DModel extends Model
{
    //
    protected $table = "video_3d_tbls";

    protected $fillable = [
        "master_width", "master_height", "master_posts", "wood_type_id", "master_overhead", "master_3D_video", "created_at", "updated_at"
    ];
}