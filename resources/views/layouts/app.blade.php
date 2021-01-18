<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <title>Wiki Talk | @yield('title')</title>
  </head>
  <body style="background-color: #f5f5f5;">

    <style media="screen">
      * {
        font-family: 'Montserrat', sans-serif;
      }
    </style>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand text-info" href="/"><i class="fab fa-forumbee"></i> Wiki Talk</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('topics.index') }}"><i class="fas fa-list-ul"></i> Topics</a>
          </li>
          @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> S'identifier</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Créer un compte</a>
          </li>
          @endguest

          @auth
          <li class="nav-item">
              <a class="nav-link" href="{{ route('users.notifications') }}"><i class="fas fa-bell"></i> Notifications @unless(auth()->user()->unreadNotifications->isEmpty()) <span class="badge badge-warning">{{ auth()->user()->unreadNotifications->count() }}</span> @endunless </a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              @auth <img src="{{ asset('/storage/avatars/'. Auth::user()->avatar) }}" width="40px" height="40px" class="rounded-circle">@endauth @guest<i class="fas fa-user"></i>@endguest {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
              <a class="dropdown-item" href="/logout">Déconnexion</a>
            </div>
          </li>
          @endauth
        </ul>
      </div>
    </nav>
 

    @yield('content')


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

  @yield('javascript')
</body>
</html>
