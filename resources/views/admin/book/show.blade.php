@extends('layout.app', ['title'=>'Titre du livre'])

@section('content')
    <nav class="controlls" aria-label="Outils du livre">
        <h2 class="controlls__heading sro" role="heading" aria-level="2">Outils du livre</h2>
        <a href="{{ route('admin.book.edit', ['book' => $book->id]) }}">Modifier</a>
    </nav>
    <section class="book" aria-label="Titre du livre">
        <h2 class="book__heading" role="heading" aria-level="2">{{ $book->title }}</h2>
        <img src="{{ asset('storage/covers/' . $book->cover) }}" alt="Couverture du livre {{ $book->title }}"
             class="book__img" width="500" height="500">
        <p class="book__isbn">{{ $book->ISBN }}</p>
        <p class="book__price">{{ $book->price }}€</p>
        <p class="book__stock">{{ $book->stock }} examplaires</p>
        <p class="book__category">{{ $book->category->name }}</p>
        <p class="book__category">{{ $book->bac->name }}</p>
        <p class="book__description">{{ $book->excerpt }}</p>
    </section>
@endsection
