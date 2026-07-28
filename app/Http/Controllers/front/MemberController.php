<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Constraint\RegularExpression;

class MemberController extends Controller
{
    // 會員中心頁面
    public function home()
    {
        // 回傳會員中心頁面
        $member = Member::find(session()->get('memberId'));
        return view("front.member.home", compact("member"));
    }

    // 會員登入頁面
    public function login()
    {
        // 回傳login頁面
        return view("front.member.login");
    }

    // 會員登入
    public function doLogin(Request $req)
    {
        // 驗證碼確認
        if (captcha_check($req->code) == false) {
            return back()->withInput()->withErrors(["code" => "認證碼錯誤"]);
            exit;
        }
        // 查詢會員
        $member = Member::where('email', $req->email)->where('pwd', $req->pwd)->first();

        if (empty($member)) {
            return back()->withInput()->withErrors(["none" => "帳號或密碼錯誤"]);
        } else {
            session()->put("memberId", $member->id);
            return redirect("/member/home");
        }
    }

    // 會員註冊頁面
    public function register()
    {
        return view("front.member.register");
    }

    // 會員註冊
    public function store(Request $req)
    {
        // 驗證資料格式
        try {
            $validated = $req->validate([
                'email' => ['required', 'regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/'],
                'pwd' => ['required', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};":\\|,.<>\/?]).{10,30}$/'],
                'tel' => ['regex:/^[0-9-]*[0-9][0-9-]*$/']
            ]);
        } catch (ValidationException) {
            return back()->withInput()->withErrors(['error' => '資料格式錯誤!']);
        }

        // 驗證碼
        $code = $req->code;
        if (!captcha_check($code)) {
            return back()->withInput()->withErrors(['code' => '驗證碼錯誤!']);
        }

        $member = new Member();
        $member->memberName = $req->memberName;
        $member->email = $req->email;
        $member->pwd = $req->pwd;
        $member->tel = $req->tel;
        $member->save();

        return redirect()->back()->with('success', '註冊成功!');
    }

    // 會員登出
    public function logout()
    {
        // 全部清除session(暫存)
        // session()->flush();

        // 清除個別session
        Session::forget("memberId");
        return redirect("/member/login");
    }
}
