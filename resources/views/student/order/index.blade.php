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
            <h2 class="controls__heading sr-only" role="heading" aria-level="2">Navigation de la ressource</h2>
            <div class="controls__wrapper">
                <a href="{{ route('student.order.create') }}" class="controls__link">Passer une commande</a>
            </div>
        </section>

        <ul class="order__list">
            @foreach ($orders as $order)
                <li class="order__item">
                    <time class="order__date"
                          datetime="{{ $order->created_at }}">{{ $order->created_at->format('d/m/Y à H:i') }}</time>
                    <span>@currency($order->total)</span>
                    <ul class="order__books">
                        @foreach ($order->books as $book)
                            <li class="books__item">
                                <img src="{{ asset('storage/covers/small_' . $book->cover) }}" alt="Foto de profil"
                                     width="250"
                                     height="250">
                                <span class="books__heading">{{ $book->title }}</span>
                                <span class="books__price">@currency($book->pivot->current_price)</span>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach

        </ul>
    </main>
@endsection
