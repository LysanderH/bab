@extends('layout.app', ['title'=>'Commande'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading"><a href="{{ route('admin.dashboard') }}" class="header__link">Book a Book</a>
                <span class="sr-only">- Apperçu de commande</span>
            </h1>
            <x-admin-menu />
        </div>
    </header>
    <nav class="controls" aria-label="Navigation de la ressource">
        <h2 class="controls__heading sr-only" role="heading" aria-level="2">Navigation de la ressource</h2>
        <div class="controls__wrapper">
            <a href="{{ route('admin.order.edit', ['order' => $order]) }}"
               class="controls__link">Modifier la commande</a>
        </div>
    </nav>
    <div class="user-wrapper">
        <p class="user-wrapper__user">{{ $order->user->name }}</p>
        <p class="user-wrapper__user"><a href="mailto:{{ $order->user->email }}"
               class="email">{{ $order->user->email }}</a></p>
        <img src="{{ asset('storage/avatars/' . $order->user->avatar) }}" alt="Foto de profil"
             width="250"
             height="250">
    </div>
    <table class="table">
        <thead class="table__head">
            <tr class="table__row">
                <th class="talbe__heading" scope="col">
                    &nbsp;
                </th>
                <th class="talbe__heading" scope="col">
                    &nbsp;
                </th>
                <th class="talbe__heading" scope="col">
                    Titre
                </th>
                <th class="talbe__heading" scope="col">
                    Auteur
                </th>
                <th class="talbe__heading" scope="col">
                    Exemplaires
                </th>
                <th class="talbe__heading" scope="col">
                    Prix
                </th>
                <th class="talbe__heading" scope="col">
                    ISBN
                </th>
            </tr>
        </thead>
        <tbody class="table__body" wire:loading.class.delay="loading">
            @if (count($order->books))
                @foreach ($order->books as $book)
                    <tr class="table__row">
                        <td class="talbe__data">{{ $loop->iteration }}</td>
                        <td class="talbe__data">
                            <img src="{{ asset('storage/covers/small_' . $book->cover) }}" alt="Foto de profil"
                                 width="250"
                                 height="250">
                        </td>
                        <td class="talbe__data">{{ $book->title }}</td>
                        <td class="talbe__data">
                            {{ $book->author }}
                        </td>
                        <td class="talbe__data">
                            {{ $book->pivot->amount }}
                        </td>
                        <td class="talbe__data">
                            @currency($book->price)
                        </td>
                        <td class="talbe__data">
                            {{ $book->ISBN }}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="table__row">
                    <td class="talbe__data table__data--no-data" colspan="3">
                        Aucun livre existe
                    </td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr class="table__row">
                <th scope="row" colspan="5">Total</th>
                <td scope="row" colspan="2">@currency($order->total)</td>
            </tr>
        </tfoot>
    </table>
@endsection
