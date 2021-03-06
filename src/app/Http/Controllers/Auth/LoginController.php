<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;// 追加！
use Illuminate\Http\Request;// 追加！
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Foundation\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'postLogout']);
    }

    /**
     * GitHubの認証ページヘユーザーをリダイレクト
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()// 追加！
    {
        return Socialite::driver('github')->scopes(['read:user', 'public_repo'])->redirect();
    }

    /**
     * GitHubからユーザー情報を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        $github_user = Socialite::driver('github')->stateless()->user(); //->stateless()を挟んだ。
        $now = date("Y/m/d H:i:s");
        $avatar = $github_user->getAvatar();
        $app_user = DB::select('select * from public.user where github_id = ?', [$github_user->user['login']]);
        if (empty($app_user)) {
            DB::insert('insert into public.user (github_id, created_at, updated_at, avatar) values (?, ?, ?, ?)', [$github_user->user['login'], $now, $now, $avatar]);
        }
        $request->session()->put('github_token', $github_user->token);
        return redirect('github');
     }

     // ログアウト
     public function postLogout()
     {
         \Auth::logout();
         return redirect()->to('/');
     }
}
