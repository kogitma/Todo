<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ValiUserRequest;  //フォームリクエスト
use App\Http\Requests\ValiUserEditRequest;
use Illuminate\Support\Facades\DB;
use Log;    //Log::info();

class UserController extends Controller
{
    /**
     * リスト表示
     */
    public function list(Request $request)
    {
        $name = $request['name'];
        $email = $request['email'];
        $u_unique_id = $request['u_unique_id'];
        $auth = $request['auth'];
        $item = $request['item'];

        //クエリ生成
        $query = User::query();

        //もし空でなければ
        if(!empty($name)){$query->where('name','like','%'.$name.'%');}
        if(!empty($email)){$query->where('email','like','%'.$email.'%');}
        if(!empty($u_unique_id)){$query->where('u_unique_id','like','%'.$u_unique_id.'%');}
        if(!empty($auth))
        {
            foreach($auth as $auth_single){
                $query->orWhere('auth',$auth_single);
            }
        }
        //空の場合
        if(empty($item)){$item = config('const.paginate_default');}

        $sort = 'asc';
        
        

        $user = $query->orderBy('id', $sort)->whereIsDelete(false)->paginate($item);
        return view('user/list')->with('user',$user)->with('request',$request);
    }

    /**
     * 削除
     */
    public function delete($id)
    {
        // 削除対象レコードを検索
        $user = User::find($id);
        //トランザクション
        DB::transaction(function () use ($user) {
            // 論理削除
            $user->is_delete = true;
            $user->save();
        });
        //ログインアカウントの場合
        if(session()->has('user')){
            $account = session()->get('user');
            $user_id = $account['id'];
            if($user_id = $id){
                session()->flush(); //セッション全削除
                session()->flash('info', 'アカウントが削除されました');
                return redirect('/login');
            }
        }
        // リダイレクト
        return redirect()->to('user/list');
    }

    /**
     * 詳細画面表示
     */
    public function detail($id)
    {
        $user = User::find($id);
        return view('user/detail')->with('user',$user);
    }

    /**
     * 新規作成（入力）
     */
    public function create()
    {
        return view('user/create');
    }

    /**
     * 新規作成（確認）
     */
    public function create_confirm(ValiUserRequest $request)
    {
        $data = $request->all();
        return view('user/confirm')->with($data);
    }
    /**
     * 新規作成（完了）
     */
    public function create_complete(Request $request)
    {
        // userオブジェクト生成
        $user = new user;
        DB::transaction(function () use ($request, &$user) {

            // 値の登録
            $user->name = $request->name;
            $user->email = $request->email;
            $user->u_unique_id = $request->u_unique_id;
            $user->password = password_hash($request->password, PASSWORD_DEFAULT);
            $user->auth = $request->auth;

            // 保存
            $user->save();
        });
        session(['user'=>$user]);

        // リダイレクト
        return redirect('user/create-complete');
    }
    /**
     * 新規作成（完了画面表示）
     */
    public function create_complete_view()
    {
        return view('user/complete');
    }


    /**
     * 編集（入力）
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user/edit')->with('user', $user);
    }
    /**
     * 編集（確認）
     */
    public function edit_confirm(ValiUserEditRequest $request)
    {
        $data = $request->all();
        return view('user/confirm')->with($data);
    }
    /**
     * 編集（完了）
     */
    public function edit_complete(Request $request, $id)
    {
        //該当レコードを抽出
        $user = User::find($id);
        //トランザクション
        DB::transaction(function () use ($request, &$user) {
            //値を代入
            $user->name = $request->name;
            $user->email = $request->email;
            $user->u_unique_id = $request->u_unique_id;
            if($request->password){
                $user->password = password_hash($request->password, PASSWORD_DEFAULT);
            }
            $user->auth = $request->auth;

            //保存（更新）
            $user->save();
        });
        session(['user'=>$user]);

        // リダイレクト
        return redirect('user/edit-complete');
    }
    /**
     * 編集（完了表示）
     */
    public function edit_complete_view()
    {
        return view('user/complete');
    }

}