
  @extends('layout.app')
  @section('content')

  <div class="ml-6">
            
            <h3>{{ $userPointer->prenom}}&nbsp{{ $userPointer->nom }} </h3>
            <h6><b >Carte_ID : </b>{{ $userPointer->carte_id }}</h6>
            <h6><b >Email : </b>{{ $userPointer->email }}</h6>
            <h6><b>Phone : </b>{{ $userPointer->phone }}</h6>    
            
  <table class="table table-sm ">
     <thead > 

           <th scope="col">Date</th>
            <th scope="col">Arrive</th>
            <th scope="col">Depart</th>
    
  </thead>

  <tbody>
    
             @foreach ($pointage as $pointeur )

             <tr>


            <td> {{ $pointeur->date }} </td>
         <td> {{ $pointeur-> heurDarriver}}</td>
        <td> {{ $pointeur->heurDepart}}</td>

        </tr>

    @endforeach
    
    </tbody>
</table>
    </div > 
    
@endsection


        





