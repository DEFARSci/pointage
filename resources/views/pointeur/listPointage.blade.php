<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

     <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
	
</head>
<body>


    <table class="table p-3">
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

</body>
</html>
