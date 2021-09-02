@extends('layout.app', ['title'=>'Mes commandes'])

@section('content')
    <header class="header">
        <h1>Mes commandes</h1>
        <x-user-menu />
    </header>
    <main>
        <section class="controls" aria-label="Navigation de la ressource">
            <h2 class="controls__heading sr-only" role="heading" aria-level="2">Navigation de la ressource</h2>
            <div class="controls__wrapper">
                <a href="{{ route('student.order.create') }}" class="controls__link">Passer une commande</a>
            </div>
        </section>
        <table class="table">
            <thead class="table__head">
                <tr class="table__row">
                    <th class="talbe__heading" scope="col">
                        &nbsp;
                    </th>
                    <th class="talbe__heading" scope="col">
                        Date
                    </th>
                    <th class="talbe__heading" scope="col">
                        Total
                    </th>
                    <th class="talbe__heading" scope="col">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody class="table__body" wire:loading.class.delay="loading">
                @if (count($orders))
                    @foreach ($orders as $order)
                        <tr class="table__row">
                            <td class="talbe__data">{{ $loop->iteration }}</td>
                            <td class="talbe__data">{{ $order->name }}</td>
                            <td class="talbe__data">
                                @currency($order->total)
                            </td>
                            <td class="talbe__data">
                                {{ $order->status->name }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="table__row">
                        <td class="talbe__data table__data--no-data" colspan="5">
                            Aucun livre existe
                        </td>
                    </tr>
                @endif

            </tbody>
        </table>

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
