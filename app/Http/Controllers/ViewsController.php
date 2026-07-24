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
            'typeId'  => 'required|integer|min:0', // 景點/文章分類 ID
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

    // U - Update (局部更新)：僅更新前端有傳送的欄位
    public function patch(Request $req, $id)
    {
        // 1. 找到要修改的資料，找不到會直接回傳 404
        $view = Views::findOrFail($id);

        // 2. 驗證輸入資料（使用 sometimes，表示有傳入才驗證，沒傳入就跳過）
        $validated = $req->validate([
            'name'    => 'sometimes|required|string|max:50',
            'city'    => 'sometimes|required|string|max:20',
            'town'    => 'sometimes|required|string|max:20',
            'address' => 'sometimes|required|string|max:100',
            'typeId'  => 'sometimes|required|integer|min:0',
            'brief'   => 'sometimes|nullable|string|max:50',
            'content' => 'sometimes|nullable|string|max:255',
            'tel'     => 'sometimes|nullable|string|max:20',
            'like'    => 'sometimes|nullable|integer|min:0',
        ]);

        // 3. 執行更新（只會更新 $validated 陣列裡有的 key）
        $view->update($validated);

        // 4. 回傳成功訊息與更新後的完整資料
        return response()->json([
            'message' => '景點資料局部更新成功！',
            'data'    => $view
        ], 200);
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
