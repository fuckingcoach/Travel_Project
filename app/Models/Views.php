<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Views extends Model
{
    protected $table = "views";
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'city', 'town', 'address', 'typeId', 'brief', 'content', 'tel', 'like'];
}
