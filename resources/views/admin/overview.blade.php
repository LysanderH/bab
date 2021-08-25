@extends('layout.app', ['title'=>'Stock'])

@section('content')
    <ul class="list">
        <li class="list__item">
            <article class="book-item" aria-label="Titre du livre">
                <h2 class="book-item__heading" role="heading" aria-level="2">Titre du livre</h2>
                <img src="" alt="Couverture du livre Titre du livre">
                <p class="book-item__ordered">X examplaires commandé</p>
                <p class="book-item__ordered">Y examplaires en stock</p>
            </article>
        </li>
    </ul>
@endsection
