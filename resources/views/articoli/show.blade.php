@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="text-center">{{$articolo->nome}}</h2>
        <div class="contenitore-immagine-e-testo">
            <img class="card-img-top" src="{{asset('/storage/immagini_articoli/' . $articolo->immagine )}}" alt="">
            <p>{{$articolo->descrizione}}</p>
        </div>
        <div class="contenitore-categorie">
            @foreach($articolo->categoria as $categoria)
                #{{$categoria->nome}}
            @endforeach
            {{--@dump($articolo->categoria)--}}
        </div>

        @if(Auth::id() == $articolo->user_id)
            <div class="bottoni d-flex justify-content-between">
                <form action="{{route('articoli.edit', $articolo)}}" method="GET">
                    @csrf
                    <input type="submit" class="btn btn-warning" value="Modifica"/>
                </form>

                <form action="{{route('articoli.delete', $articolo)}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <input type="submit" class="btn btn-danger" value="Elimina"/>
                </form>
            </div>
        @endif
    </div>

@endsection
