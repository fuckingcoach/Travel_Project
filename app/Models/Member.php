<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Member extends Model
{
    use HasFactory;
    protected $table = "members";
    protected $primaryKey = 'id';
    protected $fillable = ['id','memberName','email', 'pwd', 'tel','create_at'];


    public function getMembers(){
        $list = DB::table($this->table)->selectRaw("id, memberName, email, tel, created_at")->paginate(10);
        return $list;
    }

    public function checkEmail(Request $req)
    {
        return self::where('email',$req->email)->where('id', '!=', $req->id)->exists();
    }
}
