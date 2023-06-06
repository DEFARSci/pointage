<!DOCTYPE html>
<html lang="en">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  @extends('layout.app')
  @section('content')
  <div class="table-responsive">
    <table class="table table-bordered p-3">
      <thead class=""style="background: linear-gradient(to right, #3A5F85 ,  #506C87 );">
          <tr>
            <th scope="col" class=" text-white"">carte ID</th>
            <th scope="col" class=" text-white"">Prenom</th>
            <th scope="col" class=" text-white"">Nom</th>
            <th scope="col" class=" text-white"">email</th>
            <th scope="col" class=" text-white"">Phone</th>
            <th scope="col" class=" text-white"">option</th>
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
            <td> <button type="button" class="btn  text-white" style="background: linear-gradient(to right, #3A5F85 ,  #506C87 );" onclick="window.location.href='{{route('getuserPointer',['id'=>$pointeur->id])}}'"> <i class="fas fa-pencil-alt"></i></button>
              <button type="button" class="btn  text-white"  style="background: linear-gradient(to right, #3A5F85 ,  #506C87 );" onclick="window.location.href='{{ route('voirPointer', ['carte_id'=>$pointeur->carte_id]) }}'"> <i class="fas fa-eye"></i></button>


          </tr>
          @endforeach

        </tbody>
      </table>
  </div>
@endsection
