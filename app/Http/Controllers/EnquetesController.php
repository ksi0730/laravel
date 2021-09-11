<?php

namespace App\Http\Controllers;

use App\Enquete; //この行を上に追加
use App\User;//この行を上に追加
use Auth;//この行を上に追加
use Validator;//この行を上に追加
use Illuminate\Http\Request;

class EnquetesController extends Controller
{
     public function index()
    {
         //チーム 全件取得
        $enquetes = Enquete::get();
        return view('enquetes',[
            'enquetes'=> $enquetes
            ]);
    }
     public function store(Request $request)
    {
        //バリデーション 
        $validator = Validator::make($request->all(), [
            'enquete_name' => 'required|max:255'
        ]);
        
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/enquete')
                ->withInput()
                ->withErrors($validator);
        }
        
        //以下に登録処理を記述（Eloquentモデル）
        $enquetes = new Enquete;
        $enquetes->enquete_name = $request->enquete_name;
        $enquetes->user_id = Auth::id();//ここでログインしているユーザidを登録しています
        $enquetes->save();
        
        //多対多のリレーションもここで登録
        $enquetes->members()->attach( Auth::user() );
        return redirect('/enquete');
        
    }
    public function join($enquete_id)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();
        
        //お気に入りする記事
        $enquete = Enquete::find($enquete_id);
        
        //リレーションの登録
        $enquete->members()->attach($user);
        
        return redirect('/enquete');
    }
}
