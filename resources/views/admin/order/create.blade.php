@extends('layout.app', ['title'=>'Ajouter une commande'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading"><a href="{{ route('admin.dashboard') }}" class="header__link">Book a Book</a>
                <span class="sr-only">- Ajouter une commande</span>
            </h1>
            <x-admin-menu />
        </div>
    </header>
    <main>
        <form method="POST" action="{{ route('admin.order.store') }}" enctype="multipart/form-data"
              class="form--order">
            @csrf

            <div class="form-group">
                <label for="user" class="form-label">{{ __('Utilisateur') }}</label>

                <select id="user" class="form-control @error('user') is-invalid @enderror"
                        name="user"
                        required>
                    @foreach ($users as $u)

                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>

                @error('user')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="status" class="form-label">{{ __('Status') }}</label>

                <select id="status" class="form-control @error('status') is-invalid @enderror"
                        name="status"
                        required>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>

                @error('status')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="table__wrapper">
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
                                Stock
                            </th>
                            <th class="talbe__heading" scope="col">
                                Prix
                            </th>
                            <th class="talbe__heading" scope="col">
                                ISBN
                            </th>
                            <th class="talbe__heading" scope="col">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table__body" wire:loading.class.delay="loading">
                        @if (count($books))
                            @foreach ($books as $book)
                                <tr class="table__row">
                                    <td class="talbe__data">{{ $loop->iteration }}</td>
                                    <td class="talbe__data">
                                        <img src="{{ asset('storage/covers/small_' . $book->cover) }}"
                                             alt="Foto de profil"
                                             width="250"
                                             height="250">
                                    </td>
                                    <td class="talbe__data">{{ $book->title }}</td>
                                    <td class="talbe__data">
                                        {{ $book->author }}
                                    </td>
                                    <td class="talbe__data">
                                        {{ $book->stock }}
                                    </td>
                                    <td class="talbe__data">
                                        @currency($book->price)
                                    </td>
                                    <td class="talbe__data">
                                        {{ $book->ISBN }}
                                    </td>

                                    <td class="talbe__data talbe__data--action">
                                        <div class="form-group">
                                            <label for="amount" class="form-label">{{ __('Examplaires') }}</label>

                                            <input id="amount" type="number"
                                                   class="form-control @error('amount') is-invalid @enderror"
                                                   name="amount[{{ $book->id }}]"
                                                   value="{{ $amount ?? (old('amount') ?? 0) }}" required
                                                   autocomplete="amount"
                                                   placeholder="0" min="0">

                                            @error('title')
                                                <p class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
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
                </table>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-submit">
                    {{ __('Enregistrer la commande') }}
                </button>
            </div>
        </form>
    </main>
@endsection
