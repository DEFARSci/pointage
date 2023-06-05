@extends('layout.app')

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissable m-3">
    {{session('success')}}
</div>

@endif



<form method="POST" action="{{route('personnes.update',['id'=>$personne->id])}}" >
    @csrf
  @method("PUT")

  <a href="{{ route('personne-edit', ['id' => $personne->id]) }}"></a>
    

    <div class="form-group">
      <label for="prenom">Prenom</label>
      <input type="text" class="form-control" id="prenom" name="prenom" value="{{old('prenom',$personne->prenom)}}">
      @error('prenom')
      <div class="text-danger">{{ $message }}</div>
      @enderror 
    </div>
    <div class="form-group">
      <label for="nom">Nom</label>
      <input type="text" class="form-control" id="nom" name="nom"  value="{{old('nom',$personne->nom)}}">
      @error('nom')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email"  value="{{old('eamil',$personne->email)}}" >
        @error('email')
        <div class="text-danger">{{ $message }}</div>
        @enderror  
    </div>
      <div class="form-group">
        <label for="phone">Role</label>
        <input type="phone" class="form-control" id="role" name="role"  value="{{old('role',$personne->role)}}" >
        @error('phone')
        <div class="text-danger">{{ $message }}</div>
        @enderror 
    </div>
   
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection