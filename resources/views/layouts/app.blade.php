<!DOCTYPE html>
<html lang="en">

<head>
<title>Soccer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('fonts/icomoon/style.css')}}">

  <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">

  <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>

<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar py-4" role="banner">

      <div class="container">
        <div class="d-flex align-items-center">
          <div class="site-logo">
            <a href="{{route('teams')}}">
              <img src="{{asset('images/logo.png')}}" alt="Logo">
            </a>
          </div>
          <div class="ml-auto">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="{{route('teams',[],false)}}" class="nav-link">Teams</a></li>
                <li><a href="{{route('teams.create',[],false)}}" class="nav-link">New Team</a></li>
                <li><a href="{{route('players',[],false)}}" class="nav-link">Players</a></li>
                <li><a href="{{route('players.create', [],false)}}" class="nav-link">New Player</a></li>
                <li><a href="{{route('logout', [],false)}}" class="nav-link">Logout</a></li>
                
              </ul>
            </nav>

            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right text-white"><span
                class="icon-menu h3 text-white"></span></a>
          </div>
        </div>
      </div>

    </header>
    {{-- <div class="container"> --}}
    @yield('content')
    {{-- </div> --}}



</div>
  <!-- .site-wrap -->

  <script src="js/jquery-3.3.1.min.js"></script>

  <script src="js/main.js"></script>

</body>

</html>