<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberWishlist extends Model
{
    protected $table = "member_wishlists";
    protected $primaryKey = 'id';
    protected $fillable = ['memberId', 'viewsId'];
}
