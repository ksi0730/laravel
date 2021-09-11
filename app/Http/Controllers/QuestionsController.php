<?php

namespace App\Http\Controllers;

use App\Question; //この行を上に追加
use App\User;//この行を上に追加
use Auth;//この行を上に追加
use Validator;//この行を上に追加
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function index()
    {
         //チーム 全件取得
        $questions = Question::get();
        return view('questions',[
            'questions'=> $questions
            ]);
    }
    public function store(Request $request)
    {
        //バリデーション 
        $validator = Validator::make($request->all(), [
            'question_name' => 'required|max:255'
        ]);
        
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/question')
                ->withInput()
                ->withErrors($validator);
        }
        
        //以下に登録処理を記述（Eloquentモデル）
        $questions = new Question;
        $questions->question_name = $request->question_name;
        $questions->user_id = Auth::id();//ここでログインしているユーザidを登録しています
        $questions->save();
        
        //多対多のリレーションもここで登録
        $questions->members()->attach( Auth::user() );
        return redirect('/question');
        
    }
    public function join($question_id)
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();
        
        //お気に入りする記事
        $question = Question::find($question_id);
        
        //リレーションの登録
        $question->members()->attach($user);
        
        return redirect('/question');
    }
}
