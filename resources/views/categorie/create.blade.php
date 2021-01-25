@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="text-center">Crea una categoria</h2>


        <form action="{{route('categorie.store')}}" method="POST">
            @csrf

            <div class="form-group">
                <input type="text" name="nome" class="form-control" placeholder="nome categoria">
                {{--@error('nome')
                <div class="alert alert-danger">L'articolo deve avere un nome</div>
                    @enderror
--}}
            </div>

            <button type="submit">Crea la categoria</button>
        </form>

    </div>

@endsection
