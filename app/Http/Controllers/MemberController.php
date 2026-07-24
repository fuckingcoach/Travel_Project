<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    // R - Read : 取得所有會員
    public function list()
    {
        // 取得所有會員
        $members = Member::all();

        // 回傳json格式
        return response()->json($members);

        // 如果要回傳view寫在下面
        // return view("admin.views", compact("members"));
    }

    // 導向會員註冊頁面
    public function create()
    {
        // 如果要回傳view寫在下面
        return view("admin.member.add");
    }

    //C - Create (新增)：處理會員資料寫入
    public function store(Request $req)
    {
        // 新增會員
        $member = new Member();
        $member->name = $req->name;
        $member->email = $req->email;
        $member->pwd = $req->pwd;
        // 如果未提供電話，設為""
        $member->tel = ($req->tel ?? "");
        $member->save();

        // 回傳成功訊息與剛建立好的資料 (HTTP Status: 201 Created)
        return response()->json([
            'message' => '會員資料建立成功！',
            'member'    => $member
        ], 201);
    }

    //R - Read (單篇詳情)：取得指定 ID 的文章
    public function show($id)
    {
        // findOrFail: 找不到此 ID 時會自動丟出 404 錯誤
        $post = Member::findOrFail($id);

        return response()->json($post);
    }

    //U - Update (更新)：更新指定 ID 的文章
    public function update(Request $req, $id)
    {
        // 1. 找到要修改的文章
        $post = Member::findOrFail($id);

        // 2. 驗證輸入資料
        $validated = $req->validate([
            'name'    => 'required|string|max:50',
            'email'    => 'required|string|max:50',
            'pwd'    => 'required|string|max:50',
            'tel' => 'required|string|max:50'
        ]);

        // 3. 執行更新
        $post->update($validated);

        return response()->json([
            'message' => '文章更新成功！',
            'data' => $post
        ]);
    }

    //D - Delete (刪除)：刪除指定 ID 的文章
    public function destroy($id)
    {
        // 1. 找到文章
        $post = Member::findOrFail($id);

        // 2. 從 SQLite 刪除
        $post->delete();

        return response()->json([
            'message' => '文章刪除成功！'
        ]);
    }
}
