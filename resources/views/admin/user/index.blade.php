@extends('layout.app', ['title'=>'Liste des utilisateurs'])

@section('content')
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__heading"><a href="{{ route('admin.dashboard') }}" class="header__link">Book a Book</a>
                <span class="sr-only">- Liste des utilisateurs</span>
            </h1>
            <x-admin-menu />
        </div>
    </header>
    <main>
        @include('layout.success')
        @include('layout.error')
        <section class="controls" aria-label="Navigation de la ressource">
            <h2 class="sr-only controls__heading" role="heading" aria-level="2">Navigation de la ressource</h2>
            <div class="controls__wrapper">
                <a href="{{ route('admin.user.create') }}" class="controls__link">@include('icons.add')Ajouter un
                    utilisateur</a>
            </div>
        </section>

        <livewire:user-table />
    </main>
@endsection

@section('styles')
    @livewireStyles
@endsection

@section('scripts')
    @livewireScripts
@endsection
