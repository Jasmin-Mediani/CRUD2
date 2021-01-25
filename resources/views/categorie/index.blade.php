@extends('layouts.app')
@section('content')
<div class="container">
    <h2 class="text-center">Categorie</h2>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="d-flex justify-content-between">
        <button><a href="{{route('categorie.store')}}">Crea una categoria</a></button>

        <a href="{{route('articoli.index')}}">Articoli</a>
    </div>


    <table class="table">
        <thead>
            <tr>
                <th class="text-center">Nome categoria</th>
                <th class="text-center">azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $categorie as $categoria)
                <tr>
                    <td scope="row" class="text-center">{{$categoria->nome}}</td>
                    <td class="d-flex justify-content-around">

                        <form action="{{route('categorie.edit', $categoria)}}" method="GET">
                            @csrf
                            <input type="submit" class="btn btn-warning" value="Modifica"/>
                        </form>


                        <form action="{{route('categorie.delete', $categoria)}}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input type="submit" class="btn btn-danger" value="Elimina"/>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <form action=""></form>
</div>
@endsection
