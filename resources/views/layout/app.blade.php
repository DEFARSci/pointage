<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="{{asset('pt.png')}}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>pointage</title>
</head>

<nav class="navbar navbar-expand-lg  " style="background: linear-gradient(to right,#84addb , #84addb );">

  <a class="navbar-brand  text-white ml-4"  href="{{route('Pointer')}}">
  <img src="{{asset('pt.png')}}" alt="" srcset="" width="50px" height="50px">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>



  <div class=" collapse navbar-collapse justify-content-end " id="navbarNavAltMarkup">

    <div class="navbar-nav border border-white rounded-5 border-3 ">
      <a class=" ml-3 mr-3  nav-link text-white fs-5" href="{{route('Pointer')}}">Pointage</a>
      <a class=" ml-3 mr-3  nav-link  text-white fs-5" href="{{route('userPointer')}}">Tableau de Bord</a>

      @auth
      @if (auth()->user()->name=='admin')
      <a class="mr-3 ml-3 nav-link  text-white fs-5" href="{{route('indexp')}}">Rapport</a>
      <a class=" mr-3 ml-3 nav-link  text-white fs-5" href="/register" >Ajout Utilisateur</a>
      <a class=" mr-3 ml-3 nav-link  text-white fs-5" href="{{ route('user') }}" >Liste Utilisateur</a>
      @endif
      @endauth
     </div>

</div>
  <div class="collapse navbar-collapse justify-content-end">
    @auth
    <div class="dropdown">
      @auth
      <button class="btn  dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ auth()->user()->name }}
      </button>
      @endauth
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background: linear-gradient(to right,#84addb , #84addb );">
        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <button href="route('logout')" class="btn text-white"
                  onclick="event.preventDefault();
                              this.closest('form').submit();">
              {{ __('Log Out') }}
          </button>
      </form>
      </div>
    </div>






   @endauth
       <div class="navbar-nav p-3">
         @guest

         <a class="nav-link  text-white " href="/login" >Login</a>
         @endguest


           </div>
  </div>

</nav>

<nav class="navbar navbar-expand-lg navbar-light " >

  <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">

      </div>


</nav>



    <body>
     <div class="container p-4">
        @yield('content')
     </div>
</body>

</html>
