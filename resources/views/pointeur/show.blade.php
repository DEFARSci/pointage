@extends('layout.app')

@section('content')
<h3>Pointer Details</h3>
<table >


    <tr>

    <td>

        @foreach($pointage as $pointeur)

    <p>ID : {{ $pointeur->carte_id }}</p>
    <p>Prenom : {{ $pointeur->prenom }}</p>
    <p>Nom : {{ $pointeur->nom }}</p>
    <p>Email : {{ $pointeur->email }}</p>
    <p>Phone : {{ $pointeur->phone }}</p>
    <p>Arrrive : {{ $pointeur-> heurDarriver}}</p>
    <p>Depart : {{ $pointeur->heurDepart}}</p>

    </td>
@endforeach



</tr>

</table>
@endsection