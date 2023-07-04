@extends('layout.app')

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissable m-3">
    {{session('success')}}
</div>

@endif

<h1>Carte ID N° : {{$carte_id}}</h1>



<form method="POST" action="{{route("postpaiment")}}" >
    @csrf

    <input type="hidden" class="form-control" id="carte_id" name="carte_id" value="{{$carte_id}}">
   

    <div class="form-group">
      <label for="motant">Montant</label> 
      <input type="number" required class="form-control" id="motant" name="motant" value="">
      @error('prenom')
      <div class="text-danger">{{ $message }}</div>
      @enderror 
    </div>
    <button type="submit" class="btn text-white" style="background: #84addb;">Submit</button>
  </form>
@endsection