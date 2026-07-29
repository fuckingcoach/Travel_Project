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
    protected $fillable = ['memberName', 'email', 'pwd', 'tel', 'birthday', 'address', 'status'];


    public function getAdminMembers()
    {
        $list = DB::table($this->table)->selectRaw("id, memberName, email, pwd, status, created_at, updated_at")->paginate(10);
        return $list;
    }

    public function checkEmail(Request $req)
    {
        return self::where('email', $req->email)->where('id', '!=', $req->id)->exists();
    }
}
