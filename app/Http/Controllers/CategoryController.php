<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\ValiCategoryRequest;  //フォームリクエスト
use App\Http\Requests\ValiUserSearchRequest;
use Illuminate\Support\Facades\DB;
use Log;

class CategoryController extends Controller
{
    /**
     * リスト表示
     */
    public function list(ValiUserSearchRequest $request)
    {
        //クエリ生成
        $query = Category::query();

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

        $categories = $query->whereIsDelete(false)->with('user')->orderBy('id', 'asc')->paginate(5);
        return view('category/list', compact('categories', 'request', 'users'));
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
            $category = Category::find($id);
            if($category->user_id == $user_id || $user['auth'] == 1){
                // 論理削除
                $category->is_delete = 1;
                $category->save();
            }
        });

        // リダイレクト
        return redirect()->to('category/list');
    }

    /**
     * 詳細画面表示
     */
    public function detail($id)
    {
        $user = session()->get('user');
        $user_id = $user['id'];
        $category = Category::find($id);
        Log::info($user['auth']);
        if($category->user_id != $user_id && $user['auth'] == 2){
            return redirect()->to('category/list');
        }
        return view('category/detail', compact('category'));
    }

    /**
     * 新規作成（入力）
     */
    public function create()
    {
        return view('category/create');
    }

    /**
     * 新規作成（確認）
     */
    public function create_confirm(ValiCategoryRequest $req)
    {
        $data = $req->all();
        return view('category/confirm')->with($data);
    }
    /**
     * 新規作成（完了）
     */
    public function create_complete(Request $request)
    {
        // categoryオブジェクト生成
        $category = new category;
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
        return redirect('category/create-complete');
    }
    /**
     * 新規作成（完了画面表示）
     */
    public function create_complete_view()
    {
        return view('category/complete');
    }


    /**
     * 編集（入力）
     */
    public function edit($id)
    {
        $user = session()->get('user');
        $user_id = $user['id'];
        $category = Category::findOrFail($id);
        if($category->user_id != $user_id && $user['auth'] == 2){
            return redirect()->to('category/list');
        }
        return view('category/edit', compact('category'));
    }
    /**
     * 編集（確認）
     */
    public function edit_confirm(ValiCategoryRequest $request)
    {
        $data = $request->all();
        return view('category/confirm')->with($data);
    }
    /**
     * 編集（完了）
     */
    public function edit_complete(Request $request, $id)
    {
        $user = session()->get('user');
        $user_id = $user['id'];
        //該当レコードを抽出
        $category = Category::find($id);
        if($category->user_id != $user_id && $user['auth'] == 2){
            return redirect()->to('category/list');
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
        return redirect('category/edit-complete');
    }
    /**
     * 編集（完了）
     */
    public function edit_complete_view()
    {
        return view('category/complete');
    }
}