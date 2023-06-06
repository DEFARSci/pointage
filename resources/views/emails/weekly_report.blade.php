<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <title>pointage</title>
<body>

  <h1 class="p-3" > pointage du : {{$jour}}</h1>
    <table class="table p-3" "style="background: linear-gradient(to right, #3A5F85 ,  #506C87 );">
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