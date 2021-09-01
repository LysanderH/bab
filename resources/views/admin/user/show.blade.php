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

        <livewire:user-order-table :user="$user" :statuses="$statuses" />
    </section>
@endsection

@section('styles')
    @livewireStyles
@endsection

@section('scripts')
    @livewireScripts
@endsection
