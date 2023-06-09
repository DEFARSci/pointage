<!DOCTYPE html>
<html lang="en">
  @extends('layout.app')
  @section('content')


<div class="d-flex justify-content-end">
    <div class="col-md-5 offset-md-7 col-lg-4 offset-lg-8">
        <a href="{{ route('personne-create') }}" class="btn text-white" style="background: linear-gradient(to right, #84addb , #84addb);">Ajouter une personne</a>
    </div>
</div>

&nbsp

<div class="table-responsive">
    <table class="table table-bordered p-3">
        <thead class=""style="background: linear-gradient(to right, #84addb , #84addb  );">
            <tr>
                <th scope="col" class=" text-white">Prenom</th>
                <th scope="col"  class=" text-white" >Nom</th>
                <th scope="col" class=" text-white">Email</th>
                <th scope="col" class=" text-white">Role</th>
                <th scope="col" class=" text-white">Option</th>
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
                    <a href="{{ route('personne-edit', $personne->id) }}" class="btn  text-white" style="background: linear-gradient(to right, #84addb ,  #84addb );"><i class="fa fa-pencil-square-o"></i></a>
                
                
                    <a href="{{ route('personnes.destroy', $personne->id) }}"
                        onclick="event.preventDefault();
                        if (confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
                            document.getElementById('delete-form{{$personne->id}}').submit();
                        }">
                        <button class="btn  text-white" style="background: linear-gradient(to right, #84addb ,  #84addb );" type="submit"><i class="fa fa-trash"></i></button>
                    </a>
                    
                    <form id="delete-form{{$personne->id}}" action="{{ route('personnes.destroy', $personne->id) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
