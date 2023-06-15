
  @extends('layout.app')
  @section('content')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <div class="ml-6">
    
           
            <h3>{{ $userPointer->prenom}}&nbsp{{ $userPointer->nom }} </h3>
            <h6><b >Carte_ID : </b>{{ $userPointer->carte_id }}</h6>
            <h6><b >Email : </b>{{ $userPointer->email }}</h6>
            <h6><b>Phone : </b>{{ $userPointer->phone }}</h6>   
              <div class="container d-flex  justify-content-center">
                <div  class="  p-3 " id="piechart" style="width: 800px; height: 400px;"></div>

              </div>
              <form action="" method="get">
                <div class="d-flex justify-content-end mt-5">
                  <select name="month" class="pl-5 justify-content-cente">
                    <option value="1">Janvier</option>
                    <option value="2">Février</option>
                    <option value="3">Mars</option>
                    <option value="4">Avril</option>
                    <option value="5">Mai</option>
                    <option value="6">Juin</option>
                    <option value="7">Juillet</option>
                    <option value="8">Août</option>
                    <option value="9">Septembre</option>
                    <option value="10">Octobre</option>
                    <option value="11">Novembre</option>
                    <option value="12">Décembre</option>
                  </select>
             <button type="submit" class="btn  text-white" style="background: linear-gradient(to right,#84addb ,  #84addb );" > <i class="fas fa-search"></i></button>
                  
                      </div>
                
              </form>
            
  <table class="table table-sm ">
     <thead > 

           <th scope="col">Date</th>
            <th scope="col">Arrive</th>
            <th scope="col">Depart</th>
    
  </thead>

  <tbody>
    @if ($pointage ==null)
    <h1 class="bg-danger">La personne n'a pas encore pointer</h1>
        
    @else
    
             @foreach ($pointage as $pointeur )

             <tr>


            <td> {{ $pointeur->date}} </td>
         <td> {{ $pointeur-> heurDarriver}}</td>
        <td> {{ $pointeur->heurDepart}}</td>

        </tr>

    @endforeach
    
    </tbody>
</table>
@endif
    </div > 
    
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
                title: 'Taux de présence',
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
                colors: ['#84addb','red'],
                
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






