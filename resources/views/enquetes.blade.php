@if( Auth::check() )
<form action="{{ url('enquetes') }}" method="POST" class="form-horizontal">
@extends('layouts.app')
@section('content')
 @if( Auth::check() )
        <form action="{{ url('enquetes') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- チーム名 -->
            <a href="{{ url('/team') }}" class="btn btn-danger">Creating new team</a>
            <a href="{{ url('/question') }}" class="btn btn-danger">Proposal for debate</a>
            <div class="form-group">
                <br>
                Question to politician/アンケート提案
                <div class="col-sm-6">
                    <input type="text" name="enquete_name" class="form-control">
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

 @if (count($enquetes) > 0)
       <div class="card-body">
           <div class="card-body">
               <table class="table table-striped task-table">
                   <!-- テーブルヘッダ -->
                   <thead>
                       <th>Question to politician</th>
                       <th>Owner</th>
                       <th>Member</th>
                       <th>Join</th>
                   </thead>
                   <!-- テーブル本体 -->
                   <tbody>
                       @foreach ($enquetes as $enquete)
                           <tr>
                               <!-- チーム名 -->
                               <td class="table-text">
                                   <div>{{ $enquete->enquete_name }}</div>
                               </td>
                                <!-- チームオーナー -->
                               <td class="table-text">
                                  <div>{{ $enquete->user->name }}</div>
                               </td>
                               <!-- 所属人数 -->
                                <td class="table-text">
                                     <div>{{ $enquete->members()->count() }}</div>
                                </td>
				                <!-- アンケート賛同ボタン -->
                               <td class="table-text">
                                   @if(Auth::check())
                                　@if(Auth::id() != $enquete->user_id && $enquete->members()->where('user_id',Auth::id())->exists() !== true)
                                 　<form action="{{ url('enquete/'.$enquete->id) }}" method="GET">
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