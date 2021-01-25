@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="text-center">Modifica un articolo</h2>


        <form action="{{route('articoli.update', $articolo)}}" method="POST"  enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <input type="text" name="nome" class="form-control" placeholder="nome articolo" value="{{old('nome', $articolo->nome)}}">
                @error('nome')
                <div class="alert alert-danger">L'articolo deve avere un nome</div>
                    @enderror
            </div>

            <div class="form-group">
                <textarea name="descrizione" id="" >{!!old('descrizione', $articolo->descrizione)!!}</textarea>
                @error('descrizione')
               <div class="alert alert-danger">L'articolo deve avere una descrizione</div>
               @enderror

            </div>

            <div class="form-group">
                <input type="text" name="prezzo" class="form-control" placeholder="prezzo articolo" value="{{old('prezzo', $articolo->prezzo)}}">
                @error('prezzo')
                <div class="alert alert-danger">L'articolo deve avere un prezzo</div>
                @enderror

            </div>

            <div class="form-group">
                <input type="file" name="immagine" class="form-control" value="{{old('immagine', $articolo->immagine)}}">

            </div>

            <div class="form-group">
                @foreach($categorie as $categoria)
                    {{$categoria->nome}}
                    <label for="categoria_{{$categoria->id}}">
                        <input type="checkbox" value="{{old('categoria_id', $categoria->id)}}" name="categoria_id[]"  {{$articolo->categoria->contains($categoria) ? 'checked' : ""}} />
                    </label>
                @endforeach
            </div>



            <button type="submit">Modifica l'articolo</button>
        </form>
    </div>

@endsection
