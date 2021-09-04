@extends('layout.app', ['title'=>'Titre du livre'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading"><a href="{{ route('admin.dashboard') }}" class="header__link">Book a Book</a>
                <span class="sr-only">- Liste des livres</span>
            </h1>
            <x-admin-menu />
        </div>
    </header>
    <main>
        @include('layout.success')
        @include('layout.error')
        <nav class="controls" aria-label="Outils du livre">
            <h2 class="sr-only controls__heading" role="heading" aria-level="2">Outils du livre</h2>
            <a href="{{ route('admin.book.edit', ['book' => $book->id]) }}" class="controls__link">@include('icons.modify')
                Modifier</a>
            <form action="{{ route('admin.book.destroy', ['book' => $book->id]) }}"
                  method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="table__link table__link--delete">
                    @include('icons.delete')
                    <span class="sr-only">Supprimer
                        le livre</span>
                </button>
            </form>
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
    </main>
@endsection
