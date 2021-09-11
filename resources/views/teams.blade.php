@if( Auth::check() )
<form action="{{ url('teams') }}" method="POST" class="form-horizontal">
<!-- resources/views/teams.blade.php -->
@extends('layouts.app')
@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        <a href="{{ url('/enquete') }}" class="btn btn-danger">Question to politician</a>
        <a href="{{ url('/question') }}" class="btn btn-danger">Proposal for debate</a>
        <!-- バリデーションエラーの表示に使用-->
    	@include('common.errors')
        <!-- バリデーションエラーの表示に使用-->
        <!-- 投稿フォーム１ -->
        @if( Auth::check() )
        <form action="{{ url('teams') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- チーム名 -->
            <div class="form-group">
                <br>
                New Team
                <div class="col-sm-6">
                    <input type="text" name="team_name" class="form-control">
                </div>
            </div>
             <div class="form-group">
                Team Detail
                <div class="col-sm-6">
                    <input type="text" name="team_detail" class="form-control">
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
    <!-- 全てのチームリスト -->
    @if (count($teams) > 0)
       <div class="card-body">
           <div class="card-body">
               <table class="table table-striped task-table">
                   <!-- テーブルヘッダ -->
                   <thead>
                       <th>Voice</th>
                       <th>Raiser</th>
                       <th>Member</th>
                       <th>Chat</th>
                       <th>Join</th>
                       <th>Edit</th>
                   </thead>
                   <!-- テーブル本体 -->
                   <tbody>
                       @foreach ($teams as $team)
                           <tr>
                               <!-- チーム名 -->
                               <td class="table-text">
                                   <div>{{ $team->team_name }}</div>
                               </td>
                                <!-- チームオーナー -->
                               <td class="table-text">
                                  <div>{{ $team->user->name }}</div>
                               </td>
                               <!-- 所属人数 -->
                                <td class="table-text">
                                     <div>{{ $team->members()->count() }}</div>
                                </td>
                               <!-- チャットボタン -->
                               <td class="table-text">
                                   <a href="{{ url('comment/'.$team->id) }}" class="btn btn-danger">Chat</a>
                               </td>
				                <!-- チーム参加ボタン -->
                               <td class="table-text">
                                   @if(Auth::check())
                                　@if(Auth::id() != $team->user_id && $team->members()->where('user_id',Auth::id())->exists() !== true)
                                 　<form action="{{ url('team/'.$team->id) }}" method="GET">
                                	{{ csrf_field() }}
                                	<button type="submit" class="btn btn-danger">
                                	Join
                                	</button>
                                　　</form>
                                　@endif
                                @endif
                               </td>
                               <!-- チーム編集ボタン-->
                               <td class="table-text">
                                   @if(Auth::check()&& Auth::id() == $team->user_id )
                                    　　<form action="{{ url('teamedit/'.$team->id) }}" method="GET">
                                    	{{ csrf_field() }}
                                    	<button type="submit" class="btn btn-danger">
                                    	Edit
                                    	</button>
                                    　　</form>	
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
</form>
@endif