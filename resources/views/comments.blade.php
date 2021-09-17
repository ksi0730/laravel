@extends('layouts.app')
@section('content')
<!-- Bootstrapの定形コード… -->
    <div class="card-body">
        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false"></a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
         @foreach ($teams as $team)
         @if($team->id == 1 )
         <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2F92837d23fe64456b85b035490207e5c2.vfs.cloud9.us-east-1.amazonaws.com%2Fcomment%2F1&layout=button&size=small&width=69&height=20&appId" width="69" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
         @else
         <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fksi0730.sakura.ne.jp%2Fvoice&layout=button&size=small&width=69&height=20&appId" width="69" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
         @endif
         @endforeach
        <!-- バリデーションエラーの表示に使用-->
    	@include('common.errors')
        <!-- バリデーションエラーの表示に使用-->
    <!-- 以下表示機能 -->
    <div class="mx-auto col-sm-9">
           <div class="card-body">
               <table class="table table-striped task-table">
                   <!-- テーブルヘッダ -->
                   <thead>
                       <th>Team</th>
                       <th>Member</th>
                       <th>Detail</th>
                   </thead>
                   <tbody>
                       @foreach ($teams as $team)
                           <tr>
                               <!-- チーム名 -->
                               <td class="table-text">
                                   <div>{{ $team->team_name }}</div>
                               </td>
                               <!-- メンバー数 -->
                               <td class="table-text">
                                   <div>{{ $team->members()->count()  }}</div>
                               </td>
                               <!-- チーム名 -->
                               <td class="table-text">
                                   <div>{{ $team->team_detail }}</div>
                               </td>
                           </tr>
                       @if($team->id == 1 )
                        <tr>
                       <td class="mx-auto col-sm-3">
                        <div>海外の#LoveIsNotTourism</div>
                        <a href="https://www.loveisnottourism.org/">
                        <img src="/images/foreign.png" width="100%" height="150px">
                        </a>
                       </td>
                       <td class="mx-auto col-sm-3">
                        <div>政治家の見解</div>
                        <iframe width="100%" height="150px" src="https://www.youtube.com/embed/ZfDor1ftiio?start=2578" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
                       </td>
                   </tr>
                       @endif
                       @endforeach
                   </tbody>
               </table>
           </div>
    
    <!-- 政治家からのコメントリスト -->
        @if (count($comments) > 0)
       
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
   @endif
   
    <!-- 全てのコメントリスト -->
    @if (count($comments) > 0)
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
   @endif
   </div>
   <!-- 表示機能ここまで -->
   <!-- 投稿フォーム１ -->
        @if( Auth::check() )
        <form action="{{ url()->current() }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- チーム名 -->
            <div class="form-group">
                <div class="mx-auto col-sm-5">
                <h5>Raise Your Voice</h5>
                <input type="text" name="comment_name" class="form-control" placeholder="Voice">
                </div>
            </div>
            <!--　登録ボタン -->
            <div class="form-group">
                <div class="mx-auto col-sm-5">
                    <button type="submit" class="btn btn-primary w-100">
                        Raise
                    </button>
                    <br>
                </div>
            </div>
        </form>
        @endif
@endsection

