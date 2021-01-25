@extends('layouts.app')
@section('content')
   <div class="container">


           @if (session('message'))
               <div class="alert alert-success">
                   {{ session('message') }}
               </div>
           @endif

            @auth
               <div class="d-flex justify-content-between">
                   <button><a href="{{route('articoli.store')}}">Crea articolo</a></button>

                   <a href="{{route('categorie.index')}}">Categorie</a>
               </div>
               <h1 class="text-center">Articoli</h1>
            @endauth

          <div class="row">
              @foreach($articoli as $articolo)
                  <div class="col-4">
                      <div class="card d-flex ">


                          <div class="card-body">

                              <h4 class="card-title"> <a href="{{route('articoli.show', $articolo)}}">{{$articolo->nome}}</a> </h4>
                              <div class="contenitore-immagine">
                                  <img class="card-img-top" src="{{asset('/storage/immagini_articoli/' . $articolo->immagine)}}" alt="">
                              </div>
                              <p class="card-text card-descrizione">{{$articolo->descrizione}}</p>
                              <p class="card-text text-center card-prezzo">{{$articolo->prezzo}} €</p>
                             {{-- @dump($articolo->categoria)--}}
                             {{-- @foreach ($articolo->categoria as $categoria)
                                 <p class="categorie-articolo"> {{$categoria->pivot->nome}}</p>
                                 <p>{{$categoria->nome}}</p>
                              @endforeach --}}

                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
   </div>

   {{$articoli->links()}}
@endsection
