@extends('layout.app', ['title'=>'Liste des livres'])

@section('content')
    <h1>Liste des livres</h1>
    <x-admin-menu />

    <section class="controls" aria-label="Navigation de la ressource">
        <h2 class="controls__heading sr-only" role="heading" aria-level="2">Navigation de la ressource</h2>
        <div class="controls__wrapper">
            <a href="{{ route('admin.book.create') }}" class="controls__link">Ajouter un livre</a>
        </div>
    </section>

    <livewire:book-table />
@endsection
@section('styles')
    @livewireStyles
@endsection

@section('scripts')
    @livewireScripts
@endsection
