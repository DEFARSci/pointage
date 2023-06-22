
  @extends('layout.app')
  @section('content')
  
  <div class="row">
    <div class="col-md-2"></div>
    <div  class="d-flex justify-content-center align-items-center  col-8 mb-3" style="background:#84addb;">
      <h1 class="p-3 text-white" >Liste de pointage du : {{$jour}}</h1>
    </div>
  </div>
  <div class="table-responsive" style="max-height: 500px;overflow-y: scroll;">
    <table class="table table-bordered p-3">
      <thead class=""style="background: linear-gradient(to right, #84addb ,  #84addb );">
          <tr>
            <th scope="col" class="text-white">#</th>
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
            <th scope="row">{{$poitage->id}}</th>
            <td>{{$poitage->prenom}}</td>
            <td>{{$poitage->nom}}</td>
            @if (strtotime($poitage->heurDarriver) < strtotime("9:00:00"))
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
      

      
@endsection