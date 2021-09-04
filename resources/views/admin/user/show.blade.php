@extends('layout.app', ['title'=>'Liste des utilisateurs'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading"><a href="{{ route('admin.dashboard') }}" class="header__link">Book a Book</a>
                <span class="sr-only">- Voir l’utilisateur</span>
            </h1>
            <x-admin-menu />
        </div>
    </header>
    <main>
        @include('layout.success')
        @include('layout.error')
        <nav class="controls" aria-label="Navigation de la ressource">
            <h2 class="sr-only controls__heading" role="heading" aria-level="2">Navigation de la ressource</h2>
            <div class="controls__wrapper">
                <a href="{{ route('admin.user.create') }}" class="controls__link">@include('icons.add') Ajouter <span
                          class="sr-only">un utilisateur</span></a>
                <a href="{{ route('admin.user.edit', ['user' => $user->id]) }}"
                   class="controls__link">@include('icons.modify') Modifier
                    <span class="sr-only">l’utilisateur</span></a>
                <form action="{{ route('admin.user.destroy', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="table__link--delete">@include('icons.delete')<span
                              class="sr-only">Supprimer
                            l’utilisateur</span></button>
                </form>
            </div>
        </nav>

        <section class="user" aria-label="{{ $user->name }}">
            <h2 class="user__heading" role="heading" aria-level="2">{{ $user->name }}</h2>
            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Image de profil" class="user__img">
            <p class="email"><a href="mailto:{{ $user->email }}" class="mailto">{{ $user->email }}</a>
            </p>
            <p class="group">{{ $user->group }}</p>

            <livewire:user-order-table :user="$user" :statuses="$statuses" />
        </section>
    </main>
@endsection

@section('styles')
    @livewireStyles
@endsection

@section('scripts')
    @livewireScripts
@endsection
