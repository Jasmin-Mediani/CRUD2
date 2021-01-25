@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="text-center">Modifica la categoria</h2>


        <form action="{{route('categorie.update', $categoria)}}" method="POST">
            @csrf
            @method('PUT')

                <div class="form-group"><input type="text" name="nome" class="form-control" placeholder="nome categoria" value="{{old('nome', $categoria->nome)}}"></div>
                {{--@error('nome')
                <div class="alert alert-danger">La categoria deve avere un nome</div>
                    @enderror--}}

            <input type="submit" value="Salva"></input>
        </form>

    </div>

    @if(Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif


@endsection
