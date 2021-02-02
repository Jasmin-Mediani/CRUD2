<?php

namespace App\Http\Controllers;

use App\Models\Articolo;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class ArticoloController extends Controller
{
    //solo gli utenti autenticati possono accedere alle varie funzioni e relative view. Index e show le voglio visibili per tutti:
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index' , 'show', 'search']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articoli = Articolo::orderBy('created_at', 'desc')->paginate(5);

        return view('articoli.index')->with(['articoli' => $articoli]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorie = Categoria::all();

        return view('articoli.create', ['categorie' => $categorie]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'nome' => 'required|unique:articolos|min:1|max:255',
            'descrizione' => 'required|min:1|',
            'prezzo' => 'required|numeric|min:1',
            'immagine' => 'image|nullable|max:1999' //1999 per tanti server apache con upload max di 2mb

        ]);

        //Gestione dell'upload:
        if ($request->hasFile('immagine')) {
            //prendo nome file  + estensione:
            $nomeFileConEstensione = $request->file('immagine')->getClientOriginalName();

            //prendo solo il nome, senza estenzione:
            $nomeFile = pathinfo($nomeFileConEstensione, PATHINFO_FILENAME);

            //prendo l'estensione:
            $estensione = $request->file('immagine')->getClientOriginalExtension();

            //salvo il nome del file: nome + estensione:
            $nomeFileDaSalvare = $nomeFile.'_'.time().'.'.$estensione;

            //dove salva i file:
            $path = $request->file('immagine')->storeAs('public/immagini_articoli', $nomeFileDaSalvare);
            /*php artisan storage:link  e i file vanno anche nello storage di public*/

        } else {

            //$nomeFileDaSalvare = 'no_immagine.jpg';
        }

        //creazione dell'articolo, manuale:
        $articolo = new Articolo;
        $articolo->user_id = auth()->user()->id;
        $articolo->nome = $request->input('nome');
        $articolo->descrizione = $request->input('descrizione');
        $articolo->immagine = $nomeFileDaSalvare;
        $articolo->prezzo = $request->input('prezzo');
        $articolo->save();

        $articolo->categoria()->sync($request->get('categoria_id')); //per attaccare le categorie ai post

        return redirect('/')->with('message', "Articolo creato correttamente");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articolo  $articolo
     * @return \Illuminate\Http\Response
     */
    public function show(Articolo $articolo)
    {
        return view('articoli.show', ['articolo' => $articolo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Articolo  $articolo
     * @return \Illuminate\Http\Response
     */
    public function edit(Articolo $articolo)
    {   $categorie = Categoria::all();

        return view('articoli.edit', ['articolo' => $articolo, 'categorie' => $categorie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articolo  $articolo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articolo $articolo)
    {

        $this->validate($request, [
            'nome' => 'required|unique:articolos,id,'.$articolo->id.'|min:1|max:255', //unique, ma deve escludere l'id corrente, altrimenti sembra sia un doppione
            'descrizione' => 'required|min:1|',
            'prezzo' => 'required|numeric|min:1',
            'immagine' => 'image|nullable|max:1999' //1999 per tanti server apache con upload max di 2mb
        ]);

        //Gestione della modifica dell'immagine:
        if ($request->hasFile('immagine')) {
            Storage::disk('public')->delete('immagini_articoli/'. $articolo->immagine); //se sto uppando un'immagine, cancello quella già presente dello storage

            //prendo nome file  + estensione:
            $nomeFileConEstensione = $request->file('immagine')->getClientOriginalName();

            //prendo solo il nome, senza estenzione:
            $nomeFile = pathinfo($nomeFileConEstensione, PATHINFO_FILENAME);

            //prendo l'estensione:
            $estensione = $request->file('immagine')->getClientOriginalExtension();

            //salvo il nome del file: nome + estensione:
            $nomeFileDaSalvare = $nomeFile.'_'.time().'.'.$estensione;
            $path = $request->file('immagine')->storeAs('public/immagini_articoli', $nomeFileDaSalvare);

            $articolo->immagine = $nomeFileDaSalvare;
        }

        // Aggiornamento del post:
        $articolo->nome = $request->input('nome');
        $articolo->descrizione = $request->input('descrizione');
        $articolo->prezzo = $request->input('prezzo');
        $articolo->save();

        $articolo->categoria()->sync($request->get('categoria_id'));  //per sincronizzare le nuove categorie selezionate

        return redirect('/')->with('message', 'Articolo modificato correttamente');
    }

    public function search(Request $request){
        $search = $request->get('search');

         /* $this->validate($request, [
                'search' => 'min:1|max:255'
          ]);*/


        /*if (strlen($search) > 0)  {*/
            $articoli = Articolo::where('nome', 'like', '%' . $search . '%')->paginate(5);
            return view('articoli.search', ['articoli' => $articoli]);
       /* } else {
            return redirect('/');
        }*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articolo  $articolo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articolo $articolo)

    {
        //parte da storage/app/public e cancella immagini_articoli/$articolo->immagine
        Storage::disk('public')->delete('immagini_articoli/'. $articolo->immagine); //prima cancello dallo storage l'immagine dell'articolo
        $articolo->delete();  //poi cancello l'articolo

        return redirect('/')->with('message', "Articolo eliminato correttamente");
    }
}


