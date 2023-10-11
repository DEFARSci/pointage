<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport des  pointages </title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #fff;
        }

    </style>
</head>
<body>
    <h1>Rapport des  pointages du : {{$jour}}</h1>
    <table>
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Prenom</th>
              <th scope="col">Nom</th>
              <th scope="col">Darriver</th>
              <th scope="col">Depart</th>
               <th scope="col">Paiement-Retard</th>
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
            @if (strtotime($poitage->heurDarriver)<strtotime("9:00:00"))
            <td >{{$poitage->heurDarriver}}</td>
            @endif
             @if (strtotime("9:01:00")<<strtotime($poitage->heurDarriver)||strtotime($poitage->heurDarriver)<<strtotime("9:10:00"))
             <td class="bg-warning">{{$poitage->heurDarriver}}</td>
             @endif
             @if (strtotime($poitage->heurDarriver)>strtotime("9:11:00"))
             <td class="bg-danger">{{$poitage->heurDarriver}}</td>
             @endif

            <td >{{$poitage->heurDepart}}</td>
            <td>{{$poitage->paiementRetard}}</td>
          </tr>
          @endforeach

        </tbody>
        @endif
    </table>
</body>
</html>
