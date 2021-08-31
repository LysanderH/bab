@extends('layout.app', ['title'=>'Liste des utilisateurs'])

@section('content')
    <h1>Liste des utilisateurs</h1>
    <x-admin-menu />

    <nav class="controls" aria-label="Navigation de la ressource">
        <h2 class="controls__heading sr-only" role="heading" aria-level="2">Navigation de la ressource</h2>
        <div class="controls__wrapper">
            <a href="{{ route('admin.user.create') }}" class="controls__link">Ajouter un utilisateur</a>
            <a href="{{ route('admin.user.edit', ['user' => $user->id]) }}" class="controls__link">Modifier
                l’utilisateur</a>
            <form action="{{ route('admin.user.destroy', ['user' => $user->id]) }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit"><span class="sr-only">Supprimer
                        l’utilisateur</span></button>
            </form>
        </div>
    </nav>

    <section class="user" aria-label="{{ $user->name }}">
        <h2 class="user__heading" role="heading" aria-level="2">{{ $user->name }}</h2>
        <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Image de profil" class="user__img">
        <p class="email">{{ $user->email }}</p>
        <p class="group">{{ $user->group }}</p>

        <section class="user-orders" aria-label="Commandes">
            <h3 class="user-orders__heading" role="heading" aria-level="3">Commandes</h3>
            <table class="table">
                <thead class="table__head">
                    <tr class="table__row">
                        <th class="talbe__heading" scope="col">
                            <a href="" class="table__link">Nom</a>
                        </th>
                        <th class="talbe__heading" scope="col">
                            <a href="" class="table__link">Total</a>
                        </th>
                        <th class="talbe__heading" scope="col">
                            <a href="" class="table__link">Status</a>
                        </th>
                    </tr>
                </thead>
                <tbody class="table__body">
                    @if (count($user->orders))
                        @foreach ($user->orders as $order)
                            <tr class="table__row">
                                <td class="talbe__data">{{ $order->total }}</td>
                                <td class="talbe__data">
                                    <form action="update/order" class="table__form form">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" value="{{ $order->id }}">
                                        <select name="status">
                                            @foreach ($order->statuses as $status)
                                                <option value="{{ $status->id }}"
                                                        @if ($status->id === $order->status_id) selected @endif>{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="table__row">
                            <td class="talbe__data table__data--no-data" colspan="3">
                                Aucune commande n'a été faite
                            </td>
                        </tr>
                    @endif


                </tbody>
            </table>
        </section>
    </section>

@endsection
