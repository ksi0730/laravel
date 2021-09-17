
<form action="{{ url('teams') }}" method="POST" class="form-horizontal">
<!-- resources/views/teams.blade.php -->
@extends('layouts.app')
@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        @if( Auth::check() )
        <div class="mx-auto col-sm-5">
            <h5>Raise Your Voice : #LoveIsNotTourism</h5>
        </div>
        <!-- バリデーションエラーの表示に使用-->
    	@include('common.errors')
        <!-- バリデーションエラーの表示に使用-->
        <!-- 投稿フォーム１ -->
        <form action="{{ url('teams') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- チーム名 -->
            <div class="form-group">
                <div class="mx-auto col-sm-5">
                    <input type="text" name="team_name" class="form-control" placeholder="Voice">
                </div>
            </div>
             <div class="form-group">
                <div class="mx-auto col-sm-5">
                    <textarea type="text" name="team_detail" class="form-control" placeholder="Detail" rows="3"></textarea>
                </div>
            </div>
            <!--　登録ボタン -->
            <div class="form-group">
                <div class="mx-auto col-sm-5">
                    <button type="submit" class="btn btn-primary w-100">
                        Raise
                    </button>
                </div>
            </div>
        </form>
        @endif
        <div class="mx-auto col-sm-9">
           <div class="card-body">
               <table class="table table-striped task-table">
                   <!-- テーブルヘッダ -->
                   <thead>
                       <th>Feature</th>
                       <th></th>
                       <th></th>
                   </thead>
               <tbody>
                   <tr>
                       <td class="mx-auto col-sm-3">
                        <div>出入国制限の緩和を求めます</div>
                        <a href="https://92837d23fe64456b85b035490207e5c2.vfs.cloud9.us-east-1.amazonaws.com/comment/1">
                        <img src="/images/love.png" width="100%" height="150px">
                        @foreach ($teams as $team)
                        @if($team->id == 1 )
                        <div class="text-right">{{ $team->members()->count() }}人賛同</div>
                        @endif
                        @endforeach
                        </a>
                       </td>
                       <td class="mx-auto col-sm-3">
                        <div>政治家の見解</div>
                        <iframe width="100%" height="150px" src="https://www.youtube.com/embed/ZfDor1ftiio?start=2578" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <div class="text-right"></div>
                       </td>
                       <td class="mx-auto col-sm-3">
                        <div>リンク集</div>
                        <ul>
                            <li><a href= "https://www.e-stat.go.jp/dbview?sid=0003411850">年間約２万組が国際結婚</a></li>
                            <li><a href= "https://www.buzzfeed.com/jp/rikakotakahashi/international-relationships-covid-1">2021年6月17日BuzzFeed</a></li>
                            <li><a href= "https://www.kyoto-np.co.jp/articles/-/580306">2021年6月12日京都新聞</a></li>
                            <li><a href= "https://www.nhk.or.jp/gendai/comment/0020/topic027.html">2021年6月11日NHK</a></li>
                            <li><a href= "https://www.asahi.com/articles/ASP494677P3QOIPE00J.html">2021年4月10日朝日新聞</li>
                            <li><a href= "https://www.change.org/p/%E6%97%A5%E6%9C%AC%E6%94%BF%E5%BA%9C-%E5%A4%96%E5%9B%BD%E4%BA%BA%E3%81%AE%E9%85%8D%E5%81%B6%E8%80%85-%E5%A9%9A%E7%B4%84%E8%80%85-%E3%83%91%E3%83%BC%E3%83%88%E3%83%8A%E3%83%BC%E3%81%AE%E6%97%A5%E6%9C%AC%E5%85%A5%E5%9B%BD%E8%A6%8F%E5%88%B6%E7%B7%A9%E5%92%8C%E3%82%92%E6%B1%82%E3%82%81%E3%81%BE%E3%81%99-allow-foreign-partners-of-japanese-citizens-to-enter-japan-without-visa">change.orgの署名</a></li>
                        </ul>
                        <div class="text-right"></div>
                       </td>
                   </tr>
               </tbody>
               </table>
           </div>
    <!-- 以下表示機能 -->
    <!-- 全てのチームリスト -->
    @if (count($teams) > 0)
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
                                  <div>{{ $team->user['name'] }}</div>
                               </td>
                               <!-- 所属人数 -->
                                <td class="table-text">
                                     <div>{{ $team->members()->count()  }}</div>
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
   @endif
   </div>
       
   <!-- 表示機能ここまで -->
    
@endsection
</form>