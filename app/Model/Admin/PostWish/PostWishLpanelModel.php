<?php

namespace App\Model\Admin\PostWish;

use Illuminate\Database\Eloquent\Model;

class PostWishLpanelModel extends Model
{
    protected $table = "post_wish_lpanel_tbls";

    protected $fillable = [
        "piller_post_id", "video_link_data", "lpanel_data", "admin_action", "created_at", "updated_at"
    ];
}