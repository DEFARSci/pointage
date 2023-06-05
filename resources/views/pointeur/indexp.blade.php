<!DOCTYPE html>
<html lang="en">
  @extends('layout.app')
  @section('content')
  
 
<div  class="col-md-5 offset-md-10">
    <a href="{{ route('personne-create') }}" class="btn btn-primary  ">Ajouter une personne</a>
</div>

&nbsp

    <table class="table p-3">
        <thead>
          <tr>
        
            <th scope="col">Prenom</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Rption</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($personnes as $personne )
          <tr>
            
            <td>{{$personne->prenom}}</td>
            <td>{{$personne->nom}}</td>
            <td>{{$personne->email}}</td>
            <td>{{$personne->role}}</td>
            
          
            <td> 

             <a href="{{ route('personne-edit', $personne->id) }}" class="btn btn-primary mx-1 "  ><i class="fa fa-pencil-square-o" ></i></a>

            </td>

            <td>
             <a href="{{ route('personnes.destroy', $personne->id) }}"
            onclick="event.preventDefault();
            if (confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
                document.getElementById('delete-form').submit();
            }">
    <button  class="btn btn-danger mx-1"  type="submit"><i class="fa fa-trash" ></i></button>
</a>

<form id="delete-form" action="{{ route('personnes.destroy', $personne->id) }}" method="POST" style="display: none;">
    @method('DELETE')
    @csrf
</form>
</td>
            
          </tr>
          @endforeach

        </tbody>
      </table>


@endsection
