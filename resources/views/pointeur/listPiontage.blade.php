
  @extends('layout.app')
  @section('content')
  
  <h1 class="p-3" > pointage du : {{$jour}}</h1>
    <table class="table p-3">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Prenom</th>
            <th scope="col">Nom</th>
            <th scope="col">Darriver</th>
            <th scope="col">Depart</th>
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
            <td class="{{$poitage->heurDarriver>9?text-danger:''}}">{{$poitage->heurDarriver}}</td>
            <td>{{$poitage->heurDepart}}</td>
          </tr>
          @endforeach
          
        </tbody>
        @endif
      </table>
      <div>
        <form action="{{route('Pointerdate')}}" method="get">
          <input type="date" name="date">
          <button type="submit">seach</button>
        </form>
      </div>
@endsection