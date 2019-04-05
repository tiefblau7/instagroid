<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;    #追加してください。


class TestController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();   #ログインユーザー情報を取得します。
        return view('test', ['user' => $user]);
    }
}
