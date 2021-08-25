@extends('layout.app', ['title'=>'Titre du livre'])

@section('content')
    <nav class="controlls" aria-label="Outils du livre">
        <h2 class="controlls__heading sro" role="heading" aria-level="2">Outils du livre</h2>
        {{-- <a href="{{ route('book.destroy', ['id' => $book->id]) }}">Supprimer</a> --}}
        {{-- <a href="{{ route('book.edit', ['id' => $book->id]) }}">Modifier</a> --}}
    </nav>
    <section class="book" aria-label="Titre du livre">
        <h2 class="book__heading" role="heading" aria-level="2">Titre du livre</h2>
        <img src="" alt="" class="book__img" width="500" height="400">
        <p class="book__isbn"></p>
        <p class="book__price">X€</p>
        <p class="book__stock">X examplaires</p>
        <p class="book__description"></p>
    </section>
@endsection
