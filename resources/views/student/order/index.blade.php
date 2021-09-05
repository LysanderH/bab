@extends('layout.app', ['title'=>'Mes commandes'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading"><a href="{{ route('student.dashboard') }}" class="header__link">Book a Book</a>
                <span class="sr-only">- Mes commandes</span>
            </h1>
            <x-user-menu />
        </div>
    </header>
    <main>
        @include('layout.success')
        @include('layout.error')
        <section class="controls" aria-label="Navigation de la ressource">
            <h2 class="sr-only controls__heading" role="heading" aria-level="2">Navigation de la ressource</h2>
            <div class="controls__wrapper">
                <a href="{{ route('student.order.create') }}" class="controls__link">Passer une commande</a>
            </div>
        </section>

        <ul class="u-order__list">
            @foreach ($orders as $order)
                <li class="u-order__item">
                    <div class="u-order__wrapper">
                        <time class="u-order__date"
                              datetime="{{ $order->created_at }}">{{ $order->created_at->format('d/m/Y à H:i') }}</time>
                        <span class="u-order__total">@currency($order->total)</span>
                    </div>
                    <ul class="u-order__books">
                        @foreach ($order->books->sortBy('title') as $book)
                            <li class="u-books__item">
                                <img src="{{ asset('storage/covers/small_' . $book->cover) }}" alt="Foto de profil"
                                     width="250"
                                     height="250"
                                     class="u-books__img">
                                <span class="u-books__heading">{{ $book->title }}</span>
                                <span class="u-books__price">@currency($book->pivot->current_price)</span>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach

        </ul>
    </main>
@endsection
