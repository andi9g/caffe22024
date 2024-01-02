<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css?v=2">
    <title>CAFFE</title>
  </head>
  <body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">CAFFE</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item @yield('warnahome')">
            <a class="nav-link " href="{{ url('home', []) }}">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item @yield('warnalist')">
            <a class="nav-link" href="{{ url('list', []) }}">List Menu</a>
          </li>
          <li class="nav-item @yield('warnameja')">
            <a class="nav-link" href="{{ url('meja', []) }}">Meja Pesanan</a>
          </li>
          <li class="nav-item @yield('warnapesanan')">
            <a class="nav-link" href="{{ url('pesanan', []) }}">Pesanan</a>
          </li>
          <li class="nav-item @yield('warnalaporan')">
            <a class="nav-link" href="{{ url('laporan', []) }}">Laporan</a>
          </li>
          <li class="nav-item">
            <form action="{{ route('logout', []) }}" method="post">
              @csrf
              <button type="submit" class="btn btn-danger btn-sm">LOGOUT</button>

            </form>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container mt-3">
      <div class="container-fluid">
        <h1>@yield('judul')</h1>

      </div>
      @yield('content')

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    @include('sweetalert::alert')
  </body>
</html>