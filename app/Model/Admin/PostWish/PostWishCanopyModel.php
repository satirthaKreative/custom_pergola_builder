<?php

namespace App\Model\Admin\PostWish;

use Illuminate\Database\Eloquent\Model;

class PostWishCanopyModel extends Model
{
    protected $table = "post_wish_canopy_tbls";

    protected $fillable = [
        "piller_post_id", "video_link_data", "canopy_type_text_description", "admin_action", "created_at", "updated_at"
    ];
}
