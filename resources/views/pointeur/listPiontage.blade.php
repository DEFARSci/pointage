
  @extends('layout.app')
  @section('content')
  <div class="row">
    <div class="col-md-2"></div>
    <div  class="d-flex justify-content-center align-items-center  col-8 mb-3" style="background:#84addb;">
      <h1 class="p-3 text-white" >Liste de pointage du : {{$jour}}</h1>
    </div>
  </div>


   <div class="table-responsive">
    <table class="table table-bordered p-3">
      <thead class=""style="background: linear-gradient(to right, #84addb ,  #84addb );">
          <tr>
            <th scope="col"class="text-white">Prenom</th>
            <th scope="col"class="text-white">Nom</th>
            <th scope="col"class="text-white">Darriver</th>
            <th scope="col"class="text-white">Depart</th>
             <th scope="col"class="text-white">Paiement-Retard</th>
          </tr>
        </thead>
        @if (count($pointage)==0)
          <h1>Pas de pointage</h1>
          @else

        <tbody>
            @foreach ($pointage as $poitage )

          <tr>
            <td>{{$poitage->prenom}}</td>
            <td>{{$poitage->nom}}</td>
            @if (strtotime($poitage->heurDarriver) <= strtotime("9:00:59"))
    <td>{{$poitage->heurDarriver}}</td>
@endif
@if (strtotime("9:01:00") < strtotime($poitage->heurDarriver) && strtotime($poitage->heurDarriver) <= strtotime("9:10:59"))
    <td class="bg-warning">{{$poitage->heurDarriver}}</td>
@endif
@if (strtotime($poitage->heurDarriver) > strtotime("9:11:00"))
    <td class="bg-danger">{{$poitage->heurDarriver}}</td>
@endif



            <td >{{$poitage->heurDepart}}</td>
            <td>{{$poitage->paiementRetard}}</td>
          </tr>
          @endforeach

        </tbody>
        @endif
      </table>
   </div>
   {{-- <div class="form-group">
    <form action="{{route('Pointerdate')}}" method="get" class="form-inline col-2 pb-1 d-flex">
      <div class="row">


      <div class="form-group">
        <input type="date" name="date" class="form-control mb-2">
        </div>
        <div class="form-group">
        <button type="submit" style="background: linear-gradient(to right, #84addb ,  #84addb );" class="btn text-white">Search</button>
        </div>
      </div>
      </form>
</div> --}}

{{-- recherche par date --}}
<form class="row g-3" action="{{route('Pointerdate')}}" method="get">
  <div class="col-auto">

    <input type="date" name="date" class="form-control mb-2" id="date" required>
  </div>
  <div class="col-auto">
    <button type="submit" style="background: linear-gradient(to right, #84addb ,  #84addb );" class="btn text-white">Search</button>

  </div>

</form>
@auth
@if(auth()->user()->name=='admin')

<div class="p-3">
  <a style="background:#84addb;" href="{{ route('listPiontage.pdf', $jour) }}" class="btn text-white">Télécharger en PDF</a>
</div>
@endif

@endauth

@endsection
