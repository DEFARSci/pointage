

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Envoie mail</title>

</head>
<body>

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
      @if ($pointage === null || count($pointage) === 0)
    <h1>Pas de pointage</h1>
@else
    <tbody>
        @foreach ($pointage as $poitage)
            <tr>
                <th scope="row">{{ $poitage->id }}</th>
                <td>{{ $poitage->prenom }}</td>
                <td>{{ $poitage->nom }}</td>
                <td class="{{ $poitage->heurDarriver > 9 ? 'text-danger' : '' }}">{{ $poitage->heurDarriver }}</td>
                <td>{{ $poitage->heurDepart }}</td>
                <td>{{ $poitage->paiementRetard }}</td>
            </tr>
        @endforeach
    </tbody>
@endif

      </table>
      

      
@endsection

</body>
</html>
