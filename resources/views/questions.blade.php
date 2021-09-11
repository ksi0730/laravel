@if( Auth::check() )
<form action="{{ url('questions') }}" method="POST" class="form-horizontal">
@extends('layouts.app')
@section('content')
 @if( Auth::check() )
        <form action="{{ url('questions') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- チーム名 -->
            <a href="{{ url('/team') }}" class="btn btn-danger">Creating new team</a>
            <a href="{{ url('/enquete') }}" class="btn btn-danger">Question to politician</a>
            <div class="form-group">
                <br>
                Proposal for debate/国会質問提案
                <div class="col-sm-6">
                    <input type="text" name="question_name" class="form-control">
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
    </div>

 @if (count($questions) > 0)
       <div class="card-body">
           <div class="card-body">
               <table class="table table-striped task-table">
                   <!-- テーブルヘッダ -->
                   <thead>
                       <th>Proposal for debate</th>
                       <th>Owner</th>
                       <th>Member</th>
                       <th>Join</th>
                   </thead>
                   <!-- テーブル本体 -->
                   <tbody>
                       @foreach ($questions as $question)
                           <tr>
                               <!-- チーム名 -->
                               <td class="table-text">
                                   <div>{{ $question->question_name }}</div>
                               </td>
                                <!-- チームオーナー -->
                               <td class="table-text">
                                  <div>{{ $question->user->name }}</div>
                               </td>
                               <!-- 所属人数 -->
                                <td class="table-text">
                                     <div>{{ $question->members()->count() }}</div>
                                </td>
				                <!-- アンケート賛同ボタン -->
                               <td class="table-text">
                                   @if(Auth::check())
                                　@if(Auth::id() != $question->user_id && $question->members()->where('user_id',Auth::id())->exists() !== true)
                                 　<form action="{{ url('question/'.$question->id) }}" method="GET">
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
   
@endsection
</form>
@endif