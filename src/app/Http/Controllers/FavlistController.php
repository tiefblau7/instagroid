<?php

   namespace App\Http\Controllers;

   use Illuminate\Http\Request;
   use App\Model\POST;
   use Illuminate\Support\Facades\DB;
   use App\User;
   use Illuminate\Support\Facades\Auth;
   use Socialite;

   class FavlistController extends Controller
   {
       // Indexページの表示
       public function index(Request $request, $id) {
           $favlist = DB::table('fav')->where('favs', $id)->get();
           $user = DB::table('user');
           $token = $request->session()->get('github_token', null);
           return view('inst.favlist', ["favlist" => $favlist, "user" => $user, "token" => $token]);
       }
   }
