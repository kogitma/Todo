<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;
use App\Models\Status;
use App\Http\Requests\ValiTodoRequest;  //フォームリクエスト
use App\Http\Requests\ValiSearchRequest;  //フォームリクエスト
use Illuminate\Support\Facades\DB;
use Log;

class TodoController extends Controller
{
    /**
     * リスト表示
     */
    public function list(ValiSearchRequest $request)
    {
        $title = $request['title'];
        $content = $request['content'];
        $start_date1 = $request['start_date1'];
        $start_date2 = $request['start_date2'];
        $end_date1 = $request['end_date1'];
        $end_date2 = $request['end_date2'];
        $status = $request['status'];
        $category = $request['category'];
        $item = $request['item'];
        
        //クエリ生成
        $query = Todo::query();

        //もし空でなければ
        if(!empty($title)){$query->where('title','like','%'.$title.'%');}
        if(!empty($content)){$query->where('content','like','%'.$content.'%');}
        if(!empty($start_date1)){$query->where('start_date','>=',$start_date1);}
        if(!empty($start_date2)){$query->where('start_date','<=',$start_date2);}
        if(!empty($end_date1)){$query->where('end_date','>=',$end_date1);}
        if(!empty($end_date2)){$query->where('end_date','<=',$end_date2);}
        if(!empty($status)){$query->whereIn('status', $status);}
        if(!empty($category)){
            $query->whereHas('categories', function ($q) use ($category){
                $q->where('todo_relations.category_id', '=', $category);});
            }
        //空の場合
        if(empty($item)){$item = config('const.paginate_default');}
        
        //ログインデータのid確認
        $user = $request->session()->get('user');
        $user_id = $user['id'];

        //カテゴリデータ引用
        $categories = Category::where('user_id', '=', $user_id)->where('is_delete', '=', 'false')->get();

        //ステータスデータ引用
        $statuses = session()->get('user')->auth == 1 ? Status::get() : Status::where('use_general', '=', true)->get();

        $todos = $query->orderBy('id', 'asc')->where('user_id', '=', $user_id)->with('categories')->paginate($item);
        return view('todo/list', compact('todos','request','categories', 'statuses'));
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
            $todo = Todo::find($id);
            if($todo->user_id == $user_id){
                // 削除
                $todo->delete();
            }
        });
        //トランザクション

        // リダイレクト
        return redirect()->to('todo/list');
    }

    /**
     * 詳細画面表示
     */
    public function detail($id)
    {
        $user = session()->get('user');
        $user_id = $user['id'];
        $todo = Todo::find($id);
        if($todo->user_id != $user_id){
            return redirect()->to('todo/list');
        }
        return view('todo/detail',compact('todo'));
    }

    /**
     * 新規作成（入力）
     */
    public function create()
    {
        //ログインデータのid確認
        $user = session()->get('user');
        $user_id = $user['id'];
        //カテゴリデータ引用
        $categories = Category::where('user_id', '=', $user_id)->where('is_delete', '=', 'false')->get();
        //ステータスデータ引用
        $statuses = session()->get('user')->auth == 1 ? Status::get() : Status::where('use_general', '=', true)->get();
        return view('todo/create', compact('categories', 'statuses'));
    }

    /**
     * 新規作成（確認）
     */
    public function create_confirm(ValiTodoRequest $request)
    {
        //カテゴリ名表示用
        $c_names = Category::find($request->categories);

        $data = $request->all();
        return view('todo/confirm', compact('c_names'))->with($data);
    }
    /**
     * 新規作成（完了）
     */
    public function create_complete(Request $request)
    {
        // todoオブジェクト生成
        $todo = new Todo;
        DB::transaction(function () use ($request, &$todo) {
            
            // 値の登録
            $todo->title = $request->title;
            $todo->content = $request->content;
            $todo->start_date = $request->start_date;
            $todo->end_date = $request->end_date;
            $todo->status = $request->status;

            //ログインデータのid登録
            $user = $request->session()->get('user');
            $todo->user_id = $user['id'];

            // 保存
            $todo->save();
            //カテゴリの追加
            $todo->categories()->attach($request->categories);
        });
        session(['todo'=>$todo]);

        // リダイレクト
        return redirect('todo/create-complete');
    }
    /**
     * 新規作成（完了画面表示）
     */
    public function create_complete_view()
    {
        return view('todo/complete');
    }


    /**
     * 編集（入力）
     */
    public function edit($id)
    {
        $user = session()->get('user');
        $user_id = $user['id'];
        $todo = Todo::findOrFail($id);
        if($todo->user_id != $user_id){
            return redirect()->to('todo/list');
        }
        //カテゴリデータ引用
        $categories = Category::where('user_id', '=', $user_id)->where('is_delete', '=', 'false')->get();
        //ステータスデータ引用
        $statuses = session()->get('user')->auth == 1 ? Status::get() : Status::where('use_general', '=', true)->get();

        //dd($test);
        return view('todo/edit', compact('todo', 'categories', 'statuses'));
    }
    /**
     * 編集（確認）
     */
    public function edit_confirm(ValiTodoRequest $request)
    {
        //カテゴリ名表示用
        $c_names = Category::find($request->categories);
        
        $data = $request->all();
        return view('todo/confirm', compact('c_names'))->with($data);
    }
    /**
     * 編集（完了）
     */
    public function edit_complete(Request $request, $id)
    {
        $user = session()->get('user');
        $user_id = $user['id'];
        //該当レコードを抽出
        $todo = Todo::find($id);
        if($todo->user_id != $user_id){
            return redirect()->to('todo/list');
        }
        //トランザクション
        DB::transaction(function () use ($request, &$todo) {
            //値を代入
            $todo->title = $request->title;
            $todo->content = $request->content;
            $todo->start_date = $request->start_date;
            $todo->end_date = $request->end_date;
            $todo->status = $request->status;

            //保存（更新）
            $todo->save();
            Log::info($request);
            //カテゴリの同期
            $todo->categories()->sync($request->categories);
        });
        session(['todo'=>$todo]);

        // リダイレクト
        return redirect('todo/edit-complete');
    }
    /**
     * 編集（完了）
     */
    public function edit_complete_view()
    {
        return view('todo/complete');
    }
}