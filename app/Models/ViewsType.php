<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewsType extends Model
{
    protected $table = "views_types";
    protected $primaryKey = 'id';
    protected $fillable = ['typeName'];
}
