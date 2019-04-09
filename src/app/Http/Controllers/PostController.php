<?php

   namespace App\Http\Controllers;

   use Illuminate\Http\Request;
   use App\Model\Post;
   use App\User;
   use Illuminate\Support\Facades\Auth;
   use Socialite;
   use Illuminate\Support\Facades\DB;
   class PostController extends Controller
   {
       // homeページの表示
       public function index(Request $request) {
           $post = Post::orderBy('id', 'desc') -> simplePaginate(10); // 全データの取り出し
           $favs = DB::table('fav')->get();
           $token = $request->session()->get('github_token', null);
           \Debugbar::info($favs);
           if($token){
             $user = Socialite::driver('github')->userFromToken($token);
             $github_id = $user->user['login'];
             return view('inst.index', ["post" => $post, "token" => $token, "github_id" => $github_id, "favs" => $favs]);
           }
           return view('inst.index', ["post" => $post, "token" => $token, "favs" => $favs]); // inst.indexにデータを渡す
       }

       public function upload(Request $request)
       {
           $this->validate($request, [
               'file' => [
                   // 必須
                   'required',
                   // アップロードされたファイルであること
                   'file',
                   // 60MB以下であること
                   'max:61440',
                   // 画像ファイルであること
                   'image',
                   // MIMEタイプを指定
                   'mimes:jpeg,png',
               ],
               'comment' => 'max:200',
           ]);

           if ($request->file('file')->isValid([])) {
               $path = $request->file->store('public');
               $filename = basename($path);
               $comment = $request->input('comment');
               $now = date("Y/m/d H:i:s");
               $token = $request->session()->get('github_token', null);
               $user = Socialite::driver('github')->userFromToken($token);
               $github_id = $user->user['login'];
               $avatar = $user->getAvatar();
               Post::insert(["image" => $filename, "comment" => $comment, "created_at" => $now, "github_id" => $github_id, "avatar" => $avatar]); // データベーステーブルに投稿内容を入れる
               return redirect('/home');
               //$post = POST::orderBy('id', 'desc') -> simplePaginate(10); // 全データの取り出し

               //return view('inst.index', ["post" => $post, "token" => $token, "github_id" => $github_id]); // indexにデータを渡す
           } else {
               return redirect()
                   ->back()
                   ->withInput()
                   ->withErrors();
           }
       }
       public function destroy($id)
       {
          Post::destroy($id);
          return redirect('/home');
       }
   }
