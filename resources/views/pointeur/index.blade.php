<!DOCTYPE html>
<html lang="en">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  @extends('layout.app')
  @section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-2"></div>
      <div  class="d-flex justify-content-center align-items-center  col-8 mb-3" style="background:#84addb;">
        <h1 class=" text-white">Liste des employés de la RDL</h1>
      </div>
    </div>

  </div>
  <div class="table-responsive" style="max-height: 600px;overflow-y: scroll;">
    <table class="table table-bordered p-3">
      <thead class=""style="background:#84addb;">
          <tr>
            <th scope="col" class=" text-white">carte ID</th>
            <th scope="col" class=" text-white">Prenom</th>
            <th scope="col" class=" text-white">Nom</th>
            <th scope="col" class=" text-white">email</th>
            <th scope="col" class=" text-white">Phone</th>
            <th scope="col" class=" text-white">option</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($userPointeur as $pointeur )
          <tr>
            <th scope="row">{{$pointeur->carte_id}}</th>
            <td>{{$pointeur->prenom}}</td>
            <td>{{$pointeur->nom}}</td>
            <td>{{$pointeur->email}}</td>
            <td>{{$pointeur->phone}}</td>
            <td> 
      
              <button type="button" class="btn  text-white" style="background: #84addb;" onclick="window.location.href='{{route('getuserPointer',['id'=>$pointeur->id])}}'"> <i class="fas fa-pencil-alt"></i></button>
             
              <button type="button" class="btn  text-white"  style="background: #84addb;" onclick="window.location.href='{{ route('voirPointer', ['carte_id'=>$pointeur->carte_id]) }}'"> <i class="fas fa-eye"></i></button>
            </td>

          </tr>
          @endforeach

        </tbody>
      </table>
  </div>
 
@endsection
