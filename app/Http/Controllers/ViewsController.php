<?php

namespace App\Http\Controllers;

use App\Models\Views;
use Illuminate\Http\Request;

class ViewsController extends Controller
{

    // R - Read (清單頁)：取得所有文章
    public function index()
    {
        // 抓取 SQLite 中最新的文章
        $posts = Views::latest()->get();

        // 如果是寫 API，可以直接回傳 JSON：
        return response()->json($posts);

        // 如果是傳統網頁，可以帶給 Blade 畫面：
        // return view('posts.index', compact('posts'));
    }


    //C - Create (新增)：處理資料寫入
    public function store(Request $req)
    { // 1. 驗證前端傳過來的欄位資料
        $validated = $req->validate([
            'name'    => 'required|string|max:50',
            'city'    => 'required|string|max:20',
            'town'    => 'required|string|max:20',
            'address' => 'required|string|max:100',
            'typeId'  => 'required|string|max:50', // 景點/文章分類 ID
            'brief'   => 'nullable|string|max:50',  // 簡介（選填）
            'content' => 'nullable|string|max:255',  // 詳細內容（選填）
            'tel'     => 'nullable|string|max:20',   // 電話（選填）
            'like'    => 'nullable|integer|min:0',   // 按讚數（選填）
        ]);

        // 2. 針對未傳入的選填欄位給予預設值（例如按讚數預設 0）
        $validated['like'] = $validated['like'] ?? 0;

        // 3. 寫入資料庫
        $view = Views::create($validated);

        // 4. 回傳成功訊息與剛建立好的資料 (HTTP Status: 201 Created)
        return response()->json([
            'message' => '景點資料建立成功！',
            'data'    => $view
        ], 201);
    }

    //R - Read (單篇詳情)：取得指定 ID 的文章
    public function show($id)
    {
        // findOrFail: 找不到此 ID 時會自動丟出 404 錯誤
        $post = Views::findOrFail($id);

        return response()->json($post);
    }

    //U - Update (更新)：更新指定 ID 的文章
    public function update(Request $req, $id)
    {
        // 1. 找到要修改的文章
        $post = Views::findOrFail($id);

        // 2. 驗證輸入資料
        $validated = $req->validate([
            'name' => 'required|string|max:30',
            'city' => 'required|string|max:30',
            'town' => 'required|string|max:30',
            'address' => 'required|string|max:30'
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
        $post = Views::findOrFail($id);

        // 2. 從 SQLite 刪除
        $post->delete();

        return response()->json([
            'message' => '文章刪除成功！'
        ]);
    }
}
