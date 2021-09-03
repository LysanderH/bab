@extends('layout.app', ['title'=>'Accueil'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading"><a href="{{ route('student.dashboard') }}" class="header__link">Book a Book</a>
                <span class="sr-only">- Accueil</span>
            </h1>
            <x-user-menu />
        </div>
    </header>
    <main>
        <div class="message__wrapper">
            <p class="message">
                La date limite pour commander des livres est le <b>{{ $period->deadline->format('d/m/Y') }}</b>.
            </p>
        </div>
        @if ($order)
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
                            ISBN
                        </th>
                        <th class="talbe__heading" scope="col">
                            Titre
                        </th>
                        <th class="talbe__heading" scope="col">
                            Auteur
                        </th>
                        <th class="talbe__heading" scope="col">
                            Prix
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
                                <td class="talbe__data">
                                    {{ $book->ISBN }}
                                </td>
                                <td class="talbe__data">{{ $book->title }}</td>
                                <td class="talbe__data">
                                    {{ $book->author }}
                                </td>
                                <td class="talbe__data">
                                    @currency($book->pivot->current_price)
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        @endif
    </main>

@endsection
