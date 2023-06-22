@extends('layout.app')

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissable m-3">
    {{session('success')}}
</div>

@endif

<h1>Carte ID N° : {{$pointeur->carte_id}}</h1>



<form method="POST" action="{{route('saveuserPointer',['id'=>$pointeur->id])}}" >
    @csrf
  @method("PUT")
    <input type="hidden" class="form-control" id="carte_id" name="carte_id" value="{{old('cart_id',$pointeur->carte_id)}}">
    <input type="hidden" class="form-control" id="id" name="id" value="{{old('id',$pointeur->id)}}">

    <div class="form-group">
      <label for="prenom">Prenom</label>
      <input type="text" class="form-control" id="prenom" name="prenom" value="{{old('prenom',$pointeur->prenom)}}">
      @error('prenom')
      <div class="text-danger">{{ $message }}</div>
      @enderror 
    </div>
    <div class="form-group">
      <label for="nom">Nom</label>
      <input type="text" class="form-control" id="nom" name="nom"  value="{{old('nom',$pointeur->nom)}}">
      @error('nom')
      <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email"  value="{{old('eamil',$pointeur->email)}}" >
        @error('email')
        <div class="text-danger">{{ $message }}</div>
        @enderror  
    </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="phone" class="form-control" id="phone" name="phone"  value="{{old('phone',$pointeur->phone)}}" >
        @error('phone')
        <div class="text-danger">{{ $message }}</div>
        @enderror 
    </div>
   
    <button type="submit" class="btn text-white" style="background: #84addb;">Submit</button>
  </form>
@endsection