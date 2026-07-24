<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public $timestamps = true;
    protected $table = "members";
    protected $primaryKey = 'id';
    protected $fillable = ["id", "email", "pwd", "tel", "name", "created_at"];
}
