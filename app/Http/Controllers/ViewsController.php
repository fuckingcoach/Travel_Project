<?php

namespace App\Http\Controllers;

use App\Models\Views;
use Illuminate\Http\Request;

class ViewsController extends Controller
{
    // R - Read (清單頁)：取得所有資料
    public function index()
    {
        // 抓取 SQLite 中最新的景點資料
        $views = Views::latest()->get();

        return response()->json([
            'status' => 'success',
            'data'   => $views
        ], 200);
    }

    // C - Create (新增)：處理資料寫入
    public function store(Request $req)
    {
        // 1. 驗證資料（完全對齊 Migration 欄位規則）
        $validated = $req->validate([
            'name'    => 'required|string|max:100', // 唯一必填欄位
            'city'    => 'nullable|string|max:50',
            'town'    => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'typeId'  => 'nullable|integer',         // 整數，資料庫預設為 1
            'brief'   => 'nullable|string|max:255',
            'content' => 'nullable|string',          // 長文字內容
            'tel'     => 'nullable|string|max:30',
            'like'    => 'nullable|integer|min:0',   // 整數，資料庫預設為 0
        ]);

        // 2. 針對未傳入的選填欄位補上預設值
        $validated['typeId'] = $validated['typeId'] ?? 1;
        $validated['like']   = $validated['like']   ?? 0;

        // 3. 寫入資料庫
        $view = Views::create($validated);

        // 4. 回傳成功 response (HTTP 201 Created)
        return response()->json([
            'status'  => 'success',
            'message' => '景點資料建立成功！',
            'data'    => $view
        ], 201);
    }

    // R - Read (單篇詳情)：取得指定 ID 的資料
    public function show($id)
    {
        // findOrFail: 找不到此 ID 時自動拋出 404
        $view = Views::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data'   => $view
        ], 200);
    }

    // U - Update (更新)：更新指定 ID 的資料
    public function update(Request $req, $id)
    {
        // 1. 找到要修改的景點
        $view = Views::findOrFail($id);

        // 2. 驗證輸入資料（更新時全部使用 nullable，前端沒帶過來的欄位就不更動）
        $validated = $req->validate([
            'name'    => 'sometimes|required|string|max:100', // 如果有傳 name 欄位則不能為空
            'city'    => 'nullable|string|max:50',
            'town'    => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'typeId'  => 'nullable|integer',
            'brief'   => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'tel'     => 'nullable|string|max:30',
            'like'    => 'nullable|integer|min:0',
        ]);

        // 3. 執行更新
        $view->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => '景點資料更新成功！',
            'data'    => $view
        ], 200);
    }

    // D - Delete (刪除)：刪除指定 ID 的資料
    public function destroy($id)
    {
        // 1. 找到景點
        $view = Views::findOrFail($id);

        // 2. 從 SQLite 刪除
        $view->delete();

        return response()->json([
            'status'  => 'success',
            'message' => '景點資料刪除成功！'
        ], 200);
    }
}