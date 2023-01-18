<!DOCTYPE html>
<html lang="en">
  @extends('layout.app')
  @section('content')
    <table class="table p-3">
        <thead>
          <tr>
            <th scope="col">carte ID</th>
            <th scope="col">Prenom</th>
            <th scope="col">Nom</th>
            <th scope="col">email</th>
            <th scope="col">Phone</th>
            <th scope="col">option</th>
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
            <td><a type="button"  href="{{route('getuserPointer',['id'=>$pointeur->id])}}">edit</td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
@endsection