<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Hash; 


class UserController extends Controller
{
    public function signin()
    {
      return view('user.signin');
    }

    public function login(UserRequest $request)
    {
      $email    = $request->input('email');
      $password = $request->input('password');
      if (!Auth::attempt(['email' => $email, 'password' => $password])) {
        // 認証失敗
        return redirect('/')->with('error_message', 'I failed to login');
      }
      // 認証成功
      return redirect()->route('micropost.index');
    }

    public function logout()
    {
      Auth::logout();
      return redirect()->route('user.signin');
    }

    public function create()
    {
      return view('user.create');
    }

    public function store(UserRequest $request)
    {
      $user     = new User;
      $name     = $request->input('name');
      $email    = $request->input('email');
      $password = $request->input('password');
      $params   = [
        'name'      => $name,
        'email'     => $email,
        'password'  => Hash::make($password),
      ];
      if (!$user->fill($params)->save()) {
        return redirect()->route('user.create')->with('error_message', 'User registration failed');
      }
      if (!Auth::attempt(['email' => $email, 'password' => $password])) {
        return redirect()->route('user.signin')->with('error_message', 'I failed to login');
      }
      return redirect()->route('micropost.index');
    }

  
}
