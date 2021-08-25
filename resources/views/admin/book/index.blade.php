@extends('layout.app', ['title'=>'Liste des livres'])

@section('content')
    <ul class="list">
        <li class="list__item"><a href="" class="list__link">
                <article class="book-item" aria-label="Titre du livre">
                    <h2 class="book-item__heading" role="heading" aria-level="2">Titre du livre</h2>
                    <img src="" alt="Couverture du livre Titre du livre">
                </article>
            </a>
        </li>
    </ul>
@endsection
