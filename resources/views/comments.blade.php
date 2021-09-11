
@extends('layouts.app')
@section('content')
<!-- Bootstrapの定形コード… -->
    <div class="card-body">
        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Twitterでチームをシェア</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        <!-- バリデーションエラーの表示に使用-->
    	@include('common.errors')
        <!-- バリデーションエラーの表示に使用-->
        <!-- 投稿フォーム１ -->
        @if( Auth::check() )
        <form action="{{ url()->current() }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- チーム名 -->
            <div class="form-group">
                <br>
                Comment
                <div class="col-sm-6">
                    <input type="text" name="comment_name" class="form-control">
                </div>
            </div>
            <!--　登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
        @endif
    <!-- 以下表示機能 -->
    <div class="card-body">
           <div class="card-body">
               <table class="table table-striped task-table">
                   <!-- テーブルヘッダ -->
                   <thead>
                       <th>Team</th>
                       <th>Detail</th>
                   </thead>
                   <tbody>
                       @foreach ($teams as $team)
                           <tr>
                               <!-- チーム名 -->
                               <td class="table-text">
                                   <div>{{ $team->team_name }}</div>
                               </td>
                               <!-- チーム名 -->
                               <td class="table-text">
                                   <div>{{ $team->team_detail }}</div>
                               </td>
                           </tr>
                       @endforeach
                   </tbody>
               </table>
           </div>
    </div>
    <!-- 政治家からのコメントリスト -->
        @if (count($comments) > 0)
       <div class="card-body">
           <div class="card-body">
               <table class="table table-striped task-table">
                   <!-- テーブルヘッダ -->
                   <thead>
                       <th>Comment from politician</th>
                       <th>Name</th>
                       <th>Date</th>
                   </thead>
                   <!-- テーブル本体 -->
                   <tbody>
                       @foreach ($comments as $comment)
                       @if($comment->user->politician ==='1')
                           <tr>
                               <!-- コメント -->
                               <td class="table-text">
                                   <div>
                                       {{ $comment->comment_name}}
                                   </div>
                               </td>
                                <!-- 発言者 -->
                               <td class="table-text">
                                  <div>
                                      {{ $comment->user->name}}
                                  </div>
                               </td>
                               <!-- 発言タイミング -->
                                <td class="table-text">
                                     <div>
                                         {{ $comment->created_at}}
                                     </div>
                                </td>
                           </tr>
                           @endif
                       @endforeach
                   </tbody>
               </table>
           </div>
       </div>		
   @endif
   
    <!-- 全てのコメントリスト -->
    @if (count($comments) > 0)
       <div class="card-body">
           <div class="card-body">
               <table class="table table-striped task-table">
                   <!-- テーブルヘッダ -->
                   <thead>
                       <th>Comment</th>
                       <th>Owner</th>
                       <th>Member</th>
                       <th>Join</th>
                   </thead>
                   <!-- テーブル本体 -->
                   <tbody>
                       @foreach ($comments as $comment)
                           <tr>
                               <!-- コメント -->
                               <td class="table-text">
                                   <div>{{ $comment->comment_name}}</div>
                               </td>
                                <!-- 発言者 -->
                               <td class="table-text">
                                  <div>{{ $comment->user->name}}</div>
                               </td>
                               <!-- 賛同人数 -->
                                <td class="table-text">
                                     <div>{{ $comment->members()->count() }}</div>
                                </td>
				                <!-- 賛同ボタン -->
                               <td class="table-text">
                                   @if(Auth::check())
                                　@if(Auth::id() != $comment->user_id && $comment->members()->where('user_id',Auth::id())->exists() !== true)
                                 　<form action="{{ url('comment/1/'.$comment->id) }}" method="GET">
                                	{{ csrf_field() }}
                                	<button type="submit" class="btn btn-danger">
                                	Join
                                	</button>
                                　　</form>
                                　@endif
                                @endif
                               </td>
                           </tr>
                       @endforeach
                   </tbody>
               </table>
           </div>
       </div>		
   @endif
       
   <!-- 表示機能ここまで -->
@endsection

