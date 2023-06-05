<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\User;
use App\Http\Requests\ValiCategoryRequest;  //フォームリクエスト
use App\Http\Requests\ValiUserSearchRequest;
use Illuminate\Support\Facades\DB;
use Log;

class TestController extends Controller
{
    /**
     * リスト表示
     */
    public function list(ValiUserSearchRequest $request)
    {
        //クエリ生成
        $query = Test::query();

        $user_id = $request['user_id'];
        if(!empty($user_id)){
            $query->where('user_id', '=', $user_id);
            }

        //ログインデータのid確認
        $user = session()->get('user');
        $user_id = $user['id'];

        //一般の場合は自身のみ
        if($user['auth'] == 2){$query->where('user_id', '=', $user_id);}

        //ユーザーデータ引用
        $users = User::get();

        $categories = $query->with('user')->orderBy('id', 'asc')->paginate(5);
        return view('test/list', compact('categories', 'request', 'users'));
    }

    /**
     * 削除
     */
    public function delete($id)
    {
        //トランザクション
        DB::transaction(function () use ($id) {
            $user = session()->get('user');
            $user_id = $user['id'];
            // 削除対象レコードを検索
            $category = Test::find($id);
            if($category->user_id == $user_id || $user['auth'] == 1){
                // 論理削除
                $category->delete();
            }
        });

        // リダイレクト
        return redirect()->to('test/list');
    }

    /**
     * 詳細画面表示
     */
    public function detail($id)
    {
        $user = session()->get('user');
        $user_id = $user['id'];
        $category = Test::find($id);
        if($category->user_id != $user_id){
            return redirect()->to('category/list');
        }
        return view('test/detail', compact('category'));
    }

    /**
     * 新規作成（入力）
     */
    public function create()
    {
        return view('test/create');
    }

    /**
     * 新規作成（確認）
     */
    public function create_confirm(ValiCategoryRequest $req)
    {
        $data = $req->all();
        return view('test/confirm')->with($data);
    }
    /**
     * 新規作成（完了）
     */
    public function create_complete(Request $request)
    {
        // categoryオブジェクト生成
        $category = new Test;
        DB::transaction(function () use ($request, &$category) {
            
            // 値の登録
            $category->name = $request->name;

            //ログインデータのid登録
            $user = $request->session()->get('user');
            $category->user_id = $user['id'];

            // 保存
            $category->save();
        });
        session(['category'=>$category]);

        // リダイレクト
        return redirect('test/create-complete');
    }
    /**
     * 新規作成（完了画面表示）
     */
    public function create_complete_view()
    {
        return view('test/complete');
    }


    /**
     * 編集（入力）
     */
    public function edit($id)
    {
        $user = session()->get('user');
        $user_id = $user['id'];
        $category = Test::findOrFail($id);
        if($category->user_id != $user_id || $user['auth'] == 1){
            return redirect()->to('category/list');
        }
        return view('test/edit', compact('category'));
    }
    /**
     * 編集（確認）
     */
    public function edit_confirm(ValiCategoryRequest $request)
    {
        $data = $request->all();
        return view('test/confirm')->with($data);
    }
    /**
     * 編集（完了）
     */
    public function edit_complete(Request $request, $id)
    {
        $user = session()->get('user');
        $user_id = $user['id'];
        //該当レコードを抽出
        $category = Test::find($id);
        if($category->user_id != $user_id || $user['auth'] == 1){
            return redirect()->to('test/list');
        }
        //トランザクション
        DB::transaction(function () use ($request, &$category) {
            //値を代入
            $category->name = $request->name;

            //保存（更新）
            $category->save();
        });
        session(['category'=>$category]);

        // リダイレクト
        return redirect('test/edit-complete');
    }
    /**
     * 編集（完了）
     */
    public function edit_complete_view()
    {
        return view('test/complete');
    }
}