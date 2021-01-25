@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="text-center">Crea un articolo</h2>


        <form action="{{route('articoli.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <input type="text" name="nome" class="form-control" placeholder="nome articolo">
                    @error('nome')
                        <div class="alert alert-danger">L'articolo deve avere un nome</div>
                    @enderror
            </div>

            <div class="form-group">
                <textarea name="descrizione" id="" ></textarea>
                 @error('descrizione')
                    <div class="alert alert-danger">L'articolo deve avere una descrizione</div>
                @enderror

            </div>

            <div class="form-group">
                <input type="text" name="prezzo" class="form-control" placeholder="prezzo articolo">
                @error('prezzo')
                    <div class="alert alert-danger">L'articolo deve avere un prezzo</div>
                @enderror

            </div>

            <div class="form-group">
                <input type="file" name="immagine" class="form-control" value="ciao">

            </div>

            <div class="form-group">
                @foreach($categorie as $categoria)
                    <label for="categoria_{{$categoria->id}}">
                        <input type="checkbox" value="{{$categoria->id}}" name="categoria_id[]">
                        {{$categoria->nome}}
                    </label>
                @endforeach
            </div>



            <button type="submit">Crea il post</button>
        </form>

    </div>

@endsection
