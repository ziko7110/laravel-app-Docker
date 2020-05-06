<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Micropost;
use App\Http\Requests\MicropostRequest;
use Auth;

class MicropostController extends Controller
{
    public function index()
    {
        $microposts = Micropost::getAll();
        $viewParams = [
          'microposts' => $microposts,
        ];
        return view('micropost.index', $viewParams);
    }

    public function input()
    {
      return view('micropost.input');
    }

    public function post(MicropostRequest  $request)
    {
      $content    = $request->input('content');
      $micropost  = new Micropost;
      $params = [
        'user_id' => Auth::id(),
        'content' => $content,
      ];
      if (!$micropost->micropostSave($params)) {
        // 登録失敗
        return redirect()->route('micropost.input')->with('error_message', 'Regist micropost failed');
      }
      return redirect()->route('micropost.index')->with('flash_message', 'regist success!!');
    }
}
