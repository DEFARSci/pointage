@extends('layout.app')

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissable m-3">
    {{session('success')}}
</div>

@endif

    <form method="post" action="{{route('create')}}" >
    @csrf

    <div class="form-group">
      <label for="prenom">Prenom</label>
      <input type="text" class="form-control" id="prenom" name="prenom" >
      @error('prenom')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
      <label for="nom">Nom</label>
      <input type="text" class="form-control" id="nom" name="nom"  >
      @error('nom')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email"   >
        @error('email')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
      <div class="form-group">
        <label for="role">Role</label>
        <input type="text" class="form-control" id="role" name="role"  >
        @error('role')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn text-white"style="background:#84addb;">Submit</button>
  </form>








<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ajouterPersonneBtn = document.getElementById('ajouterPersonneBtn');
        var ajouterPersonneForm = document.getElementById('ajouterPersonneForm');

        ajouterPersonneBtn.addEventListener('click', function() {
            ajouterPersonneForm.style.display = 'block';
        });
    });
</script>

@endsection