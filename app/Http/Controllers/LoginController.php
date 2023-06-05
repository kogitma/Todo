<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ValiLoginRequest;  //フォームリクエスト
use Log;    //Log::info();

class LoginController extends Controller
{
    /**
     * ログイン
     */
    public function login()
    {
        return view('login/login');
    }

    /**
     * ログイン(POST)
     */
    
    public function post_login(ValiLoginRequest $request)
    {
        //該当レコードを抽出
        $user = User::find($request->u_unique_id);
        
        Log::info($user);
        // ログインに成功したとき
        if (isset($user) && password_verify($request->password, $user->password) && $user['is_delete'] == 0) {
            session(['user'=>$user]);
            
            return redirect('/');
        }
        // ログインに失敗したとき
        
        //ログインエラー表示
        $request->session()->flash('info', 'ユーザーIDかパスワードが間違っています');
        return redirect()->back();
    }

    /**
     * ログアウト
     */
    public function logout()
    {
        session()->flush(); //セッション全削除
        session()->flash('info', 'ログアウトしました');
        return redirect('/login');
    }
}