<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inst.index');
    }

    public function post(Request $request)
    {
        $token = $request->session()->get('github_token', null);
        return view('inst.post', ["token" => $token]);
    }
}
