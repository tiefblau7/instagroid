<?php

namespace App\Http\Controllers\Github;

use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Post;

class GithubController extends Controller
{
      public function top(Request $request)
      {
          $token = $request->session()->get('github_token', null);

          try {
              $github_user = Socialite::driver('github')->stateless()->userFromToken($token); // stateless()を挟んだ。
          } catch (\Exception $e) {
              return redirect('login/github');
          }

          $client = new \GuzzleHttp\Client();
          $res = $client->request('GET', 'https://api.github.com/user/repos', [
              'headers' => [
                  'Authorization' => 'token ' . $token
              ]
          ]);
          $github_id = $github_user->user['login'];
          $app_user = DB::select('select * from public.user where github_id = ?', [$github_user->user['login']]);
          $post = Post::orderBy('id', 'desc') -> simplePaginate(10); // 全データの取り出し
          /**return view('inst.index', ["post" => $post]);*/
          $favs = DB::table('fav')->get();
          return view('inst.index', [
              'user' => $app_user[0],
              'post' => $post,
              'favs' => $favs,
              'github_id' => $github_id,
              'nickname' => $github_user->nickname,
              'avatar' => $github_user->getAvatar(), //アバター画像取得
              'token' => $token,
              'repos' => array_map(function($o) {
                  return $o->name;
              }, json_decode($res->getBody()))
          ]);
      }

    public function createIssue(Request $request)
    {
        $token = $request->session()->get('github_token', null);
        $user = Socialite::driver('github')->userFromToken($token);

        $client = new \GuzzleHttp\Client();
        $res = $client->request('Post', 'https://api.github.com/repos/' . $user->user['login'] . '/' . $request->input('repo') . '/issues', [
            'auth' => [$user->user['login'], $token],
            'json' => [
                'title' => $request->input('title'),
                'body' => $request->input('body')
            ]
        ]);

        return view('done', [
            'response' => json_decode($res->getBody())->html_url
        ]);
    }

}
