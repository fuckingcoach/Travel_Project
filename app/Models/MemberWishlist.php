<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberWishlist extends Model
{
    public $timestamps = true;
    protected $table = "member_wishlists";
    protected $primaryKey = 'id';
    protected $fillable = ["id", "memberID", "viewsId", "created_at"];
}
