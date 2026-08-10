<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminViewstypeController extends Controller
{
    public function list()
    {
        return view("admin.views_type.viewstype");
    }
}
