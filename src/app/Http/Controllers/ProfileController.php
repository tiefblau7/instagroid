<?php

   namespace App\Http\Controllers;

   use Illuminate\Http\Request;
   use App\Model\POST;
   use Illuminate\Support\Facades\DB;
   use App\User;
   use Illuminate\Support\Facades\Auth;
   use Socialite;

   class ProfileController extends Controller
   {
       // Indexページの表示
       public function index(Request $request, $github_id) {
           $post = POST::where('github_id', $github_id) -> orderBy('id', 'desc') ->get();
           $token = $request->session()->get('github_token', null);
           $avatar = DB::table('user')->where('github_id', $github_id)->value('avatar');
           $gittable = POST::where('github_id', $github_id)->get();
           $count = 0;
           foreach ($gittable as $g) {
           $count += DB::table('fav')-> where('favs', $g -> id) -> count() ;
           }
           return view('inst.profile', ["post" => $post, "github_id" => $github_id, "avatar" => $avatar, "token" => $token ,"count" => $count]); // inst.profileにデータを渡す
       }
   }
