<!DOCTYPE html>
<html lang="en">
  @extends('layout.app')
  @section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-2"></div>
      <div  class="d-flex justify-content-center align-items-center  col-8 mb-3" style="background:#84addb;">
        <h1 class=" text-white">Liste des destinataires du rapport</h1>
      </div>
    </div>

  </div>



&nbsp

<div class="table-responsive">
    <table class="table table-bordered p-3">
        <thead class=""style="background: linear-gradient(to right, #84addb , #84addb  );">
            <tr>
                <th scope="col" class=" text-white">id</th>
                <th scope="col"  class=" text-white" >Nom</th>
                <th scope="col" class=" text-white">Email</th>
                <th scope="col" class=" text-white">Option</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($user as $personne )
            @auth
            @if (auth()->user()->id!=$personne->id)


            <tr>
                <td>{{$personne->id}}</td>
                <td>{{$personne->name}}</td>
                <td>{{$personne->email}}</td>

                <td>
                    <a href="{{ route('user.destroy', $personne->id) }}"
                        onclick="event.preventDefault();
                        if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateurs ?')) {
                            document.getElementById('delete-form{{$personne->id}}').submit();
                        }">
                        <button class="btn  text-white" style="background: linear-gradient(to right, #84addb ,  #84addb );" type="submit"><i class="fa fa-trash"></i></button>
                    </a>

                    <form id="delete-form{{$personne->id}}" action="{{ route('user.destroy', $personne->id) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>
                </td>
            </tr>
            @endif
           @endauth
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-end">
    <div class="">
        <a href="/register" class="btn text-white" style="background: linear-gradient(to right, #84addb , #84addb);">Ajouter une utilisteur</a>
    </div>
</div>

@endsection
