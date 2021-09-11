<?php

namespace App\Http\Controllers;

use App\Comment; //この行を上に追加
use App\Team; //この行を上に追加
use App\User;//この行を上に追加
use Auth;//この行を上に追加
use Validator;//この行を上に追加
use Illuminate\Http\Request;

class CommentsController extends Controller
{
     public function index($team_id)
    {
        //$users = User::get();
        $teams = Team::where('id','=',$team_id)->get();
        //コメント 表示ページに紐づくもの全体取得
        $comments = Comment::where('comment_id','=',$team_id)->get();
        //政治家コメント 表示ページに紐づくもの全件取得
        //$policomments = Comment::whereHas('user', function($q){
            //$q->where('politician',1);
        //})->get();
        
        return view('comments',[
            //'users'=> $users,
            'comments'=> $comments,
            'teams'=> $teams,
            //'policomments'=> $policomments,
            ]);
        
        //チーム 全件取得
        //$teams = Team::get();
        //return view('teams',[
            //'teams'=> $teams,
            //]);
        
    }
    
     public function store(Request $request)
    {
        //バリデーション 
        $validator = Validator::make($request->all(), [
            'comment_name' => 'required|max:255'
        ]);
        
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/comment')
                ->withInput()
                ->withErrors($validator);
        }
        
        //以下に登録処理を記述（Eloquentモデル）
        $comments = new Comment;
        //多分この下の書き方が違う。ここで自分がコメントしているチームのIDを自動入力させたい。
        $comments->comment_id = $request->team_id;
        $comments->comment_name = $request->comment_name;
        $comments->user_id = Auth::id();//ここでログインしているユーザidを登録しています
        $comments->save();
        
        //多対多のリレーションもここで登録
        $comments->members()->attach( Auth::user() );
        return redirect(url()->current());
    }
    public function join($comment_id)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();
        
        //お気に入りする記事
        $comment = Comment::find($comment_id);
        
        //リレーションの登録
        $comment->members()->attach($user);
        
        return redirect(url()->previous());
    }
}
