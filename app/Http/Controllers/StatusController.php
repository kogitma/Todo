<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Http\Requests\ValiStatusRequest;  //フォームリクエスト
use Illuminate\Support\Facades\DB;
use Log;    //Log::info();

class StatusController extends Controller
{
    /**
     * リスト表示
     */
    public function list()
    {

        //クエリ生成
        $query = Status::query();

        $statuses = $query->orderBy('id', 'asc')->paginate(5);
        return view('status/list', compact('statuses'));
    }

    /**
     * 詳細画面表示
     */
    public function detail($id)
    {
        $status = Status::find($id);
        return view('status/detail')->with('status',$status);
    }

    /**
     * 新規作成（入力）
     */
    public function create()
    {
        return view('status/create');
    }

    /**
     * 新規作成（確認）
     */
    public function create_confirm(ValiStatusRequest $request)
    {
        $data = $request->all();
        return view('status/confirm')->with($data);
    }
    /**
     * 新規作成（完了）
     */
    public function create_complete(Request $request)
    {
        // statusオブジェクト生成
        $status = new Status;
        DB::transaction(function () use ($request, &$status) {

            // 値の登録
            $status->name = $request->name;
            $status->use_general = $request->use_general;

            // 保存
            $status->save();
        });
        session(['status'=>$status]);

        // リダイレクト
        return redirect('status/create-complete');
    }
    /**
     * 新規作成（完了画面表示）
     */
    public function create_complete_view()
    {
        return view('status/complete');
    }


    /**
     * 編集（入力）
     */
    public function edit($id)
    {
        $status = Status::findOrFail($id);
        return view('status/edit')->with('status', $status);
    }
    /**
     * 編集（確認）
     */
    public function edit_confirm(ValiStatusRequest $request)
    {
        $data = $request->all();
        return view('status/confirm')->with($data);
    }
    /**
     * 編集（完了）
     */
    public function edit_complete(Request $request, $id)
    {
        //該当レコードを抽出
        $status = Status::find($id);
        //トランザクション
        DB::transaction(function () use ($request, &$status) {
            //値を代入
            $status->name = $request->name;
            $status->use_general = $request->use_general;

            //保存（更新）
            $status->save();
        });
        session(['status'=>$status]);

        // リダイレクト
        return redirect('status/edit-complete');
    }
    /**
     * 編集（完了表示）
     */
    public function edit_complete_view()
    {
        return view('status/complete');
    }

}