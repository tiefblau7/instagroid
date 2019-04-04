<?php

   namespace App\Http\Controllers;

   use Illuminate\Http\Request;
   use App\Model\POST;
   use Illuminate\Support\Facades\DB;
   use App\User;
   use Illuminate\Support\Facades\Auth;
   use Socialite;

   class FavController extends Controller
   {
       // favテーブルにデータを追加してhomeに遷移
       public function add(Request $request, $id) {
           $token = $request->session()->get('github_token', null);
           $user = Socialite::driver('github')->userFromToken($token);
           $github_id = $user->user['login'];
           DB::table('fav')->insert(["github_id" => $github_id, "favs" => $id]);

           return redirect('/home');
       }

       public function destroy(Request $request, $id) {

           DB::table('fav')->where('favs', $id)->delete();
           return redirect('/home');
       }
   }
