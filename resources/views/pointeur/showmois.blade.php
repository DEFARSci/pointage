
  @extends('layout.app')
  @section('content')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <div class="ml-6">
    <div class="container d-flex  justify-content-center">
      <h1 class="m-5 text-white text-center col-4 " style="background-color: #84addb ">{{$mois}}</h1>
      </div>
    
           
            <h3>{{ $userPointer->prenom}}&nbsp{{ $userPointer->nom }} </h3>
            <h6><b >Carte_ID : </b>{{ $userPointer->carte_id }}</h6>
            <h6><b >Email : </b>{{ $userPointer->email }}</h6>
            <h6><b>Phone : </b>{{ $userPointer->phone }}</h6> 
           
            <div class="container  justify-content-center">
              <div class="row">

                <div class="  col-4 d-flex align-items-center justify-content-end "><h4 class="m-0 text-decoration-underline">Diagramme de présence<br> du mois de {{$mois}}</h4></div>
                <div  class="" id="piechart" style="width: 800px; height: 400px;"></div>
              </div>

            </div>
              
    
            <div class="table-responsive" style="max-height: 500px;overflow-y: scroll;">
              <table class="table table-bordered p-3">
              <thead class=""style="background: linear-gradient(to right, #84addb , #84addb );">

           <th scope="col" class=" text-white">Date</th>
            <th scope="col" class=" text-white">Arrive</th>
            <th scope="col" class=" text-white">Depart</th>
            <th scope="col"class=" text-white">Paiement-Retard</th>
    
  </thead>

  <tbody>
    @if ($pointage ==null)
    <h1 class="bg-danger">La personne n'a pas encore pointer</h1>
        
    @else
    @if ($percentage==0)
      <h3>Pas de pointage pour le mois de  {{$mois}} </h3>

    @endif
             @foreach ($pointage as $pointeur )
           @if (date('n',strtotime( $pointeur->date))==$testmois)
              
        
             <tr>


            <td> {{$pointeur->date}} </td>
         <td> {{ $pointeur-> heurDarriver}}</td>
        <td> {{ $pointeur->heurDepart}}</td>
        <td>{{$pointeur->paiementRetard}}</td>


        </tr>
        
        @endif
    @endforeach
    
    </tbody>
</table>
            </div>
@endif
    </div > 
    <div class="row">
      <div class="col-md-2"></div>
      <div  class="d-flex justify-content-center align-items-center  col-5 mb-3" >
        
      </div>
      <div class="col-md-5 d-flex justify-content-end ">
        <h3 class="p-3 text-white" style="background:#84addb;"> Montant Total :{{$total}}</h3>
  
      </div>
    </div>
    
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
      
            function drawChart() {
      
                var percentage = {{ $percentage }};

var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Présent',     percentage],
  ['Abscent',     100-percentage]
 
 
]);
      
              var options = {
                // title: 'My Daily Activities'
                // title: 'Taux de présence',
                titleTextStyle: {
                     color: 'black',
                     fontName: 'Arial',
                     fontSize: 18,
                   },
                // backgroundColor: '#f5f5f5',
                // pieHole: 0.4,
                // pieSliceBorderColor: 'red',
                pieSliceTextStyle: {
                   color: 'white',
                  fontName: 'Arial',
                   fontSize: 15
                  },
                  // legend: {
                  //   position: 'bottom'
                  //   },
                colors: ['#84addb','#e9651e'],
                
                    // is3D: true
              
                
              };
      
              var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      
              chart.draw(data, options);
            }
          </script>
    


{{-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var percentage = {{ $percentage }};

    var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      ['Work',     percentage],
      ['Eat',     100-percentage]
     
     
    ]);

    var options = {
      title: 'My Daily Activities'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }
</script> --}}
@endsection






