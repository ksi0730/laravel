<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Socialite;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Twitterの認証ページヘユーザーをリダイレクト
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Twitterからユーザー情報を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $twitterUser = Socialite::driver('twitter')->user();
        } catch (Exception $e) {
            return redirect('twitter');
        }
         if(User::where('nickname', $twitterUser->getNickname())->exists()){
            //ツイッターで作成されたユーザーならそのままパスする
            $user = User::where('nickname', $twitterUser->getNickname())->first();
            if(!$user->twitter){
                dd("すでに同じtwitterのNicknameが登録されています。");
            }
         }else{
            $user = new User();
            //ユーザーに必要な情報
            $user->name = $twitterUser->getName();
            $user->email = $twitterUser->getNickname();
            $user->password = md5(Str::uuid());
            $user->twitter = true;
            $user->nickname = $twitterUser->getNickname();
            $user->save();
            
         }
         Log::info('Twitterから取得しました。', ['user' => $twitterUser]);
         Auth::login($user);
         return redirect('/team');


    }
    
}


