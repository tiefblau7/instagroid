<?php
namespace App\Http\Controllers;
class datetimes extends Controller
{
    public function index()
    {
        // ただの変数定義ですが、ここでModelにデータの処理を行わせたりします（後述）。
        $name = 'tanaka taro';
        // ここでuserビュー「user.blade.php」を呼び出し、データ「name」を渡している。
        return view('datedate', ['name' => $name]);
    }
}
