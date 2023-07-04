@extends('layout.app')

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissable m-3">
    {{session('success')}}
</div>

@endif

<h3>Carte ID N° : {{$carte_id}}</h3>

<h1>{{$pointeur->prenom}} {{$pointeur->nom}}</h1>



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
  <div class="table-responsive pt-3" >
    <table class="table table-bordered p-3">
      <thead class=""style="background:#84addb;">
          <tr>
            <th scope="col" class=" text-white">Date</th>
            <th scope="col" class=" text-white">Montant</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($paiements as $paiement) 
          <tr>
            <td>{{$paiement->date}}</td>
            <td>{{$paiement->depot}}</td>

          </tr>
          @endforeach

        </tbody>
      </table>
  </div>
@endsection