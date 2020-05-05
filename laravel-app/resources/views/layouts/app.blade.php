<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">

 <title>{{ config('app.name', 'Laravel') }}</title>

 <!-- Scripts -->
 <script src="{{ asset('js/app.js') }}" defer></script>

 <!-- Fonts -->
 <link rel="dns-prefetch" href="//fonts.gstatic.com">
 <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

 <!-- Styles -->
 <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
 <div id="app">
   <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
     <div class="container">
       <a class="navbar-brand" href="{{ url('/') }}">
           {{ config('app.name', 'Laravel') }}
       </a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
           <span class="navbar-toggler-icon"></span>
       </button>

       <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <!-- Left Side Of Navbar -->
         <ul class="navbar-nav mr-auto">
         </ul>

         <!-- Right Side Of Navbar -->
         <ul class="navbar-nav ml-auto">
           <!-- Authentication Links -->
           @guest
             <li class="nav-item">
                 <a class="nav-link" href="{{route('user.signin')}}">{{ __('ログイン') }}</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="">{{ __('新規登録') }}</a>
             </li>
           @else
             <li class="nav-item">
                 <a class="nav-link" href="">{{ __('ホーム') }}</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="">{{ __('ユーザ一覧') }}</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="">{{ __('投稿') }}</a>
             </li>
             <li class="nav-item dropdown">
               <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                 アカウント <span class="caret"></span>
               </a>

               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                 <a class="dropdown-item" href="">アカウント変更</a>
                 <a class="dropdown-item" href=""
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                   {{ __('ログアウト') }}
                 </a>

                 <form id="logout-form" action="" method="POST" style="display: none;">
                   @csrf
                 </form>
               </div>
             </li>
           @endguest
         </ul>
       </div>
     </div>
   </nav>

   <!-- フラッシュメッセージ -->
   @if (Session::has('flash_message'))
     <p class="bg-success">{!! Session::get('flash_message') !!}</p>
   @endif

   @if (Session::has('error_message'))
     <p class="bg-danger">{!! Session::get('error_message') !!}</p>
   @endif

   <main class="py-4">
     @yield('content')
   </main>
 </div>
</body>
</html>