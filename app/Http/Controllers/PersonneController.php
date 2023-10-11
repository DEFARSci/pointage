<?php

namespace App\Http\Controllers;

use App\Models\Personne;

use Illuminate\Http\Request;

class PersonneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexp()
    {
       $personnes=Personne::all();

       return View('pointeur.indexp', compact('personnes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    return view('pointeur.personne-create');

    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,personne $personne)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'role' => ['required'],
        ]);
        $personne = new Personne;
        $personne->nom=$request->nom;
        $personne->prenom=$request->prenom;
        $personne->email=$request->email;
        $personne->role=$request->role;


        $personne->save();




        return redirect()->route('indexp')->with('success', 'Personne ajouter avec succèss');


        $sucess='User Created';
        return redirect()->back()->withSucess($sucess);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\personne  $personne
     * @return \Illuminate\Http\Response
     */
    public function show(personne $personne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\personne  $personne
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personne = Personne::find($id);
    return view('pointeur.personne-edit', compact('personne'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\personne  $personne
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, personne $personne,$id)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'role' => ['required'],
        ]);
        $personne = Personne::find($id);
    // Mettez à jour les champs de la personne en utilisant les données du formulaire ($request)

        $personne->nom=$request->nom;
        $personne->prenom=$request->prenom;
        $personne->email=$request->email;
        $personne->role=$request->role;

    $personne->save();
    return redirect()->route('indexp')->with('success', 'Personne mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\personne  $personne
     * @return \Illuminate\Http\Response
     */
    public function destroy(personne $personne,$id)
    {
        $personne = Personne::find($id);
    $personne->delete();
    return redirect()->route('indexp')->with('success', 'Personne supprimée avec succès.');
    }
}
